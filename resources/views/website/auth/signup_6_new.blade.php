@extends('website.layouts.auth.master')
@section('title')
Signup
@endsection
@section('content')
<style>
    #page-body {
        height: auto;
        min-height: auto;
    }
</style>
<section id="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 width-100">
                <div class="left-signup info-pragraph">
                    <ul class="pages">
                        @foreach($childrens as $key1=>$children)
                        @foreach($questions as $key=>$question)
                        <li class="@if($loop->parent->first && $loop->first) active current1 @endif "><span class="span"></span>
                        </li>
                        @endforeach
                        @endforeach
                    </ul>
                    <h1>HackHeroes</h1>
                    <form id="signupStore" method="post">
                        <div id="mains">
                            @if(!is_null($childrens))
                            @php
                            $count = 0;
                            $count_child = 0;
                            @endphp
                            @foreach($childrens as $key1=>$children)
                            @foreach($questions as $key=>$question)
                            @php
                            $count++;
                            @endphp
                            <div id="div-{{$count}}" class="qa-sec" style="{{$count==1 ? '' : 'display:none;' }}">
                                <b>{!!str_replace('[]',$children,$question['question'])!!}</b>
                                <div class="text-centers">
                                    <input type="hidden" class="selected_value" name="answer[{{$key1}}][]">
                                    <input type="hidden" class="question" name="question[{{$key1}}][]" data-value="{{str_replace('[]',$children,$question['question'])}}" value="{{str_replace('[] ','',str_replace('[]','',$question['question']))}}">
                                    @foreach($question['answer'] as $key3=>$answer)
                                    <div class="form-check {{ $key3 == 0 ? 'mt-5' : '' }}">
                                        <input class="form-check-input update-answer" type="radio" name="radio_answer[{{$key1}}][]" id="answer_{{$key}}_{{$key1}}_{{$key3}}" data-value="{{str_replace('[]',$children,$answer)}}" value="{{trim(str_replace('[]&apos;s','',str_replace('[] ','',str_replace('[]','',$answer))))}}" required>

                                        <label class="form-check-label" for="answer_{{$key}}_{{$key1}}_{{$key3}}" data-value="{{trim(str_replace('[]&apos;s','',str_replace('[] ','',str_replace('[]','',$answer))))}}">
                                            {!!str_replace('[]',$children,$answer)!!}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            @endforeach
                            @endforeach
                            @endif
                        </div>
                        <div class="next-prv-btn">
                            <button type="button" id="prev" class="btn signup-btn link-btn">&lt; Back</button>
                            <button type="button" id="next" class="btn signup-btn link-btn next-btn">Next &gt;</button>
                            <button class="btn signup-btn link-btn d-none" id="signup_store" type="submit">Submit</button>
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
    $('.update-answer').click(function(){        
        $(this).closest('.qa-sec').find('.selected_value').val($(this).val());
    });

    var child = '{{!is_null($childrens) ? count($childrens) : 0}}'
    $('.next-btn').on('click', function() {
        var currentStep = $('.qa-sec:visible');
        if (currentStep.find('input[type=radio]:checked').length < 1) {
            notificationToast('Please select any one answer', 'warning');
        } else {
            var checkedRadio = currentStep.find('input[type=radio]:checked');
            var label = currentStep.find('label[for="' + checkedRadio.attr('id') + '"]').attr('data-value');
            // currentStep.find('.selected_value').val(label)
            // $('.current').removeClass('current').hide().next().show().addClass('current');
            // $('.current1').removeClass('current1').removeClass('active').next().addClass('active').addClass('current1');
            // $("li.current1").prevAll().find('span').addClass('active1');
            currentStep.hide();
            currentStep.next('.qa-sec').show();
            $('.pages').find('li.active').next('li').addClass('active').addClass('current1');
            if ($('.pages').find('li').length == $('.pages').find('li.active').length) {
                $('#next').css('display', 'none');
                $('#signup_store').removeClass('d-none');
            }            
            $('#prev').css('display', 'inline-block');
        }
    })
</script>
<script src="{{asset('assets/web/custom/signup.js')}}?v={{time()}}"></script>
@endsection