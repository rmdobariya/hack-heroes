<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SignUp1Request;
use App\Http\Requests\Web\SignUp4Request;
use App\Http\Requests\Web\SignUpStoreRequest;
use App\Models\User;
use App\Models\UserChildren;
use App\Models\UserChildrenDetail;
use App\Models\UserQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignUpController extends Controller
{
    public function index()
    {
        return view('website.auth.signup',);
    }

    public function signUp2(SignUp1Request $request)
    {
        Session::put('name', $request->name);
        Session::put('email', $request->email);
    }


    public function signUp2View()
    {
        return view('website.auth.signup_2');
    }

    public function signUp3(Request $request)
    {
        Session::put('child_name', $request->name);
    }

    public function signUp3View()
    {
        return view('website.auth.signup_3');
    }

    public function signUp4(SignUp4Request $request)
    {
        Session::put('password', $request->password);
    }

    public function signUp4View()
    {
        $childrens = Session::get('child_name');
        return view('website.auth.signup_4', [
            'childrens' => $childrens
        ]);
    }

    public function signUp5(Request $request)
    {
        Session::put('child_name', $request->child);
        $create_plan = $request->create_plan;
        $child_name = Session::get('child_name');
        $result = [];
        foreach ($child_name as $key => $value) {
            $result[$value] = $create_plan[$key] ?? 'off';
        }
        Session::put('create_plan', $result);
        Session::put('term_condition', $request->term_condition);
    }

    public function signUp5View()
    {
        $childrens = Session::get('child_name');
        return view('website.auth.signup_5', [
            'childrens' => $childrens
        ]);
    }

    public function signUp6(Request $request)
    {

        Session::put('age', $request->age);
        Session::put('sex', $request->sex);
        Session::put('current_health', $request->current_health);
        Session::put('previous_health', $request->previous_health);
        Session::put('language', $request->language);
        Session::put('sexual_orientation', $request->sexual_orientation);
        Session::put('family_structure', $request->family_structure);
        Session::put('access_the_internet', $request->access_the_internet);
        Session::put('online_activity_frequency', $request->online_activity_frequency);
        Session::put('online_behaviour', $request->online_behaviour);
        Session::put('geographic_location', $request->geographic_location);
        Session::put('socioeconomic_status', $request->socioeconomic_status);
        Session::put('school_attendance', $request->school_attendance);
        Session::put('parental_involvement', $request->parental_involvement);
        Session::put('support_system', $request->support_system);
        Session::put('peer_relationships', $request->peer_relationships);
        Session::put('relationship_status', $request->relationship_status);
        Session::put('school_climate', $request->school_climate);
        Session::put('academic_performance', $request->academic_performance);
    }

    public function signUp6View()
    {
        $childrens = Session::get('child_name');
        $questions = [[
            'question' => 'Choose the option that best describes []  characteristics/behaviours.',
            'answer' => ['[] feels slightly upset or bothered by online interactions.',
                '[] experiences some emotional distress and minor changes in behaviour due to cyberbullying.',
                '[] experiences significant emotional distress, withdrawal, or adverse effects on their mental health due to cyberbullying.'
            ]],
            ['question' => 'Select the answer that most applies to [].',
                'answer' => ['[] occasionally encounters mild teasing or teasing online comments.',
                    '[] experiences some negative emotions and occasional distress due to cyberbullying related to their sex.',
                    '[] faces severe and persistent online harassment and experiences significant negative impacts on their self-esteem and overall well-being due to their sex.'],
            ],
            ['question' => 'Select the answer that most applies to [].',
                'answer' => ['[] encounters occasional instances of online conflict or disagreement with peers from different regions.',
                    '[] faces some challenges navigating online interactions with individuals from different regions or communities, leading to mild discomfort or misunderstanding.',
                    '[] experiences frequent and intense online bullying or exclusion from peers in different regions or communities, resulting in significant emotional distress and feelings of isolation.'],
            ],
            ['question' => 'Please select the answer option that most accurately reflects [].',
                'answer' => ['[] mental health is temporarily affected by online interactions, but they quickly recover.',
                    '[] experiences increased stress or anxiety due to cyberbullying, requiring some support or coping strategies to manage their mental health.',
                    '[] s mental health significantly deteriorates, leading to severe emotional distress, depression, or anxiety as a result of cyberbullying.'],
            ],
            ['question' => 'Choose the option that best describes [] s characteristics/behaviours.',
                'answer' => ['[] s history of mental health issues does not significantly impact their experience of cyberbullying.',
                    '[] s past mental health issues are triggered or worsened by cyberbullying, resulting in increased emotional challenges and requiring additional support.',
                    '[] s previous mental health problems resurface or intensify due to cyberbullying, leading to severe psychological distress and potentially requiring professional intervention.'],
            ],
            ['question' => 'Select the answer that most applies to [].',
                'answer' => ['[] never or occasionally encounters misunderstandings or language barriers during online interactions.',
                    '[] faces some social exclusion or teasing related to their language skills, causing them occasional distress.',
                    '[] experiences significant discrimination, bullying, or isolation due to their language, resulting in profound emotional and psychological impacts.'],
            ],
            ['question' => 'Please select the answer option that most accurately reflects [].',
                'answer' => ['[] never or occasionally engages in mild online conflicts or disagreements with others.',
                    '[] s own online behaviour attracts some negative attention or minor conflicts, leading to increased stress or discomfort.',
                    '[] s online behaviour triggers intense online harassment or retaliation, resulting in severe emotional distress and negative consequences for their online and offline life.'],
            ],
            ['question' => 'Choose the option that best describes [] s characteristics/behaviours.',
                'answer' => ['[] never or occasionally faces subtle social exclusion or teasing related to their socioeconomic status.',
                    '[] experiences occasional difficulties or challenges due to their socioeconomic status, leading to some emotional impact.',
                    '[] faces significant discrimination, bullying, or stigmatisation due to their socioeconomic status, resulting in profound emotional distress and adverse effects on their well-being.'],
            ],
            ['question' => 'Select the answer that most applies to [].',
                'answer' => ['[] never or occasionally encounters mild teasing or jokes related to their sexual orientation.',
                    '[] experiences some negative emotions and occasional distress due to cyberbullying related to their sexual orientation.',
                    '[] faces severe and persistent online harassment and experiences significant negative impacts on their self-esteem, mental health, and overall well-being due to their sexual orientation.'],
            ],
            ['question' => 'Please select the answer option that most accurately reflects [].',
                'answer' => ['[] does not experience, or experiences occasional, mild conflicts or disagreements with peers at school.',
                    '[] faces some negative interactions or discomfort at school due to cyberbullying, resulting in noticeable changes in their behaviour, such as increased anxiety or reluctance to attend school.',
                    '[] experiences persistent and severe cyberbullying victimisation at school, leading to significant emotional distress, social withdrawal, academic decline, and potentially impacting their overall attendance and educational experience.'],
            ],
            ['question' => 'Choose the option that best describes [] s characteristics/behaviours.',
                'answer' => ['[] occasionally faces minor conflicts or challenges online but can resolve them independently.',
                    '[] experiences occasional emotional distress or conflicts online, requiring some parental intervention or support to address the issues.',
                    '[] faces severe and persistent online harassment or victimisation, leading to significant emotional distress and negative impacts on their well-being despite parental involvement.'],
            ],
            ['question' => 'Select the answer that most applies to [].',
                'answer' => ['[] s supportive relationships mitigate the impact of cyberbullying, resulting in minor or temporary emotional distress.',
                    '[] experiences occasional emotional challenges due to cyberbullying, but support from relationships helps them cope and recover.',
                    '[] lacks a strong support system to navigate the effects of cyberbullying, leading to significant emotional distress and long-lasting negative consequences.'],
            ],
            ['question' => 'Please select the answer option that most accurately reflects [].',
                'answer' => ['[] occasionally encounters minor online conflicts or negative experiences regardless of the device used.',
                    '[] faces some challenges or risks specific to certain devices, resulting in occasional emotional distress or minor negative impacts.',
                    '[] s use of certain devices exposes them to severe online harassment or risks, leading to significant emotional distress and detrimental consequences to their well-being.'],
            ],
            ['question' => 'Choose the option that best describes [] s characteristics/behaviours.',
                'answer' => ['[] occasionally encounters minor conflicts or disagreements within the school environment.',
                    '[] faces some challenges or negative experiences related to bullying or cyberbullying at school, resulting in occasional emotional distress or minor impact on their well-being.',
                    '[] experiences a toxic or unsafe school climate with pervasive bullying or cyberbullying, leading to significant emotional distress, social isolation, and negative effects on their academic performance.'],
            ],
            ['question' => 'Select the answer that most applies to [].',
                'answer' => ['[] occasionally faces minor challenges or conflicts related to their family structure.',
                    '[] experiences occasional emotional difficulties or conflicts due to their family structure, requiring some support or coping strategies.',
                    '[] faces significant emotional challenges, stigma, or social exclusion due to their family structure, resulting in severe emotional distress and negative impacts on their well-being.'],
            ],
            ['question' => 'Please select the answer option that most accurately reflects [].',
                'answer' => ['[] s academic performance remains unaffected by cyberbullying.',
                    '[] experiences occasional distractions or minor decline in academic performance due to cyberbullying, requiring some support or intervention.',
                    '[] s academic performance significantly deteriorates due to the emotional toll of cyberbullying, leading to severe distress and long-term negative effects on their educational attainment.'],
            ],
            ['question' => 'Choose the option that best describes [] s characteristics/behaviours.',
                'answer' => ['[] s moderate online activity does not significantly impact their well-being or susceptibility to cyberbullying.',
                    '[] s frequent online activity exposes them to occasional risks or challenges, resulting in some emotional distress or negative experiences.',
                    '[] s extensive online activity increases their vulnerability to severe cyberbullying, leading to significant emotional distress and detrimental consequences to their well-being.'],
            ],
            ['question' => 'Select the answer that most applies to [].',
                'answer' => ['[] never or occasionally experiences minor conflicts or disagreements with peers online.',
                    '[] faces occasional challenges or negative experiences within their peer relationships online, resulting in some emotional distress or minor impact on their social well-being.',
                    '[] experiences severe peer victimisation or exclusion online, leading to significant emotional distress, social isolation, and negative effects on their overall well-being.'],
            ],
            ['question' => 'Please select the answer option that most accurately reflects [].',
                'answer' => ['[] s relationship status has minimal impact on their susceptibility to cyberbullying or well-being.',
                    '[] s casual or short-term relationship status occasionally contributes to some online conflicts or emotional challenges.',
                    '[] s serious or long-term relationship status exposes them to severe cyberbullying, online harassment, or relationship-related conflicts, resulting in significant emotional distress and negative impacts on their well-being.'],
            ]
        ];
        return view('website.auth.signup_6', [
            'childrens' => $childrens,
            'questions' => $questions,
        ]);
    }

    public function signUpStore(SignUpStoreRequest $request)
    {
        $user_childrens = Session::get('child_name');
        $plan = Session::get('create_plan');
        $user = new User();
        $user->name = Session::get('name');
        $user->full_name = Session::get('name');
        $user->term_condition = 1;
        $user->email = Session::get('email');
        $user->password = Hash::make(Session::get('password'));
        $user->save();

        if (!empty($user_childrens)) {
            foreach ($user_childrens as $key => $children) {
                $user_children = new UserChildren();
                $user_children->name = $children;
                $user_children->user_id = $user->id;
                if ($plan[$children] == 'on') {
                    $user_children->is_plan = 1;
                }
                $user_children->save();

                $user_children_detail = new UserChildrenDetail();
                $user_children_detail->user_id = $user->id;
                $user_children_detail->user_children_id = $user_children->id;
                $user_children_detail->age = Session::get('age')[$key];
                $user_children_detail->sex = Session::get('sex')[$key];
                $user_children_detail->current_health = Session::get('current_health')[$key];
                $user_children_detail->previous_health = Session::get('previous_health')[$key];
                $user_children_detail->language = Session::get('language')[$key];
                $user_children_detail->sexual_orientation = Session::get('sexual_orientation')[$key];
                $user_children_detail->family_structure = Session::get('family_structure')[$key];
                $user_children_detail->access_the_internet = Session::get('access_the_internet')[$key];
                $user_children_detail->online_activity_frequency = Session::get('online_activity_frequency')[$key];
                $user_children_detail->online_behaviour = Session::get('online_behaviour')[$key];
                $user_children_detail->geographic_location = Session::get('geographic_location')[$key];
                $user_children_detail->socioeconomic_status = Session::get('socioeconomic_status')[$key];
                $user_children_detail->school_attendance = Session::get('school_attendance')[$key];
                $user_children_detail->parental_involvement = Session::get('parental_involvement')[$key];
                $user_children_detail->support_system = Session::get('support_system')[$key];
                $user_children_detail->peer_relationships = Session::get('peer_relationships')[$key];
                $user_children_detail->relationship_status = Session::get('relationship_status')[$key];
                $user_children_detail->school_climate = Session::get('school_climate')[$key];
                $user_children_detail->academic_performance = Session::get('academic_performance')[$key];
                $user_children_detail->save();

                foreach ($request->question as $q => $question) {
                    $user_question = new UserQuestion();
                    $user_question->question = $question[$key];
                    $user_question->answer = $request->answer[$q][$key];
                    $user_question->user_id = $user->id;
                    $user_question->user_child_id = $user_children->id;
                    $user_question->save();
                }
            }
        }
        Session::forget('name');
        Session::forget('email');
        Session::forget('password');
        Session::forget('create_plan');
        Session::forget('term_condition');
        Session::forget('age');
        Session::forget('sex');
        Session::forget('current_health');
        Session::forget('previous_health');
        Session::forget('language');
        Session::forget('sexual_orientation');
        Session::forget('family_structure');
        Session::forget('access_the_internet');
        Session::forget('online_activity_frequency');
        Session::forget('online_behaviour');
        Session::forget('geographic_location');
        Session::forget('socioeconomic_status');
        Session::forget('school_attendance');
        Session::forget('parental_involvement');
        Session::forget('support_system');
        Session::forget('peer_relationships');
        Session::forget('relationship_status');
        Session::forget('school_climate');
        Session::forget('academic_performance');
        return response()->json([
            'success' => true,
            'message' => 'User Register Successfully'
        ]);
    }

    public function skipStore(SignUp4Request $request)
    {
        $user_childrens = Session::get('child_name');
        $plan = Session::get('create_plan');
        $user = new User();
        $user->name = Session::get('name');
        $user->full_name = Session::get('name');
        $user->term_condition = 1;
        $user->email = Session::get('email');
        $user->password = Hash::make($request->password);
        $user->save();

        if (!empty($user_childrens)) {
            foreach ($user_childrens as $key => $children) {
                $user_children = new UserChildren();
                $user_children->name = $children;
                $user_children->user_id = $user->id;
                $user_children->is_plan = 0;
                $user_children->save();

                $user_children_detail = new UserChildrenDetail();
                $user_children_detail->user_id = $user->id;
                $user_children_detail->user_children_id = $user_children->id;
                $user_children_detail->age = Session::get('age') ? Session::get('age')[$key] : null;
                $user_children_detail->sex = Session::get('sex') ? Session::get('sex')[$key] : null;
                $user_children_detail->current_health = Session::get('current_health') ? Session::get('current_health')[$key] : null;
                $user_children_detail->previous_health = Session::get('previous_health') ? Session::get('previous_health')[$key] : null;
                $user_children_detail->language = Session::get('language') ? Session::get('language')[$key] : null;
                $user_children_detail->sexual_orientation = Session::get('sexual_orientation') ? Session::get('sexual_orientation')[$key] : null;
                $user_children_detail->family_structure = Session::get('family_structure') ? Session::get('family_structure')[$key] : null;
                $user_children_detail->access_the_internet = Session::get('access_the_internet') ? Session::get('access_the_internet')[$key] : null;
                $user_children_detail->online_activity_frequency = Session::get('online_activity_frequency') ? Session::get('online_activity_frequency')[$key] : null;
                $user_children_detail->online_behaviour = Session::get('online_behaviour') ? Session::get('online_behaviour')[$key] : null;
                $user_children_detail->geographic_location = Session::get('geographic_location') ? Session::get('geographic_location')[$key] : null;
                $user_children_detail->socioeconomic_status = Session::get('socioeconomic_status') ? Session::get('socioeconomic_status')[$key] : null;
                $user_children_detail->school_attendance = Session::get('school_attendance') ? Session::get('school_attendance')[$key] : null;
                $user_children_detail->parental_involvement = Session::get('parental_involvement') ? Session::get('parental_involvement')[$key] : null;
                $user_children_detail->support_system = Session::get('support_system') ? Session::get('support_system')[$key] : null;
                $user_children_detail->peer_relationships = Session::get('peer_relationships') ? Session::get('peer_relationships')[$key] : null;
                $user_children_detail->relationship_status = Session::get('relationship_status') ? Session::get('relationship_status')[$key] : null;
                $user_children_detail->school_climate = Session::get('school_climate') ? Session::get('school_climate')[$key] : null;
                $user_children_detail->academic_performance = Session::get('academic_performance') ? Session::get('academic_performance')[$key] : null;
                $user_children_detail->save();
            }
        }
        Session::forget('name');
        Session::forget('email');
        Session::forget('password');
        Session::forget('create_plan');
        Session::forget('term_condition');
        return response()->json([
            'success' => true,
            'message' => 'User Register Successfully'
        ]);
    }

    public function getAttributeRow($rowNo)
    {
        $response = view('website.auth.getAttribute', [
            'rowNo' => $rowNo,
        ])->render();
        return response()->json(['data' => $response]);
    }

    public function getAttributeRowForPlan($rowNo)
    {
        $response = view('website.auth.getAttributeRowForPlan', [
            'rowNo' => $rowNo,
        ])->render();
        return response()->json(['data' => $response]);
    }
}
