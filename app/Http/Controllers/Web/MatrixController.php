<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
use Carbon\Carbon;

class MatrixController extends Controller
{
    public $_risk_array = [
        'age' => '⏳',
        'sex' => '👫',
        'current_health' => '🧠',
        'previous_health' => '📜',
        'language' => '🗣',
        'sexual_orientation' => '🌈',
        'family_structure' => '👨‍👩‍👧',
        'access_the_internet' => '📱',
        'online_activity_frequency' => '⏰',
        'online_behaviour' => '👤',
        'geographic_location' => '🌍',
        'socioeconomic_status' => '💼',
        'school_attendance' => '🏫',
        'parental_involvement' => '👪',
        'support_system' => '❤️',
        'peer_relationships' => '👫',
        'relationship_status' => '💍',
        'school_climate' => '☀️',
        'academic_performance' => '📚',
    ];

    public function index($child_id = '')
    {
        $user = Auth::guard('web')->user();

        if (empty($child_id)) {
            $child_id = DB::table('user_childrens')->where('user_id', $user->id)->first();
            $child_id = $child_id->id;
        }

        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $child_score = DB::table('risk_score')->where('user_child_id', $child_id)->get();
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $top_risks = DB::table('risk_score')->where('user_child_id', $child->id)->orderBy(DB::raw('CAST(pi_score AS DECIMAL)'), 'desc')->take(5)->get();
        $top_risks_ids = array();
        if (count($top_risks) > 0) {
            $top_risks_ids = $top_risks->toArray();
            $top_risks_ids = array_column($top_risks_ids, 'id');

            $first_risks = DB::table('risk_score')
                ->where('id', $top_risks_ids[0])
                ->first();
        } else {
            $first_risks = DB::table('risk_score')
                ->where('user_child_id', $child_id)
                ->orderBy(DB::raw('CAST(pi_score AS DECIMAL)'), 'desc')
                ->orderBy('id', 'desc')
                ->first();
        }
        $first_risk_key = isset($first_risks->risk_key) ? $first_risks->risk_key : '';
        $likelihood_score = 'pending_questionnaire';
        $impact_score = 'pending_questionnaire';
        if (!empty($first_risk_key)) {
            $likelihood_score = $this->get_likelihood_score($child_detail->$first_risk_key, $child_id);
            $impact_score = $this->get_impact_criteria($child_id);
        }
        if (!is_null($user->plan_id)) {
            $recommendations_age = DB::table('recommendations')
                //                ->where('tags_for_associated_risk', 'LIKE', '%' . 'Age' . '%')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(20)->get();

            $recommendations_affiliate  = DB::table('recommendations')
                ->where('tag_if_affiliate', 'Affiliate')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(3)->get();

            $recommendations_one_time  = DB::table('recommendations')
                ->where('tag_for_frequency', 'One-time')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(8)->get();
            $recommendations_monthly  = DB::table('recommendations')
                ->where('tag_for_frequency', 'Monthly')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(6)->get();
            $recommendations_weekly  = DB::table('recommendations')
                ->where('tag_for_frequency', 'Weekly')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(4)->get();
            $recommendations_daily  = DB::table('recommendations')
                ->where('tag_for_frequency', 'Daily')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_family_env  = DB::table('recommendations')
                ->where('tags_for_visual_grouping', 'Family Environment')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_peer_env  = DB::table('recommendations')
                ->where('tags_for_visual_grouping', 'School/Peer Environment')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_technical  = DB::table('recommendations')
                ->where('tags_for_visual_grouping', 'Technical Recommendations')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_well_being  = DB::table('recommendations')
                ->where('tags_for_visual_grouping', 'Emotional Well-Being Strategies')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_internet_usage  = DB::table('recommendations')
                ->where('tags_for_visual_grouping', 'Internet Usage Type: Gaming')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_social_media  = DB::table('recommendations')
                ->where('tags_for_visual_grouping', 'Internet Usage Type: Social Media')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();

            $mergedArray = $recommendations_age
                ->merge($recommendations_affiliate)
                ->merge($recommendations_one_time)
                ->merge($recommendations_monthly)
                ->merge($recommendations_weekly)
                ->merge($recommendations_daily)
                ->merge($recommendations_family_env)
                ->merge($recommendations_peer_env)
                ->merge($recommendations_technical)
                ->merge($recommendations_well_being)
                ->merge($recommendations_internet_usage)
                ->merge($recommendations_social_media);

            $uniqueRecords = $mergedArray->unique('id');

            $sortedRecords = $uniqueRecords->sortByDesc('id');

            $recommendations = $sortedRecords->take(20)->values()->all();            
            $recommendations = DB::table('recommendations')->whereIn('id', $this->getRecommendation($child_detail->age))->get();
        } else {
            $recommendations = DB::table('recommendations')
                //                ->where('tags_for_associated_risk', 'LIKE', '%' . 'Age' . '%')
                ->limit(5)->get();
        }
        $risk_array = $this->_risk_array;
        $style_array = [
            'age' => 'position: absolute;top:10px;left:20px;',
            'sex' => 'position: absolute;top:10px;left:65px;',
            'current_health' => 'position: absolute;top:10px;left:110px;',
            'previous_health' => 'position: absolute;top:10px;left:155px;',
            'language' => 'position: absolute;top:45px;left:20px;',
            'sexual_orientation' => 'position: absolute;top:45px;left:65px;',
            'family_structure' => 'position: absolute;top:45px;left:110px;',
            'access_the_internet' => 'position: absolute;top:45px;left:155px;',
            'online_activity_frequency' => 'position: absolute;top:80px;left:20px;',
            'online_behaviour' => 'position: absolute;top:80px;left:65px;',
            'geographic_location' => 'position: absolute;top:80px;left:110px;',
            'socioeconomic_status' => 'position: absolute;top:80px;left:155px;',
            'school_attendance' => 'position: absolute;top:115px;left:20px;',
            'parental_involvement' => 'position: absolute;top:115px;left:65px;',
            'support_system' => 'position: absolute;top:115px;left:110px;',
            'peer_relationships' => 'position: absolute;top:115px;left:155px;',
            'relationship_status' => 'position: absolute;top:150px;left:20px;',
            'school_climate' => 'position: absolute;top:150px;left:65px;',
            'academic_performance' => 'position: absolute;top:150px;left:110px;',
        ];
        $dashboard_score = DB::table('dashboard_score')->where('child_id', $child_id)->first();
        if ($dashboard_score->unique_risk_profile == 0) {
            DB::table('dashboard_score')->where('child_id', $child_id)->update([
                'unique_risk_profile' => 1
            ]);
        }

        $risk_titles = array();
        foreach ($risk_array as $risk_key => $risk_icon) {
            $temp = DB::table('risks')->where('key', $risk_key)->pluck('name')->first();
            if (!empty($temp)) {
                $risk_titles[$risk_key] = $temp;
            } else {
                $risk_titles[$risk_key] = ucwords(str_replace('_', '', $risk_key));
            }
        }

        return view('website.matrix.matrix', [
            'child' => $child,
            'user' => $user,
            'child_detail' => $child_detail,
            'likelihood_score' => $likelihood_score,
            'impact_score' => $impact_score,
            'recommendations' => $recommendations,
            'risk_array' => $risk_array,
            'style_array' => $style_array,
            'child_score' => $child_score,
            'first_risks' => $first_risks,
            'top_risks' => $top_risks,
            'risk_titles' => $risk_titles,
            'top_risks_ids' => $top_risks_ids,
        ]);
    }

    public function getRisk($id, $child_id)
    {
        $user = Auth::guard('web')->user();
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $risk = DB::table('risks')->where('id', $id)->first();
        $key = $risk->key;
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $answer = DB::table('user_children_details')->where('user_children_id', $child_id)->first()->$key;
        $likelihood_score = $this->get_likelihood_score($answer, $child_id);

        $risk_array = $this->_risk_array;


        $risk_titles = array();
        foreach ($risk_array as $risk_key => $risk_icon) {
            $temp = DB::table('risks')->where('key', $risk_key)->pluck('name')->first();
            if (!empty($temp)) {
                $risk_titles[$risk_key] = $temp;
            } else {
                $risk_titles[$risk_key] = ucwords(str_replace('_', '', $risk_key));
            }
        }

        $user_questions = DB::table('user_questions')->where('user_child_id', $child_id)->orderBy('id', 'ASC')->get();
        $temp = array();
        if (!empty($user_questions)) {
            foreach ($user_questions as $user_questions_answer) {
                $temp[] = $user_questions_answer->answer;
            }
        }
        $user_questions = $temp;

        $user_questions_answer = '';
        $count = 0;
        foreach ($risk_array as $risk_key => $value) {
            if ($risk_key == $key) {
                $user_questions_answer = isset($user_questions[$count]) ? $user_questions[$count] : '';
            }
            $count++;
        }

        $impact_score = $this->get_impact_criteria($user_questions_answer);
        $view = view('website.matrix.risk', [
            'risk' => $risk,
            'child_detail' => $child_detail,
            'likelihood_score' => $likelihood_score,
            'impact_score' => $impact_score,
            'child' => $child,
        ])->render();
        if (!is_null($user->plan_id)) {
            $recommendations_age = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(20)->get();

            $recommendations_affiliate  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tag_if_affiliate', 'Affiliate')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(3)->get();

            $recommendations_one_time  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tag_for_frequency', 'One-time')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(8)->get();
            $recommendations_monthly  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tag_for_frequency', 'Monthly')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(6)->get();
            $recommendations_weekly  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tag_for_frequency', 'Weekly')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(4)->get();
            $recommendations_daily  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tag_for_frequency', 'Daily')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_family_env  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tags_for_visual_grouping', 'Family Environment')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_peer_env  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tags_for_visual_grouping', 'School/Peer Environment')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_technical  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tags_for_visual_grouping', 'Technical Recommendations')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_well_being  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tags_for_visual_grouping', 'Emotional Well-Being Strategies')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_internet_usage  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tags_for_visual_grouping', 'Internet Usage Type: Gaming')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_social_media  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')
                ->where('tags_for_visual_grouping', 'Internet Usage Type: Social Media')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();

            $mergedArray = $recommendations_age
                ->merge($recommendations_affiliate)
                ->merge($recommendations_one_time)
                ->merge($recommendations_monthly)
                ->merge($recommendations_weekly)
                ->merge($recommendations_daily)
                ->merge($recommendations_family_env)
                ->merge($recommendations_peer_env)
                ->merge($recommendations_technical)
                ->merge($recommendations_well_being)
                ->merge($recommendations_internet_usage)
                ->merge($recommendations_social_media);

            $uniqueRecords = $mergedArray->unique('id');

            $sortedRecords = $uniqueRecords->sortByDesc('id');

            $recommendations = $sortedRecords->take(20)->values()->all();
            $recommendations = DB::table('recommendations')->whereIn('id', $this->getRecommendation($child_detail->age))->get();
        } else {
            $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')->limit(5)->get();
        }
        $top_risks = DB::table('risk_score')->where('user_child_id', $child->id)->orderBy(DB::raw('CAST(pi_score AS DECIMAL)'), 'desc')->take(5)->get();
        $recommendation = view('website.matrix.risk_wise_recommendation', [
            'risk' => $risk,
            'child' => $child,
            'recommendations' => $recommendations,
            'risk_array' => $risk_array,
            'top_risks' => $top_risks,
        ])->render();
        return response()->json([
            'data' => $view,
            'recommendation' => $recommendation,
            'risk_name' => $risk->name,
        ]);
    }

    public function getRiskWiseRecommendation($risk_name, $child_id)
    {
        $user = Auth::guard('web')->user();
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $risk = DB::table('risks')->where('name', $risk_name)->first();
        $top_risks = DB::table('risk_score')->where('user_child_id', $child->id)->orderBy(DB::raw('CAST(pi_score AS DECIMAL)'), 'desc')->take(5)->get();
        if (!is_null($user->plan_id)) {
            $recommendations_age = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(20)->get();

            $recommendations_affiliate  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tag_if_affiliate', 'Affiliate')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(3)->get();

            $recommendations_one_time  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tag_for_frequency', 'One-time')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(8)->get();
            $recommendations_monthly  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tag_for_frequency', 'Monthly')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(6)->get();
            $recommendations_weekly  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tag_for_frequency', 'Weekly')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(4)->get();
            $recommendations_daily  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tag_for_frequency', 'Daily')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_family_env  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tags_for_visual_grouping', 'Family Environment')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_peer_env  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tags_for_visual_grouping', 'School/Peer Environment')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_technical  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tags_for_visual_grouping', 'Technical Recommendations')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_well_being  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tags_for_visual_grouping', 'Emotional Well-Being Strategies')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_internet_usage  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tags_for_visual_grouping', 'Internet Usage Type: Gaming')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();
            $recommendations_social_media  = DB::table('recommendations')
                ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                ->where('tags_for_visual_grouping', 'Internet Usage Type: Social Media')
                ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                ->limit(2)->get();

            $mergedArray = $recommendations_age
                ->merge($recommendations_affiliate)
                ->merge($recommendations_one_time)
                ->merge($recommendations_monthly)
                ->merge($recommendations_weekly)
                ->merge($recommendations_daily)
                ->merge($recommendations_family_env)
                ->merge($recommendations_peer_env)
                ->merge($recommendations_technical)
                ->merge($recommendations_well_being)
                ->merge($recommendations_internet_usage)
                ->merge($recommendations_social_media);

            $uniqueRecords = $mergedArray->unique('id');

            $sortedRecords = $uniqueRecords->sortByDesc('id');

            $recommendations = $sortedRecords->take(20)->values()->all();
            $recommendations = DB::table('recommendations')->whereIn('id', $this->getRecommendation($child_detail->age))->get();
        } else {
            $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')->limit(5)->get();
        }
        $view = view('website.matrix.risk_wise_recommendation', [
            'risk' => $risk,
            'child' => $child,
            'recommendations' => $recommendations,
        ])->render();
        return response()->json([
            'data' => $view
        ]);
    }

    public function riskChangeEvent($risk_name, $child_id)
    {
        $user = Auth::guard('web')->user();

        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $risk = DB::table('risks')->where('name', $risk_name)->first();
        if (!is_null($user->plan_id)) {
            if ($risk_name == 'all_category') {
                $recommendations_age = DB::table('recommendations')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(20)->get();

                $recommendations_affiliate  = DB::table('recommendations')
                    ->where('tag_if_affiliate', 'Affiliate')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(3)->get();

                $recommendations_one_time  = DB::table('recommendations')
                    ->where('tag_for_frequency', 'One-time')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(8)->get();
                $recommendations_monthly  = DB::table('recommendations')
                    ->where('tag_for_frequency', 'Monthly')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(6)->get();
                $recommendations_weekly  = DB::table('recommendations')
                    ->where('tag_for_frequency', 'Weekly')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(4)->get();
                $recommendations_daily  = DB::table('recommendations')
                    ->where('tag_for_frequency', 'Daily')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_family_env  = DB::table('recommendations')
                    ->where('tags_for_visual_grouping', 'Family Environment')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_peer_env  = DB::table('recommendations')
                    ->where('tags_for_visual_grouping', 'School/Peer Environment')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_technical  = DB::table('recommendations')
                    ->where('tags_for_visual_grouping', 'Technical Recommendations')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_well_being  = DB::table('recommendations')
                    ->where('tags_for_visual_grouping', 'Emotional Well-Being Strategies')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_internet_usage  = DB::table('recommendations')
                    ->where('tags_for_visual_grouping', 'Internet Usage Type: Gaming')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_social_media  = DB::table('recommendations')
                    ->where('tags_for_visual_grouping', 'Internet Usage Type: Social Media')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();

                $mergedArray = $recommendations_age
                    ->merge($recommendations_affiliate)
                    ->merge($recommendations_one_time)
                    ->merge($recommendations_monthly)
                    ->merge($recommendations_weekly)
                    ->merge($recommendations_daily)
                    ->merge($recommendations_family_env)
                    ->merge($recommendations_peer_env)
                    ->merge($recommendations_technical)
                    ->merge($recommendations_well_being)
                    ->merge($recommendations_internet_usage)
                    ->merge($recommendations_social_media);

                $uniqueRecords = $mergedArray->unique('id');

                $sortedRecords = $uniqueRecords->sortByDesc('id');

                $recommendations = $sortedRecords->take(20)->values()->all();
                $recommendations = DB::table('recommendations')->whereIn('id', $this->getRecommendation($child_detail->age))->get();
            } else {
                $recommendations_age = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(20)->get();

                $recommendations_affiliate  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tag_if_affiliate', 'Affiliate')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(3)->get();

                $recommendations_one_time  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tag_for_frequency', 'One-time')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(8)->get();
                $recommendations_monthly  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tag_for_frequency', 'Monthly')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(6)->get();
                $recommendations_weekly  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tag_for_frequency', 'Weekly')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(4)->get();
                $recommendations_daily  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tag_for_frequency', 'Daily')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_family_env  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tags_for_visual_grouping', 'Family Environment')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_peer_env  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tags_for_visual_grouping', 'School/Peer Environment')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_technical  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tags_for_visual_grouping', 'Technical Recommendations')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_well_being  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tags_for_visual_grouping', 'Emotional Well-Being Strategies')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_internet_usage  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tags_for_visual_grouping', 'Internet Usage Type: Gaming')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();
                $recommendations_social_media  = DB::table('recommendations')
                    ->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')
                    ->where('tags_for_visual_grouping', 'Internet Usage Type: Social Media')
                    ->where('tags_for_age_appropriateness', 'LIKE', '%' . $child_detail->age . '%')
                    ->limit(2)->get();

                $mergedArray = $recommendations_age
                    ->merge($recommendations_affiliate)
                    ->merge($recommendations_one_time)
                    ->merge($recommendations_monthly)
                    ->merge($recommendations_weekly)
                    ->merge($recommendations_daily)
                    ->merge($recommendations_family_env)
                    ->merge($recommendations_peer_env)
                    ->merge($recommendations_technical)
                    ->merge($recommendations_well_being)
                    ->merge($recommendations_internet_usage)
                    ->merge($recommendations_social_media);

                $uniqueRecords = $mergedArray->unique('id');

                $sortedRecords = $uniqueRecords->sortByDesc('id');

                $recommendations = $sortedRecords->take(20)->values()->all();
                $recommendations = DB::table('recommendations')->whereIn('id', $this->getRecommendation($child_detail->age))->get();
            }
        } else {
            if ($risk_name == 'all_category') {
                $recommendations = DB::table('recommendations')->limit(5)->orderBy('id', 'desc')->get();
            } else {
                $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')->limit(5)->orderBy('id', 'desc')->get();
            }
        }
        $view = view('website.matrix.risk_change_event', [
            'risk' => $risk,
            'child' => $child,
            'recommendations' => $recommendations,
        ])->render();
        return response()->json([
            'data' => $view
        ]);
    }


    function get_matrix($answers = array())
    {
    }


    public function get_likelihood_score($answer = '', $child_id = 0)
    {
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $arrayLikelihood = [
            "14-17 years old" => 1,
            "10-13 years old" => 2,
            "6-9 years old" => 3,
            "male" => 1,
            "intersex" => 2,
            "female" => 3,
            "no known mental health conditions" => 1,
            "mild anxiety or depression" => 2,
            "severe anxiety or depression, or other mental health conditions that impact their daily life" => 3,
            "no history of mental health issues" => 1,
            "a family history of mental health issues" => 2,
            "a personal history of mental health issues" => 3,
            "the dominant language in their community" => 1,
            "a second language, but is fluent in the dominant language" => 2,
            "a language other than the dominant language in their community, and may struggle with communication" => 3,
            "heterosexual" => 1,
            "questioning or unsure of their sexual orientation" => 2,
            "LGBTQIA+" => 3,
            "two-parent household with a stable and supportive family environment" => 1,
            "single-parent household, but has a stable and supportive family environment" => 2,
            "single-parent household with a less stable or unsupportive family environment" => 3,
            "desktop computer or laptop" => 1,
            "variety of devices, including smartphones and tablets," => 2,
            "smartphone or tablet" => 3,
            "moderate amount of time (less than 2 hours)" => 1,
            "significant amount of time (2-4 hours)" => 2,
            "large amount of time (more than 4 hours)" => 3,
            "are cautious and responsible online, and avoid risky behaviour" => 1,
            "engage in some risky behaviour online, such as sharing personal information with strangers or visiting potentially harmful websites" => 2,
            "engage in frequent risky behaviour online, such as cyberbullying others or engaging with strangers online without parental supervision" => 3,
            "rural" => 1,
            "suburban" => 2,
            "urban" => 3,
            "upper-class or high socioeconomic status" => 1,
            "middle-class" => 2,
            "lower socioeconomic status" => 3,
            "irregularly or are homeschooled" => 1,
            "regularly, but have occasional absences" => 2,
            "regularly with no or very few absences" => 3,
            "am highly involved in child's online activities and closely monitor child's online behaviour" => 1,
            "have some some level of involvement in child's online activities, but do not monitor them closely" => 2,
            "am not involved in child's online activities" => 3,
            "a strong support system, including family members, friends, and other adults who provide emotional support" => 1,
            "some supportive relationships, but may lack a strong support system" => 2,
            "few or no supportive relationships" => 3,
            "positive and supportive" => 1,
            "some issues (e.g. occasional conflicts or disagreements) with" => 2,
            "significant issues (e.g. being excluded or bullied by peers) with" => 3,
            "not in a romantic relationship" => 1,
            "in a casual or short-term romantic relationship" => 2,
            "in a serious or long-term romantic relationship" => 3,
            "a positive and supportive climate, with a low incidence of bullying and harassment" => 1,
            "some issues with bullying and harassment, but takes steps to address these issues" => 2,
            "a negative or unsupportive climate, with a high incidence of bullying and harassment" => 3,
            "performing well academically and are not struggling in school" => 1,
            "experiencing some academic difficulties, such as low grades or behavioural issues" => 2,
            "experiencing significant academic difficulties and are at risk of academic failure or dropping out of school" => 3,
        ];
        $likelihood = 0;
        foreach ($arrayLikelihood as $key => $value) {
            if ($answer === $key) {
                $likelihood = $value;
                break; // Stop the loop once the value is found
            }
        }
        if ((int)$likelihood === 1) {
            $val = 'Unlikely';
        } elseif ((int)$likelihood === 2) {
            $val = 'Possible';
        } elseif ((int)$likelihood === 3) {
            $val = 'Likely';
        } else {
            $val = 'No';
        }
        return $val;
    }

    public function get_impact_criteria($answer)
    {
        $answer_fetch = [
            "feels slightly upset or bothered by online interactions." => 1,
            "experiences some emotional distress and minor changes in behaviour due to cyberbullying." => 2,
            "experiences significant emotional distress, withdrawal, or adverse effects on their mental health due to cyberbullying." => 3,
            "occasionally encounters mild teasing or teasing online comments." => 1,
            "experiences some negative emotions and occasional distress due to cyberbullying related to their sex." => 2,
            "faces severe and persistent online harassment and experiences significant negative impacts on their self-esteem and overall well-being due to their sex." => 3,
            "encounters occasional instances of online conflict or disagreement with peers from different regions." => 1,
            "faces some challenges navigating online interactions with individuals from different regions or communities, leading to mild discomfort or misunderstanding." => 2,
            "experiences frequent and intense online bullying or exclusion from peers in different regions or communities, resulting in significant emotional distress and feelings of isolation." => 3,
            "&apos;s mental health is temporarily affected by online interactions, but they quickly recover." => 1,
            "experiences increased stress or anxiety due to cyberbullying, requiring some support or coping strategies to manage their mental health." => 2,
            "&apos;s mental health significantly deteriorates, leading to severe emotional distress, depression, or anxiety as a result of cyberbullying." => 3,
            "&apos;s history of mental health issues does not significantly impact their experience of cyberbullying." => 1,
            "&apos;s past mental health issues are triggered or worsened by cyberbullying, resulting in increased emotional challenges and requiring additional support." => 2,
            "&apos;s previous mental health problems resurface or intensify due to cyberbullying, leading to severe psychological distress and potentially requiring professional intervention." => 3,
            "never or occasionally encounters misunderstandings or language barriers during online interactions." => 1,
            "faces some social exclusion or teasing related to their language skills, causing them occasional distress." => 2,
            "experiences significant discrimination, bullying, or isolation due to their language, resulting in profound emotional and psychological impacts." => 3,
            "never or occasionally engages in mild online conflicts or disagreements with others." => 1,
            "&apos;s own online behaviour attracts some negative attention or minor conflicts, leading to increased stress or discomfort." => 2,
            "&apos;s online behaviour triggers intense online harassment or retaliation, resulting in severe emotional distress and negative consequences for their online and offline life." => 3,
            "never or occasionally faces subtle social exclusion or teasing related to their socioeconomic status." => 1,
            "experiences occasional difficulties or challenges due to their socioeconomic status, leading to some emotional impact." => 2,
            "faces significant discrimination, bullying, or stigmatisation due to their socioeconomic status, resulting in profound emotional distress and adverse effects on their well-being." => 3,
            "never or occasionally encounters mild teasing or jokes related to their sexual orientation." => 1,
            "experiences some negative emotions and occasional distress due to cyberbullying related to their sexual orientation." => 2,
            "faces severe and persistent online harassment and experiences significant negative impacts on their self-esteem, mental health, and overall well-being due to their sexual orientation." => 3,
            "does not experience, or experiences occasional, mild conflicts or disagreements with peers at school." => 1,
            "faces some negative interactions or discomfort at school due to cyberbullying, resulting in noticeable changes in their behaviour, such as increased anxiety or reluctance to attend school." => 2,
            "experiences persistent and severe cyberbullying victimisation at school, leading to significant emotional distress, social withdrawal, academic decline, and potentially impacting their overall attendance and educational experience." => 3,
            "occasionally faces minor conflicts or challenges online but can resolve them independently." => 1,
            "experiences occasional emotional distress or conflicts online, requiring some parental intervention or support to address the issues." => 2,
            "faces severe and persistent online harassment or victimisation, leading to significant emotional distress and negative impacts on their well-being despite parental involvement." => 3,
            "&apos;s supportive relationships mitigate the impact of cyberbullying, resulting in minor or temporary emotional distress." => 1,
            "experiences occasional emotional challenges due to cyberbullying, but support from relationships helps them cope and recover." => 2,
            "lacks a strong support system to navigate the effects of cyberbullying, leading to significant emotional distress and long-lasting negative consequences." => 3,
            "occasionally encounters minor online conflicts or negative experiences regardless of the device used." => 1,
            "faces some challenges or risks specific to certain devices, resulting in occasional emotional distress or minor negative impacts." => 2,
            "&apos;s use of certain devices exposes them to severe online harassment or risks, leading to significant emotional distress and detrimental consequences to their well-being." => 3,
            "occasionally encounters minor conflicts or disagreements within the school environment." => 1,
            "faces some challenges or negative experiences related to bullying or cyberbullying at school, resulting in occasional emotional distress or minor impact on their well-being." => 2,
            "experiences a toxic or unsafe school climate with pervasive bullying or cyberbullying, leading to significant emotional distress, social isolation, and negative effects on their academic performance." => 3,
            "occasionally faces minor challenges or conflicts related to their family structure." => 1,
            "experiences occasional emotional difficulties or conflicts due to their family structure, requiring some support or coping strategies." => 2,
            "faces significant emotional challenges, stigma, or social exclusion due to their family structure, resulting in severe emotional distress and negative impacts on their well-being." => 3,
            "&apos;s academic performance remains unaffected by cyberbullying." => 1,
            "experiences occasional distractions or minor decline in academic performance due to cyberbullying, requiring some support or intervention." => 2,
            "&apos;s academic performance significantly deteriorates due to the emotional toll of cyberbullying, leading to severe distress and long-term negative effects on their educational attainment." => 3,
            "&apos;s moderate online activity does not significantly impact their well-being or susceptibility to cyberbullying." => 1,
            "&apos;s frequent online activity exposes them to occasional risks or challenges, resulting in some emotional distress or negative experiences." => 2,
            "&apos;s extensive online activity increases their vulnerability to severe cyberbullying, leading to significant emotional distress and detrimental consequences to their well-being." => 3,
            "never or occasionally experiences minor conflicts or disagreements with peers online." => 1,
            "faces occasional challenges or negative experiences within their peer relationships online, resulting in some emotional distress or minor impact on their social well-being." => 2,
            "experiences severe peer victimisation or exclusion online, leading to significant emotional distress, social isolation, and negative effects on their overall well-being." => 3,
            "&apos;s relationship status has minimal impact on their susceptibility to cyberbullying or well-being." => 1,
            "&apos;s casual or short-term relationship status occasionally contributes to some online conflicts or emotional challenges." => 2,
            "&apos;s serious or long-term relationship status exposes them to severe cyberbullying, online harassment, or relationship-related conflicts, resulting in significant emotional distress and negative impacts on their well-being." => 3,
        ];

        // $mergedArray = [];
        // foreach ($answers as $answer) {
        //     $question = $answer->answer;

        //     if (array_key_exists($question, $answer_fetch)) {
        //         $impact = $answer_fetch[$question];
        //         $mergedArray[$question] = $impact;
        //     }
        // }
        $impact = isset($answer_fetch[$answer]) ? $answer_fetch[$answer] : '';
        if ((int)$impact === 1) {
            $impact_score = 'Minor';
        } elseif ((int)$impact === 2) {
            $impact_score = 'Moderate';
        } else {
            $impact_score = 'Major';
        }
        return $impact_score;
    }


    function get_risk_category()
    {
        $array = array(
            1 => array(
                'title' => '',
            )
        );
    }

    public function addToCalendar($title, $id)
    {
        $url = 'https://calendar.google.com/calendar/r/eventedit';
        $tomorrow = Carbon::now()->addDay()->format('YmdTHis'); // or Carbon::tomorrow();
        $after_2_day = Carbon::now()->addDays(2)->format('YmdTHis');

        $info = DB::table('recommendations')->where('id', $id)->get()->first();
        $link = '';
        if (isset($info->pdf) && !empty($info->pdf)) {
            $link = asset($info->pdf);
        }

        $args = array(
            //            'dates' => $tomorrow . '/' . $after_2_day,
            'details' => $info->recommendation . ' ' . $link,
            'text' => $info->title_for_recommendation,
            //'trp' => true
        );

        $url .= '?' . http_build_query($args);
        $url .= '&trp=true';
        return response()->json([
            'url' => $url,
        ]);
    }

    public function addToMicrosoftCalendar($title, $desc)
    {
        //        $graph = new Graph();
        //        $graph->setAccessToken('YOUR_ACCESS_TOKEN');
        //
        //        $event = new Event([
        //            'subject' => $title,
        //            'body' => [
        //                'content' => $desc,
        //                'contentType' => 'text',
        //            ],
        //            'start' => [
        //                'dateTime' => Carbon::now()->addDay()->format('Y-m-d\TH:i:s'),
        //                'timeZone' => 'UTC',
        //            ],
        //            'end' => [
        //                'dateTime' => Carbon::now()->addDays(2)->format('Y-m-d\TH:i:s'),
        //                'timeZone' => 'UTC',
        //            ],
        //        ]);
        //
        //        $graph->createRequest('POST', '/me/calendar/events')
        //            ->attachBody($event)
        //            ->execute();
        //
        //        return response()->json([
        //            'success' => true,
        //        ]);
        $url = 'https://outlook.live.com/calendar/deeplink/compose';
        $tomorrow = Carbon::now()->addDay()->format('YmdTHis'); // or Carbon::tomorrow();
        $after_2_day = Carbon::now()->addDays(2)->format('YmdTHis');

        $args = array(
            'dates' => $tomorrow . '/' . $after_2_day,
            'details' => $desc,
            'text' => $title,
            //'trp' => true
        );

        $url .= '?' . http_build_query($args);
        $url .= '&trp=true';
        return response()->json([
            'url' => $url,
        ]);
    }

    public function addToAppleCalendar($title, $desc)
    {
        // Create a new calendar
        $calendar = Calendar::create();

        // Add an event to the calendar
        $event = Event::create()
            ->name($title)
            ->description($desc)
            ->startsAt(Carbon::now())
            ->endsAt(Carbon::now()->addHour());

        $calendar->event($event);

        $content = $calendar->get();

        $filename = 'calendar.ics';
        file_put_contents(public_path($filename), $content);

        $url = url($filename);
        return redirect()->away($url);
    }

    private function getRecommendation($age)
    {

        $total = array();
        $total['affiliate'] = array();
        $total['resource'] = array();
        $total['monthly'] = array();
        $total['weekly'] = array();
        $total['daily'] = array();
        $total['one_time'] = array();

        $total['all'] = array();

        $get3_affiliate = DB::select("SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tag_if_affiliate = 'Affiliate' LIMIT 3");
        if (count($get3_affiliate) > 0) {
            foreach ($get3_affiliate as $value) {
                $total['all'][$value->id] = $value;
                $total['affiliate'][$value->id] = $value;
                if ($value->tag_for_frequency == 'One-time') {
                    if (count($total['one_time']) != 8) {
                        $total['one_time'][$value->id] = $value;
                    }
                } else if ($value->tag_for_frequency == 'Monthly') {
                    if (count($total['monthly']) != 6) {
                        $total['monthly'][$value->id] = $value;
                    }
                } else if ($value->tag_for_frequency == 'Weekly') {
                    if (count($total['weekly']) != 4) {
                        $total['weekly'][$value->id] = $value;
                    }
                } else if ($value->tag_for_frequency == 'Daily') {
                    if (count($total['daily']) != 2) {
                        $total['daily'][$value->id] = $value;
                    }
                }
            }
        }

        $get3_resource = DB::select("SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tag_if_resource = 'Resource' LIMIT 8");
        if (count($get3_resource) > 0) {
            foreach ($get3_resource as $value) {
                $total['all'][$value->id] = $value;
                $total['resource'][$value->id] = $value;
                if ($value->tag_for_frequency == 'One-time') {
                    if (count($total['one_time']) != 8) {
                        $total['one_time'][$value->id] = $value;
                    }
                } else if ($value->tag_for_frequency == 'Monthly') {
                    if (count($total['monthly']) != 6) {
                        $total['monthly'][$value->id] = $value;
                    }
                } else if ($value->tag_for_frequency == 'Weekly') {
                    if (count($total['weekly']) != 4) {
                        $total['weekly'][$value->id] = $value;
                    }
                } else if ($value->tag_for_frequency == 'Daily') {
                    if (count($total['daily']) != 2) {
                        $total['daily'][$value->id] = $value;
                    }
                }
            }
        }

        //For One time
        $limit = 8 - count($total['one_time']);
        if ($limit > 0) {
            $sub_query = '';
            if (count($total['one_time']) > 0) {
                $sub_query = " AND id NOT IN (" . implode(',', array_keys($total['one_time'])) . ") ";
            }
            $sql = "SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tag_for_frequency = 'One-time' " . $sub_query . " LIMIT " . $limit;
            $get3_one_time = DB::select($sql);
            if (count($get3_one_time) > 0) {
                foreach ($get3_one_time as $value) {
                    $total['all'][$value->id] = $value;
                    $total['one_time'][$value->id] = $value;
                }
            }
        }

        //For Monthly
        $limit = 6 - count($total['monthly']);
        if ($limit > 0) {
            $sub_query = '';
            if (count($total['monthly']) > 0) {
                $sub_query = " AND id NOT IN (" . implode(',', array_keys($total['monthly'])) . ") ";
            }
            $sql = "SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tag_for_frequency = 'Monthly' " . $sub_query . " LIMIT " . $limit;
            $get3_monthly = DB::select($sql);
            if (count($get3_monthly) > 0) {
                foreach ($get3_monthly as $value) {
                    $total['all'][$value->id] = $value;
                    $total['monthly'][$value->id] = $value;
                }
            }
        }

        //For Weekly
        $limit = 4 - count($total['weekly']);
        if ($limit > 0) {
            $sub_query = '';
            if (count($total['weekly']) > 0) {
                $sub_query = " AND id NOT IN (" . implode(',', array_keys($total['weekly'])) . ") ";
            }
            $sql = "SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tag_for_frequency = 'Weekly' " . $sub_query . " LIMIT " . $limit;
            $get3_weekly = DB::select($sql);
            if (count($get3_weekly) > 0) {
                foreach ($get3_weekly as $value) {
                    $total['all'][$value->id] = $value;
                    $total['weekly'][$value->id] = $value;
                }
            }
        }

        //For Daily
        $limit = 2 - count($total['daily']);
        if ($limit > 0) {
            $sub_query = '';
            if (count($total['daily']) > 0) {
                $sub_query = " AND id NOT IN (" . implode(',', array_keys($total['daily'])) . ") ";
            }
            $sql = "SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tag_for_frequency = 'Daily' " . $sub_query . " LIMIT " . $limit;            
            $get3_daily = DB::select($sql);
            if (count($get3_daily) > 0) {
                foreach ($get3_daily as $value) {
                    $total['all'][$value->id] = $value;
                    $total['daily'][$value->id] = $value;
                }
            }
        }

        $visual_grouping = array(
            'Family Environment', 'School/Peer Environment', 'Technical Recommendations', 'Emotional Well-Being Strategies', 'Internet Usage Type: Gaming', 'Internet Usage Type: Social Media'
        );
        foreach ($visual_grouping as $group_name) {
            $total[$group_name] = array();
            $sub_query = '';
            $sub_query = " AND id IN (" . implode(',', array_keys($total['all'])) . ") ";
            $sql = "SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tags_for_visual_grouping LIKE '%" . $group_name . "%' " . $sub_query . " LIMIT 2";
            $info = DB::select($sql);

            if (count($info) > 0) {
                foreach ($info as $value) {
                    $total['all'][$value->id] = $value;
                    $total[$group_name][] = $value;
                }
            }

            if (count($info) < 2) {
                $limit = 2 - count($info);
                $sql = "SELECT * FROM `recommendations` WHERE tags_for_age_appropriateness LIKE '%" . $age . "%' AND tags_for_visual_grouping LIKE '%" . $group_name . "%' LIMIT " . $limit;
                $info = DB::select($sql);
                if (count($info) > 0) {
                    foreach ($info as $value) {
                        $total['all'][$value->id] = $value;
                        $total[$group_name][] = $value;
                    }
                }
            }
        }

        $id = array();
        foreach ($total['all'] as $id_key => $info) {
            $id[] =  $id_key;
            if (count($id) == 20) {
                break;
            }
        }
        return $id;
    }
}
