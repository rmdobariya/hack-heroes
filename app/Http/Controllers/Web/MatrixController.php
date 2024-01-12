<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    public function index($child_id)
    {
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $child_score = DB::table('risk_score')->where('user_child_id', $child_id)->get();
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $first_risks = DB::table('risk_score')
            ->where('user_child_id', $child_id)
            ->orderBy(DB::raw('CAST(pi_score AS DECIMAL)'), 'desc')
            ->orderBy('id','desc')
            ->first();
        $first_risk_key = $first_risks->risk_key;
        $likelihood_score = $this->get_likelihood_score($child_detail->$first_risk_key, $child_id);
        $impact_score = $this->get_impact_criteria($child_id);
        $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . 'Age' . '%')->get();
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
        return view('website.matrix.matrix', [
            'child' => $child,
            'child_detail' => $child_detail,
            'likelihood_score' => $likelihood_score,
            'impact_score' => $impact_score,
            'recommendations' => $recommendations,
            'risk_array' => $risk_array,
            'style_array' => $style_array,
            'child_score' => $child_score,
            'first_risks' => $first_risks,
        ]);
    }

    public function getRisk($id, $child_id)
    {
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $risk = DB::table('risks')->where('id', $id)->first();
        $key = $risk->key;
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $answer = DB::table('user_children_details')->where('user_children_id', $child_id)->first()->$key;
        $likelihood_score = $this->get_likelihood_score($answer);

        $risk_array = $this->_risk_array;
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
        $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . $risk->name . '%')->get();
        $recommendation = view('website.matrix.risk_wise_recommendation', [
            'risk' => $risk,
            'child' => $child,
            'recommendations' => $recommendations,
            'risk_array' => $risk_array,
        ])->render();
        return response()->json([
            'data' => $view,
            'recommendation' => $recommendation,
            'risk_name' => $risk->name,
        ]);
    }

    public function getRiskWiseRecommendation($risk_name, $child_id)
    {
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $risk = DB::table('risks')->where('name', $risk_name)->first();
        $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')->get();
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
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $risk = DB::table('risks')->where('name', $risk_name)->first();
        $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . $risk_name . '%')->get();
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


    public function get_likelihood_score($answer, $child_id)
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
            "mental health is temporarily affected by online interactions, but they quickly recover." => 1,
            "experiences increased stress or anxiety due to cyberbullying, requiring some support or coping strategies to manage their mental health." => 2,
            "s mental health significantly deteriorates, leading to severe emotional distress, depression, or anxiety as a result of cyberbullying." => 3,
            "s history of mental health issues does not significantly impact their experience of cyberbullying." => 1,
            "s past mental health issues are triggered or worsened by cyberbullying, resulting in increased emotional challenges and requiring additional support." => 2,
            "s previous mental health problems resurface or intensify due to cyberbullying, leading to severe psychological distress and potentially requiring professional intervention." => 3,
            "never or occasionally encounters misunderstandings or language barriers during online interactions." => 1,
            "faces some social exclusion or teasing related to their language skills, causing them occasional distress." => 2,
            "experiences significant discrimination, bullying, or isolation due to their language, resulting in profound emotional and psychological impacts." => 3,
            "never or occasionally engages in mild online conflicts or disagreements with others." => 1,
            "s own online behaviour attracts some negative attention or minor conflicts, leading to increased stress or discomfort." => 2,
            "s online behaviour triggers intense online harassment or retaliation, resulting in severe emotional distress and negative consequences for their online and offline life." => 3,
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
            "s supportive relationships mitigate the impact of cyberbullying, resulting in minor or temporary emotional distress." => 1,
            "experiences occasional emotional challenges due to cyberbullying, but support from relationships helps them cope and recover." => 2,
            "lacks a strong support system to navigate the effects of cyberbullying, leading to significant emotional distress and long-lasting negative consequences." => 3,
            "occasionally encounters minor online conflicts or negative experiences regardless of the device used." => 1,
            "faces some challenges or risks specific to certain devices, resulting in occasional emotional distress or minor negative impacts." => 2,
            "s use of certain devices exposes them to severe online harassment or risks, leading to significant emotional distress and detrimental consequences to their well-being." => 3,
            "occasionally encounters minor conflicts or disagreements within the school environment." => 1,
            "faces some challenges or negative experiences related to bullying or cyberbullying at school, resulting in occasional emotional distress or minor impact on their well-being." => 2,
            "experiences a toxic or unsafe school climate with pervasive bullying or cyberbullying, leading to significant emotional distress, social isolation, and negative effects on their academic performance." => 3,
            "occasionally faces minor challenges or conflicts related to their family structure." => 1,
            "experiences occasional emotional difficulties or conflicts due to their family structure, requiring some support or coping strategies." => 2,
            "faces significant emotional challenges, stigma, or social exclusion due to their family structure, resulting in severe emotional distress and negative impacts on their well-being." => 3,
            "s academic performance remains unaffected by cyberbullying." => 1,
            "experiences occasional distractions or minor decline in academic performance due to cyberbullying, requiring some support or intervention." => 2,
            "s academic performance significantly deteriorates due to the emotional toll of cyberbullying, leading to severe distress and long-term negative effects on their educational attainment." => 3,
            "s moderate online activity does not significantly impact their well-being or susceptibility to cyberbullying." => 1,
            "s frequent online activity exposes them to occasional risks or challenges, resulting in some emotional distress or negative experiences." => 2,
            "s extensive online activity increases their vulnerability to severe cyberbullying, leading to significant emotional distress and detrimental consequences to their well-being." => 3,
            "never or occasionally experiences minor conflicts or disagreements with peers online." => 1,
            "faces occasional challenges or negative experiences within their peer relationships online, resulting in some emotional distress or minor impact on their social well-being." => 2,
            "experiences severe peer victimisation or exclusion online, leading to significant emotional distress, social isolation, and negative effects on their overall well-being." => 3,
            "s relationship status has minimal impact on their susceptibility to cyberbullying or well-being." => 1,
            "s casual or short-term relationship status occasionally contributes to some online conflicts or emotional challenges." => 2,
            "s serious or long-term relationship status exposes them to severe cyberbullying, online harassment, or relationship-related conflicts, resulting in significant emotional distress and negative impacts on their well-being." => 3,
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
}
