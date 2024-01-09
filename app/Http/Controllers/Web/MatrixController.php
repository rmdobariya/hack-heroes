<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MatrixController extends Controller
{
    public function index($child_id)
    {
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $risks = DB::table('risks')->whereNull('deleted_at')->whereIn('id', [1, 2, 3, 4, 5])->get();
        $other_risks = DB::table('risks')->whereNull('deleted_at')->whereNotIn('id', [1, 2, 3, 4, 5])->get();
        $likelihood_score = $this->get_likelihood_score($child_detail->age);
        $impact_score = $this->get_impact_criteria($child_id);
        $recommendations = DB::table('recommendations')->where('tags_for_associated_risk', 'LIKE', '%' . 'Age' . '%')->get();
        return view('website.matrix.matrix', [
            'child' => $child,
            'risks' => $risks,
            'other_risks' => $other_risks,
            'child_detail' => $child_detail,
            'likelihood_score' => $likelihood_score,
            'impact_score' => $impact_score,
            'recommendations' => $recommendations,
        ]);
    }

    public function getRisk($id, $child_id)
    {
        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        $risk = DB::table('risks')->where('id', $id)->first();
        $child_detail = DB::table('user_children_details')->where('user_children_id', $child_id)->first();
        $likelihood_score = $this->get_likelihood_score($risk->key);
        $impact_score = $this->get_impact_criteria($child_id);
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
        ])->render();
        return response()->json([
            'data' => $view,
            'recommendation' => $recommendation,
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


    function get_matrix($answers = array())
    {
    }


    function get_likelihood_score($answer)
    {
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
            "am highly involved in [child's first name]'s online activities and closely monitor [child's first name]'s online behaviour" => 1,
            "have some some level of involvement in [child's first name]'s online activities, but do not monitor them closely" => 2,
            "am not involved in [child's first name]'s online activities" => 3,
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
            $val = 'No';
        } else {
            $val = 'Likely';
        }
        return $val;
    }

    function get_impact_criteria($child_id)
    {
        $answers = DB::table('user_questions')->where('user_child_id', $child_id)->get();

        $child = DB::table('user_childrens')->where('id', $child_id)->first();
        if (count($answers) > 0) {
            $answer_fetch = [
                $child->name . ' ' . "feels slightly upset or bothered by online interactions." => 1,
                $child->name . ' ' . "experiences some emotional distress and minor changes in behaviour due to cyberbullying." => 2,
                $child->name . ' ' . "experiences significant emotional distress, withdrawal, or adverse effects on their mental health due to cyberbullying." => 3,
                $child->name . ' ' . "occasionally encounters mild teasing or teasing online comments." => 1,
                $child->name . ' ' . "experiences some negative emotions and occasional distress due to cyberbullying related to their sex." => 2,
                $child->name . ' ' . "faces severe and persistent online harassment and experiences significant negative impacts on their self-esteem and overall well-being due to their sex." => 3,
                $child->name . ' ' . "encounters occasional instances of online conflict or disagreement with peers from different regions." => 1,
                $child->name . ' ' . "faces some challenges navigating online interactions with individuals from different regions or communities, leading to mild discomfort or misunderstanding." => 2,
                $child->name . ' ' . "experiences frequent and intense online bullying or exclusion from peers in different regions or communities, resulting in significant emotional distress and feelings of isolation." => 3,
                $child->name . ' ' . "mental health is temporarily affected by online interactions, but they quickly recover." => 1,
                $child->name . ' ' . "experiences increased stress or anxiety due to cyberbullying, requiring some support or coping strategies to manage their mental health." => 2,
                $child->name . ' ' . "mental health significantly deteriorates, leading to severe emotional distress, depression, or anxiety as a result of cyberbullying." => 3,
                $child->name . ' ' . "history of mental health issues does not significantly impact their experience of cyberbullying." => 1,
                $child->name . ' ' . "past mental health issues are triggered or worsened by cyberbullying, resulting in increased emotional challenges and requiring additional support." => 2,
                $child->name . ' ' . "previous mental health problems resurface or intensify due to cyberbullying, leading to severe psychological distress and potentially requiring professional intervention." => 3,
                $child->name . ' ' . "occasionally encounters misunderstandings or language barriers during online interactions." => 1,
                $child->name . ' ' . "faces some social exclusion or teasing related to their language skills, causing them occasional distress." => 2,
                $child->name . ' ' . "experiences significant discrimination, bullying, or isolation due to their language, resulting in profound emotional and psychological impacts." => 3,
                $child->name . ' ' . "occasionally engages in mild online conflicts or disagreements with others." => 1,
                $child->name . ' ' . "own online behaviour attracts some negative attention or minor conflicts, leading to increased stress or discomfort." => 2,
                $child->name . ' ' . "online behaviour triggers intense online harassment or retaliation, resulting in severe emotional distress and negative consequences for their online and offline life." => 3,
                $child->name . ' ' . "occasionally faces subtle social exclusion or teasing related to their socioeconomic status." => 1,
                $child->name . ' ' . "experiences occasional difficulties or challenges due to their socioeconomic status, leading to some emotional impact." => 2,
                $child->name . ' ' . "faces significant discrimination, bullying, or stigmatisation due to their socioeconomic status, resulting in profound emotional distress and adverse effects on their well-being." => 3,
                $child->name . ' ' . "occasionally encounters mild teasing or jokes related to their sexual orientation." => 1,
                $child->name . ' ' . "experiences some negative emotions and occasional distress due to cyberbullying related to their sexual orientation." => 2,
                $child->name . ' ' . "faces severe and persistent online harassment and experiences significant negative impacts on their self-esteem, mental health, and overall well-being due to their sexual orientation." => 3,
                $child->name . ' ' . "occasionally faces Minor conflicts or challenges online but can resolve them independently." => 1,
                $child->name . ' ' . "experiences occasional emotional distress or conflicts online, requiring some parental intervention or support to address the issues." => 2,
                $child->name . ' ' . "faces severe and persistent online harassment or victimisation, leading to significant emotional distress and negative impacts on their well-being despite parental involvement." => 3,
                $child->name . ' ' . "supportive relationships mitigate the impact of cyberbullying, resulting in minor or temporary emotional distress." => 1,
                $child->name . ' ' . "experiences occasional emotional challenges due to cyberbullying, but support from relationships helps them cope and recover." => 2,
                $child->name . ' ' . "lacks a strong support system to navigate the effects of cyberbullying, leading to significant emotional distress and long-lasting negative consequences." => 3,
                $child->name . ' ' . "occasionally encounters Minor online conflicts or negative experiences regardless of the device used." => 1,
                $child->name . ' ' . "faces some challenges or risks specific to certain devices, resulting in occasional emotional distress or Minor negative impacts." => 2,
                $child->name . ' ' . "use of certain devices exposes them to severe online harassment or risks, leading to significant emotional distress and detrimental consequences to their well-being." => 3,
                $child->name . ' ' . "occasionally encounters Minor conflicts or disagreements within the school environment." => 1,
                $child->name . ' ' . "faces some challenges or negative experiences related to bullying or cyberbullying at school, resulting in occasional emotional distress or Minor impact on their well-being." => 2,
                $child->name . ' ' . "experiences a toxic or unsafe school climate with pervasive bullying or cyberbullying, leading to significant emotional distress, social isolation, and negative effects on their academic performance." => 3,
                $child->name . ' ' . "occasionally faces Minor challenges or conflicts related to their family structure." => 1,
                $child->name . ' ' . "experiences occasional emotional difficulties or conflicts due to their family structure, requiring some support or coping strategies." => 2,
                $child->name . ' ' . "faces significant emotional challenges, stigma, or social exclusion due to their family structure, resulting in severe emotional distress and negative impacts on their well-being." => 3,
                $child->name . ' ' . "academic performance remains unaffected by cyberbullying." => 1,
                $child->name . ' ' . "experiences occasional distractions or Minor decline in academic performance due to cyberbullying, requiring some support or intervention." => 2,
                $child->name . ' ' . "academic performance significantly deteriorates due to the emotional toll of cyberbullying, leading to severe distress and long-term negative effects on their educational attainment." => 3,
                $child->name . ' ' . "moderate online activity does not significantly impact their well-being or susceptibility to cyberbullying." => 1,
                $child->name . ' ' . "frequent online activity exposes them to occasional risks or challenges, resulting in some emotional distress or negative experiences." => 2,
                $child->name . ' ' . "extensive online activity increases their vulnerability to severe cyberbullying, leading to significant emotional distress and detrimental consequences to their well-being." => 3,
                $child->name . ' ' . "occasionally experiences Minor conflicts or disagreements with peers online." => 1,
                $child->name . ' ' . "faces occasional challenges or negative experiences within their peer relationships online, resulting in some emotional distress or Minor impact on their social well-being." => 2,
                $child->name . ' ' . "experiences severe peer victimisation or exclusion online, leading to significant emotional distress, social isolation, and negative effects on their overall well-being." => 3,
                $child->name . ' ' . "relationship status has minimal impact on their susceptibility to cyberbullying or well-being." => 1,
                $child->name . ' ' . "casual or short-term relationship status occasionally contributes to some online conflicts or emotional challenges." => 2,
                $child->name . ' ' . "serious or long-term relationship status exposes them to severe cyberbullying, online harassment, or relationship-related conflicts, resulting in significant emotional distress and negative impacts on their well-being." => 3,
                $child->name . ' ' . "moderate online activity does not significantly impact their well-being or susceptibility to cyberbullying." => 1,
                $child->name . ' ' . "frequent online activity exposes them to occasional risks or challenges, resulting in some emotional distress or negative experiences." => 2,
                $child->name . ' ' . "excessive online activity and constant online presence increase their vulnerability to severe cyberbullying and online victimisation, leading to significant emotional distress and detrimental consequences to their well-being." => 3,
            ];
            $mergedArray = [];
            foreach ($answers as $answer) {
                $question = $answer->answer;

                if (array_key_exists($question, $answer_fetch)) {
                    $impact = $answer_fetch[$question];
                    $mergedArray[$question] = $impact;
                }
            }
            if ((int)$impact === 1) {
                $impact_score = 'Minor';
            } elseif ((int)$impact === 2) {
                $impact_score = 'Moderate';
            } else {
                $impact_score = 'Major';
            }
            return $impact_score;
        } else {
            return 0;
        }

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
