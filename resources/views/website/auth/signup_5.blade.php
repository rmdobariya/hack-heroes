@extends('website.layouts.auth.master')
@section('title')
    Signup
@endsection
@section('content')
    <style>
        #page-body {height: auto;min-height: auto;}
    </style>
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
                                            <select name="age[{{$key}}]" class="custom-select" required>
                                                <option value="14-17 years old" selected>14-17</option>
                                                <option value="10-13 years old">10-13</option>
                                                <option value="6-9 years old">6-9</option>
                                            </select>                                            
                                            years old and was assigned
                                            <select name="sex[{{$key}}]" class="custom-select" required>
                                                <option value="male" selected>male</option>
                                                <option value="intersex">intersex</option>
                                                <option value="female">female</option>
                                            </select>                                            
                                            at birth. They have
                                            <select name="current_health[{{$key}}]" class="custom-select" required>
                                                <option value="no known mental health conditions" selected>no known</option>
                                                <option value="mild anxiety or depression">a mild</option>
                                                <option value="severe anxiety or depression, or other mental health conditions that impact their daily life">a severe</option>
                                            </select>
                                            mental health condition(s) and
                                            <select name="previous_health[{{$key}}]" class="custom-select" required>
                                                <option value="no history of mental health issues" selected>no</option>
                                                <option value="a family history of mental health issues">a family</option>
                                                <option value="a personal history of mental health issues">a personal</option>
                                            </select>
                                            history of mental health issues. {{$children}} speaks a
                                            <select name="language[{{$key}}]" class="custom-select" required>
                                                <option value="the dominant language in their community" selected>dominant community</option>
                                                <option value="a second language, but is fluent in the dominant language">dominant plus second</option>
                                                <option value="a language other than the dominant language in their community, and may struggle with communication">non-dominant</option>
                                            </select>
                                            language, identifies as
                                            <select name="sexual_orientation[{{$key}}]" class="custom-select" required>
                                                <option value="heterosexual" selected>heterosexual</option>
                                                <option value="questioning or unsure of their sexual orientation">questioning</option>
                                                <option value="LGBTQIA+">LGBTQIA+</option>
                                            </select>
                                            , and comes from a
                                            <select name="family_structure[{{$key}}]" class="custom-select" required>
                                                <option value="two-parent household with a stable and supportive family environment" selected>supportive two-</option>
                                                <option value="single-parent household, but has a stable and supportive family environment">supportive single-</option>
                                                <option value="single-parent household with a less stable or unsupportive family environment">unsupportive single-</option>
                                            </select>
                                            parent household. They primarily use a
                                            <select name="access_the_internet[{{$key}}]" class="custom-select" required>
                                                <option value="desktop computer or laptop" selected>computer/laptop</option>
                                                <option value="variety of devices, including smartphones and tablets,">variety of devices</option>
                                                <option value="smartphone or tablet">smartphone/tablet</option>
                                            </select>
                                            to access the internet, spend
                                            <select name="online_activity_frequency[{{$key}}]" class="custom-select" required>
                                                <option value="moderate amount of time (less than 2 hours)" selected>&lt;2</option>
                                                <option value="significant amount of time (2-4 hours)"> 2-4</option>
                                                <option value="large amount of time (more than 4 hours)">&gt;4</option>
                                            </select>
                                            hours online each day, and engage in
                                            <select name="online_behaviour[{{$key}}]" class="custom-select" required>
                                                <option value="are cautious and responsible online, and avoid risky behaviour"selected>minimal</option>
                                                <option value="engage in some risky behaviour online, such as sharing personal information with strangers or visiting potentially harmful websites">some</option>
                                                <option value="engage in frequent risky behaviour online, such as cyberbullying others or engaging with strangers online without parental supervision">frequent</option>
                                            </select>
                                            risky online behaviour. {{$children}} lives in a
                                            <select name="geographic_location[{{$key}}]"
                                                    class="custom-select" required>
                                                <option value="urban" selected>urban</option>
                                                <option value="suburban">suburban</option>
                                                <option value="rural">rural</option>
                                            </select>
                                            area, comes from a
                                            <select name="socioeconomic_status[{{$key}}]" class="custom-select" required>
                                                <option value="upper-class or high socioeconomic status" selected>upper-</option>
                                                <option value="middle-class">middle-</option>
                                                <option value="lower socioeconomic status">working-</option>
                                            </select>
                                            class family, and attends school
                                            <select name="school_attendance[{{$key}}]" class="custom-select" required>
                                                <option value="irregularly or are homeschooled" selected>irregularly</option>
                                                <option value="regularly, but have occasional absences">regularly</option>
                                                <option value="regularly with no or very few absences">always</option>
                                            </select>
                                            . I
                                            <select name="parental_involvement[{{$key}}]" class="custom-select" required>
                                                <option value="am highly involved in child's online activities and closely monitor child's online behaviour" selected>closely</option>
                                                <option value="have some some level of involvement in child's online activities, but do not monitor them closely">somewhat</option>
                                                <option value="am not involved in child's online activities">don't</option>
                                            </select>
                                            monitor {{$children}}'s' online activities. {{$children}} has a
                                            <select name="support_system[{{$key}}]" class="custom-select" required>
                                                <option value="a strong support system, including family members, friends, and other adults who provide emotional support" selected>weak</option>
                                                <option value="some supportive relationships, but may lack a strong support system">moderate</option>
                                                <option value="few or no supportive relationships">strong</option>
                                            </select>
                                            support system, has
                                            <select name="peer_relationships[{{$key}}]" class="custom-select" required>
                                                <option value="positive and supportive" selected>positive</option>
                                                <option value="some issues (e.g. occasional conflicts or disagreements) with">mixed-quality</option>
                                                <option value="significant issues (e.g. being excluded or bullied by peers) with">nagative</option>
                                            </select>
                                            peer relationships, and is
                                            <select name="relationship_status[{{$key}}]" class="custom-select" required>
                                                <option value="not in a romantic relationship" selected>not in a</option>
                                                <option value="in a casual or short-term romantic relationship">in a casual</option>
                                                <option value="in a serious or long-term romantic relationship">in a serious</option>
                                            </select>
                                            romantic relationship. Their school has a
                                            <select name="school_climate[{{$key}}]" class="custom-select" required>
                                                <option value="a positive and supportive climate, with a low incidence of bullying and harassment" selected>positive</option>
                                                <option value="some issues with bullying and harassment, but takes steps to address these issues">mixed-quality</option>
                                                <option value="a negative or unsupportive climate, with a high incidence of bullying and harassment">negative</option>
                                            </select>
                                            climate. {{$children}} is
                                            <select name="academic_performance[{{$key}}]" class="custom-select" required>
                                                <option value="performing well academically and are not struggling in school" selected>performing well</option>
                                                <option value="experiencing some academic difficulties, such as low grades or behavioural issues">moderately performing</option>
                                                <option value="experiencing significant academic difficulties and are at risk of academic failure or dropping out of school">struggling</option>
                                            </select>
                                            academically.
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

        // $('select').change(function () {
        //     var text = $(this).find('option:selected').text()
        //     var $aux = $('<select/>').append($('<option/>').text(text))
        //     $(this).after($aux)
        //     $(this).width($aux.width() - 10)
        //     $aux.remove()
        // }).change()
        $(document).ready(function () {
			$('select').change(function () {
				var text = $(this).find('option:selected').text()
				var $aux = $('<select/>').append($('<option/>').text(text))
				$(this).after($aux)
				$(this).width($aux.width())
				$aux.remove()
			});

			setTimeout(function () {
				$('select').each(function () {
					var text = $(this).find('option:first').text()
					console.log(text);
					var $aux = $('<select/>').append($('<option/>').text(text))
					$(this).after($aux)
					$(this).width($aux.innerWidth())
					$aux.remove()
				});
			}, 1000);
		});
    </script>
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection

