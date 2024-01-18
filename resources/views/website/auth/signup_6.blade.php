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
                <div class="col-md-12 width-100">
                    <div class="left-signup info-pragraph">
                        <ul class="pages">
                            @foreach($questions as $key=>$question)
                                <li class="@if($loop->first) active current1 @endif "><span class="span"></span></li>
                            @endforeach
                        </ul>
                        <h1>HackHeroes</h1>
                        <form id="signupStore" method="post">
                            <div id="mains">
                                @foreach($questions as $key=>$question)
                                    <div id="div{{$key+1}}"
                                         class=" @if($loop->first) first current @endif @if($loop->last) last @endif">
                                        @if(!is_null($childrens))
                                            @foreach($childrens as $key1=>$children)
                                                <b>{{str_replace('[]',$children,$question['question'])}}</b>
                                                <div class="text-centers">
                                                    <input type="hidden" class="selected_value"
                                                           name="answer[{{$key}}][{{$key1}}]">
                                                    <input type="hidden" class="question"
                                                           name="question[{{$key}}][{{$key1}}]"
                                                           data-value="{{str_replace('[]',$children,$question['question'])}}"
                                                           value="{{str_replace('[] ','',str_replace('[]','',$question['question']))}}"
                                                           >
                                                    @foreach($question['answer'] as $key3=>$answer)
                                                        <div class="form-check {{ $key3 == 0 ? 'mt-5' : '' }}">
                                                            <input class="form-check-input" type="radio"
                                                                   name="answer[{{$key}}][{{$key1}}]"
                                                                   id="answer_{{$key}}_{{$key1}}_{{$key3}}"
                                                                   data-value="{{str_replace('[]',$children,$answer)}}"
                                                                   value="{{str_replace('[] ','',str_replace('[]','',$answer))}}"
                                                                   required>

                                                            <label class="form-check-label" for="answer_{{$key}}_{{$key1}}_{{$key3}}">
                                                                {{str_replace('[] s',$children."'s",$answer)}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="next-prv-btn">
                                <button type="button" id="prev" class="btn signup-btn link-btn">< Back</button>
                                <button type="button" id="next" class="btn signup-btn link-btn next-btn">Next ></button>
                                <button class="btn signup-btn link-btn d-none" id="signup_store" type="submit">Submit
                                </button>
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
        var child = '{{!is_null($childrens) ? count($childrens) : 0}}'
        $('.next-btn').on('click', function () {

            var currentStep = $('.current');

            if (currentStep.find('input[type=radio]:checked').length < child) {
                notificationToast('Please select any one answer', 'warning');
            } else {
                var checkedRadio = currentStep.find('input[type=radio]:checked');
                var label = currentStep.find('label[for="' + checkedRadio.attr('id') + '"]').text();
                currentStep.find('.selected_value').val(label)
                $('.current').removeClass('current').hide()
                    .next().show().addClass('current');
                $('.current1').removeClass('current1').removeClass('active').next().addClass('active').addClass('current1');
                $("li.current1").prevAll().find('span').addClass('active1');

                if ($('.current').hasClass('last')) {
                    $('#next').css('display', 'none');
                    $('#signup_store').removeClass('d-none');
                }
                $('#prev').css('display', 'inline-block');
            }
        })
    </script>
    <script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection

