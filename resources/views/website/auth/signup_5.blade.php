@extends('website.layouts.auth.master')
@section('title')
    Signup
@endsection
@section('content')
    <section id="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 width-100">
                    <div class="left-signup info-pragraph selection-dropdown">
                        <h1>HackHeroes</h1>
                        <b>Please select the option that you feel best represents Alex</b>
                        <div class="text-center">
                            <form id="signup6" method="post">
                                <p>Alex is
                                    <select name="age" class="form-control form-select" required>
                                        <option>age</option>
                                        <option value="14-17 years old">14-17 years old</option>
                                        <option value="10-13 years old">10-13 years old</option>
                                        <option value="6-9 years old">6-9 years old</option>
                                    </select>
                                    <img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    and was assigned
                                    <select name="sex" class="form-control form-select" required>
                                        <option>sex</option>
                                        <option value="Child was assigned male at birth">Child was assigned male at birth</option>
                                        <option value="Child was assigned intersex at birth">Child was assigned intersex at birth</option>
                                        <option value="Child was assigned female at birth">Child was assigned female at birth</option>
                                    </select>
                                    <img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">at birth. They have
                                    <select name="current_health" class="form-control form-select" required>
                                        <option>current mental health</option>
                                        <option value="Child has no known mental health conditions">Child has no known mental health conditions</option>
                                        <option value="Child has mild anxiety or depression">Child has mild anxiety or depression</option>
                                        <option value="Child has severe anxiety or depression, or other mental health conditions that impact their daily life">Child has severe anxiety or depression, or other mental health conditions that impact their daily life</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    and
                                    <select name="previous_health" class="form-control form-select" required>
                                        <option>previous mental health</option>
                                        <option value="Child has no history of mental health issues">Child has no history of mental health issues</option>
                                        <option value="Child has a family history of mental health issues">Child has a family history of mental health issues</option>
                                        <option value="Child has a personal history of mental health issues">Child has a personal history of mental health issues</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    . Alex speaks
                                    <select name="language" class="form-control form-select" required>
                                        <option>language</option>
                                        <option value="Child speaks the dominant language in their community">Child speaks the dominant language in their community</option>
                                        <option value="Child speaks a second language, but is fluent in the dominant language">Child speaks a second language, but is fluent in the dominant language</option>
                                        <option value="Child speaks a language other than the dominant language in their community, and may struggle with communication">Child speaks a language other than the dominant language in their community, and may struggle with communication</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    , identifies as
                                    <select name="sexual_orientation" class="form-control form-select" required>
                                        <option>Sexual Orientation</option>
                                        <option value="Child identifies as heterosexual">Child identifies as heterosexual</option>
                                        <option value="Child identifies as questioning or unsure of their sexual orientation">Child identifies as questioning or unsure of their sexual orientation</option>
                                        <option value="Child identifies as LGBTQIA">Child identifies as LGBTQIA+</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    , and comes from a
                                    <select name="family_structure" class="form-control form-select" required>
                                        <option>family structure</option>
                                        <option value="Child comes from a two-parent household with a stable and supportive family environment">Child comes from a two-parent household with a stable and supportive family environment</option>
                                        <option value="Child comes from a single-parent household, but has a stable and supportive family environment">Child comes from a single-parent household, but has a stable and supportive family environment</option>
                                        <option value="Child comes from a single-parent household with a less stable or unsupportive family environment">Child comes from a single-parent household with a less stable or unsupportive family environment</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    . They primarily use type of device used to
                                    <select name="access_the_internet" class="form-control form-select" required>
                                        <option>access the internet</option>
                                        <option value="Child primarily uses a desktop computer or laptop to access the Internet">Child primarily uses a desktop computer or laptop to access the Internet</option>
                                        <option value="Child uses a variety of devices to access the Internet, including smartphones and tablets">Child uses a variety of devices to access the Internet, including smartphones and tablets</option>
                                        <option value="Child primarily uses a smartphone or tablet to access the Internet">Child primarily uses a smartphone or tablet to access the Internet</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">

                                    to access the internet, spend a
                                    <select name="online_activity_frequency" class="form-control form-select" required>
                                        <option>online activity frequency</option>
                                        <option value="Child spends a moderate amount of time online each day (less than 2 hours)">Child spends a moderate amount of time online each day (less than 2 hours)</option>
                                        <option value="Child spends a significant amount of time online each day (2-4 hours)">Child spends a significant amount of time online each day (2-4 hours)</option>
                                        <option value="Child spends a large amount of time online each day (more than 4 hours)">Child spends a large amount of time online each day (more than 4 hours)</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    online each day, and
                                    <select name="online_behaviour" class="form-control form-select" required>
                                        <option>online behaviour</option>
                                        <option value="Child is cautious and responsible online, and avoids risky behaviour">Child is cautious and responsible online, and avoids risky behaviour</option>
                                        <option value="Child engages in some risky behaviour online, such as sharing personal information with strangers or visiting potentially harmful websites">Child engages in some risky behaviour online, such as sharing personal information with strangers or visiting potentially harmful websites</option>
                                        <option value="Child engages in frequent risky behaviour online, such as cyberbullying others or engaging with strangers online without parental supervision">Child engages in frequent risky behaviour online, such as cyberbullying others or engaging with strangers online without parental supervision</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">

                                    . Alex lives in a
                                    <select name="geographic_location" class="form-control form-select" required>
                                        <option>geographic location</option>
                                        <option value="Child lives in a rural area">Child lives in a rural area</option>
                                        <option value="Child lives in a suburban area">Child lives in a suburban area</option>
                                        <option value="Child lives in an urban area">Child lives in an urban area</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    area, comes from a
                                    <select name="socioeconomic_status" class="form-control form-select" required>
                                        <option>socioeconomic status</option>
                                        <option value="Child comes from an upper-middle or High socioeconomic status family">Child comes from an upper-middle or High socioeconomic status family</option>
                                        <option value="Child comes from a middle-class family">Child comes from a middle-class family</option>
                                        <option value="Child comes from a lower socioeconomic status family">Child comes from a lower socioeconomic status family</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">

                                    family, and attends school
                                    <select name="school_attendance" class="form-control form-select" required>
                                        <option>school attendance</option>
                                        <option value="Child attends school irregularly or is homeschooled">Child attends school irregularly or is homeschooled</option>
                                        <option value="Child attends school regularly, but has occasional absences">Child attends school regularly, but has occasional absences</option>
                                        <option value="Child attends school regularly with no or very few absences.">Child attends school regularly with no or very few absences.</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    . I
                                    <select name="parental_involvement" class="form-control form-select" required>
                                        <option>parental involvement</option>
                                        <option value="Parents are involved in their child's online activities and closely monitor their child's online behaviour">Parents are involved in their child's online activities and closely monitor their child's online behaviour </option>
                                        <option value="Parents have some level of involvement in their child's online activities, but do not monitor them closely">Parents have some level of involvement in their child's online activities, but do not monitor them closely</option>
                                        <option value="Parents are not involved in their child's online activities">Parents are not involved in their child's online activities</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    . Alex has
                                    <select name="support_system" class="form-control form-select" required>
                                        <option>support system</option>
                                        <option value="Child has a strong support system, including family members, friends, and other adults who provide emotional support">Child has a strong support system, including family members, friends, and other adults who provide emotional support </option>
                                        <option value="Child has some supportive relationships, but may lack a strong support system">Child has some supportive relationships, but may lack a strong support system</option>
                                        <option value="Child has few or no supportive relationships">Child has few or no supportive relationships</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    and
                                    <select name="peer_relationships" class="form-control form-select" required>
                                        <option>peer relationships</option>
                                        <option value="Child has positive and supportive peer relationships">Child has positive and supportive peer relationships</option>
                                        <option value="Child has some issues with peer relationships, such as occasional conflicts or disagreements">Child has some issues with peer relationships, such as occasional conflicts or disagreements</option>
                                        <option value="Child has significant issues with peer relationships, such as being excluded or bullied by peers">Child has significant issues with peer relationships, such as being excluded or bullied by peers</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    peer relationships. Alex is
                                    <select name="relationship_status" class="form-control form-select" required>
                                        <option>relationship status</option>
                                        <option value="Child is not in a romantic relationship">Child is not in a romantic relationship</option>
                                        <option value="Child is in a casual or short-term romantic relationship">Child is in a casual or short-term romantic relationship</option>
                                        <option value="Child is in a serious or long-term romantic relationship">Child is in a serious or long-term romantic relationship</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    . Their school has
                                    <select name="school_climate" class="form-control form-select" required>
                                        <option>school climate</option>
                                        <option value="School has a positive and supportive climate, with a Unlikely incidence of bullying and harassment">School has a positive and supportive climate, with a Unlikely incidence of bullying and harassment</option>
                                        <option value="School has some issues with bullying and harassment, but takes steps to address these issues">School has some issues with bullying and harassment, but takes steps to address these issues</option>
                                        <option value="School has a negative or unsupportive climate, with a Likely incidence of bullying and harassment">School has a negative or unsupportive climate, with a Likely incidence of bullying and harassment</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    . They are
                                    <select name="academic_performance" class="form-control form-select" required>
                                        <option>academic performance</option>
                                        <option value="Child is performing well academically and is not struggling in school">Child is performing well academically and is not struggling in school</option>
                                        <option value="Child is experiencing some academic difficulties, such as low grades or behavioural issues">Child is experiencing some academic difficulties, such as low grades or behavioural issues</option>
                                        <option value="Child is experiencing significant academic difficulties and is at risk of academic failure or dropping out of school">Child is experiencing significant academic difficulties and is at risk of academic failure or dropping out of school</option>
                                    </select><img src="{{asset('assets/web/images/down-arrow.png')}}" alt="down-arrow">
                                    .</p>
                                <button class="btn signup-btn" type="submit">Continue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    <script>
        function add(){
            var new_chq_no = parseInt($('#total_chq').val())+1;
            var new_input="<div class='input-box'><div class='form-check'><input name='name_"+new_chq_no+"'  class='form-check-input' type='checkbox' id='new_"+new_chq_no+"'><label class='form-check-label' for='new_"+new_chq_no+"'>Alex</label></div></div>";
            //var new_input="<input type='text' class='form-control' placeholder='Child’s first name' id='new_"+new_chq_no+"'>";
            $('#new_chq').append(new_input);
            $('#total_chq').val(new_chq_no)
        }
        function remove(){
            var last_chq_no = $('#total_chq').val();
            if(last_chq_no>1){
                $('#new_'+last_chq_no).remove();
                $('#total_chq').val(last_chq_no-1);
            }
        }
    </script>
    <script>
        $('select').change(function(){
            var text = $(this).find('option:selected').text()
            var $aux = $('<select/>').append($('<option/>').text(text))
            $(this).after($aux)
            $(this).width($aux.width() - 10)
            $aux.remove()
        }).change()
    </script>
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection
