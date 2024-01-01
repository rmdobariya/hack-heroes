@extends('website.layouts.auth.master')
@section('title')
    Signup
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 width-100 bg-thm">
                    <div class="left-signup info-pragraph selection-dropdown full-w">
                        <h1>HackHeroes</h1>
                        <form id="signup6" method="post">
                            @if(!is_null($childrens))
                                @foreach($childrens as $key=>$children)
                                    <b>Please select the option that you feel best represents {{$children}}</b>
                                    <div class="text-center">
                                        <p>{{$children}} is
                                            <select name="age[{{$key}}]" class="form-control form-select" required>
                                                <option value="14-17 years old" selected>14-17 years old</option>
                                                <option value="10-13 years old">10-13 years old</option>
                                                <option value="6-9 years old">6-9 years old</option>
                                            </select>
                                            <img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                            and was assigned
                                            <select name="sex[{{$key}}]" class="form-control form-select" required>
                                                <option value="male" selected>male</option>
                                                <option value="intersex">intersex</option>
                                                <option value="female">female</option>
                                            </select>
                                            <img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                            at birth. They have
                                            <select name="current_health[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="no known mental health conditions" selected>no known mental health conditions</option>
                                                <option value="mild anxiety or depression">mild anxiety or depression</option>
                                                <option value="severe anxiety or depression, or other mental health conditions that impact their daily life">severe anxiety or depression, or other mental health conditions that impact their daily life</option>

                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            and
                                            <select name="previous_health[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="no history of mental health issues" selected>no history of mental health issues</option>
                                                <option value="a family history of mental health issues">a family history of mental health issues</option>
                                                <option value="a personal history of mental health issues">a personal history of mental health issues</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            . {{$children}} speaks
                                            <select name="language[{{$key}}]" class="form-control form-select" required>
                                                <option value="the dominant language in their community" selected>the dominant language in their community</option>
                                                <option value="a second language, but is fluent in the dominant language">a second language, but is fluent in the dominant language</option>
                                                <option value="a language other than the dominant language in their community, and may struggle with communication">a language other than the dominant language in their community, and may struggle with communication</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            , identifies as
                                            <select name="sexual_orientation[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="heterosexual" selected>heterosexual</option>
                                                <option value="questioning or unsure of their sexual orientation">questioning or unsure of their sexual orientation</option>
                                                <option value="LGBTQIA+">LGBTQIA+</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            , and comes from a
                                            <select name="family_structure[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="two-parent household with a stable and supportive family environment" selected>two-parent household with a stable and supportive family environment
                                                </option>
                                                <option value="single-parent household, but has a stable and supportive family environment">single-parent household, but has a stable and supportive family environment</option>
                                                <option value="single-parent household with a less stable or unsupportive family environment">single-parent household with a less stable or unsupportive family environment</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            . They primarily use type of device used to
                                            <select name="access_the_internet[{{$key}}]"
                                                    class="form-control form-select" required>
                                                <option value="desktop computer or laptop" selected>desktop computer or laptop</option>
                                                <option value="variety of devices, including smartphones and tablets,">variety of devices, including smartphones and tablets,</option>
                                                <option value="smartphone or tablet">smartphone or tablet</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            to access the internet, spend a
                                            <select name="online_activity_frequency[{{$key}}]"
                                                    class="form-control form-select"
                                                    required>
                                                <option value="moderate amount of time (less than 2 hours)" selected>moderate amount of time (less than 2 hours)</option>
                                                <option value="significant amount of time (2-4 hours)">significant amount of time (2-4 hours)</option>
                                                <option value="large amount of time (more than 4 hours)">large amount of time (more than 4 hours)</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            online each day, and
                                            <select name="online_behaviour[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="are cautious and responsible online, and avoid risky behaviour" selected>are cautious and responsible online, and avoid risky behaviour
                                                </option>
                                                <option value="engage in some risky behaviour online, such as sharing personal information with strangers or visiting potentially harmful websites">engage in some risky behaviour online, such as sharing personal information with strangers or visiting potentially harmful websites
                                                </option>
                                                <option value="engage in frequent risky behaviour online, such as cyberbullying others or engaging with strangers online without parental supervision">engage in frequent risky behaviour online, such as cyberbullying others or engaging with strangers online without parental supervision
                                                </option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            . {{$children}} lives in a
                                            <select name="geographic_location[{{$key}}]"
                                                    class="form-control form-select" required>
                                                <option value="rural" selected>rural</option>
                                                <option value="suburban">suburban</option>
                                                <option value="urban">urban</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            area, comes from a
                                            <select name="socioeconomic_status[{{$key}}]"
                                                    class="form-control form-select" required>
                                                <option value="upper-class or high socioeconomic status" selected>upper-class or high socioeconomic status</option>
                                                <option value="middle-class">middle-class</option>
                                                <option value="lower socioeconomic status">lower socioeconomic status</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">

                                            family, and attends school
                                            <select name="school_attendance[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="irregularly or are homeschooled" selected>irregularly or are homeschooled</option>
                                                <option value="regularly, but have occasional absences">regularly, but have occasional absences</option>
                                                <option value="regularly with no or very few absences">regularly with no or very few absences</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            . I
                                            <select name="parental_involvement[{{$key}}]"
                                                    class="form-control form-select" required>
                                                <option value="am highly involved in  {{$children}} s online activities and closely monitor  {{$children}} s online behaviour" selected>am highly involved in  {{$children}} s online activities and closely monitor  {{$children}} s online behaviour
                                                </option>
                                                <option value="have some some level of involvement in  {{$children}} s online activities, but do not monitor them closely">have some some level of involvement in  {{$children}} s online activities, but do not monitor them closely
                                                </option>
                                                <option value="am not involved in {{$children}} s online activities">am not involved in {{$children}} s online activities
                                                </option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            . {{$children}} has
                                            <select name="support_system[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="a strong support system, including family members, friends, and other adults who provide emotional support" selected>a strong support system, including family members, friends, and other adults who provide emotional support</option>
                                                <option value="some supportive relationships, but may lack a strong support system">some supportive relationships, but may lack a strong support system</option>
                                                <option value="few or no supportive relationships">few or no supportive relationships</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            and
                                            <select name="peer_relationships[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="positive and supportive" selected>positive and supportive</option>
                                                <option value="some issues (e.g. occasional conflicts or disagreements) with">some issues (e.g. occasional conflicts or disagreements) with
                                                </option>
                                                <option value="significant issues (e.g. being excluded or bullied by peers) with">significant issues (e.g. being excluded or bullied by peers) with
                                                </option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            peer relationships. {{$children}} is
                                            <select name="relationship_status[{{$key}}]"
                                                    class="form-control form-select" required>
                                                <option value="not in a romantic relationship" selected>not in a romantic relationship</option>
                                                <option value="in a casual or short-term romantic relationship">in a casual or short-term romantic relationship</option>
                                                <option value="in a serious or long-term romantic relationship">in a serious or long-term romantic relationship</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            . Their school has
                                            <select name="school_climate[{{$key}}]" class="form-control form-select"
                                                    required>
                                                <option value="a positive and supportive climate, with a low incidence of bullying and harassment" selected>a positive and supportive climate, with a low incidence of bullying and harassment
                                                </option>
                                                <option value="
                                                some issues with bullying and harassment, but takes steps to address these issues">some issues with bullying and harassment, but takes steps to address these issues</option>
                                                <option value="a negative or unsupportive climate, with a high incidence of bullying and harassment">a negative or unsupportive climate, with a high incidence of bullying and harassment</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            . They are
                                            <select name="academic_performance[{{$key}}]"
                                                    class="form-control form-select" required>
                                                <option value="performing well academically and are not struggling in school" selected>performing well academically and are not struggling in school
                                                </option>
                                                <option value="experiencing some academic difficulties, such as low grades or behavioural issues">experiencing some academic difficulties, such as low grades or behavioural issues</option>
                                                <option value="experiencing significant academic difficulties and are at risk of academic failure or dropping out of school">experiencing significant academic difficulties and are at risk of academic failure or dropping out of school</option>
                                            </select><img src="{{asset('assets/web/images/down-arrow.png')}}"
                                                          alt="down-arrow">
                                            .
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                            <div class="text-center">
                                <button class="btn signup-btn" type="submit">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script>
        function add() {
            var new_chq_no = parseInt($('#total_chq').val()) + 1;
            var new_input = "<div class='input-box'><div class='form-check'><input name='name_" + new_chq_no + "'  class='form-check-input' type='checkbox' id='new_" + new_chq_no + "'><label class='form-check-label' for='new_" + new_chq_no + "'>Alex</label></div></div>";
            //var new_input="<input type='text' class='form-control' placeholder='Child’s first name' id='new_"+new_chq_no+"'>";
            $('#new_chq').append(new_input);
            $('#total_chq').val(new_chq_no)
        }

        function remove() {
            var last_chq_no = $('#total_chq').val();
            if (last_chq_no > 1) {
                $('#new_' + last_chq_no).remove();
                $('#total_chq').val(last_chq_no - 1);
            }
        }
    </script>
    <script>
        $('select').change(function () {
            var text = $(this).find('option:selected').text()
            var $aux = $('<select/>').append($('<option/>').text(text))
            $(this).after($aux)
            $(this).width($aux.width() - 10)
            $aux.remove()
        }).change()
    </script>
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection

