{{-- survey\display.blade.php --}}


@php
$surveyObject = json_decode($jsonObject);
@endphp
<!--<div class="row justify-content-center">-->
<!--<div class="col-md-12">-->
<!--<div class="">-->
<!--<div class="card-header">Survey[{{ $surveyObject->survey->id }}] {{ $surveyObject->survey->name }}</div>-->
<!--<div class="card-body">-->
<!--            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <p class="pull-right">
                        {{ $surveyObject->survey->detail }}
                    </p>
                    <p class="pull-right">
                        {{ $surveyObject->survey->created_at }}
                    </p>-->
<div id="top-wizard">
    <div id="progressbar"></div>
</div>
<!-- /top-wizard -->
<form id="wrapped" method="POST">
    <input id="website" name="website" type="text" value="">
    <!-- Leave for security protection, read docs for details -->
    <div id="middle-wizard">


        @foreach( $surveyObject->question as $question )
        @php

        //        dump(\App\Question::isSubQuestion($question));
        dump(\App\Question::hasSubQuestion($question));

        @endphp


        <div class="step">
            <h3 class="main_question">Question[{{ $question->id }}] {{ $question->name }}</h3>

            <!--                                    <div class="row">
                                                    <div class="col-lg-12 margin-tb">-->
            <!--                                            <div class="pull-right">
                                                            {{ App\Question::questionTypeToHuman($question->type) }}
                                                        </div>
                                                        <div class="pull-right">
                                                            {{ $question->detail }}
                                                        </div>
                                                        <div class="pull-right">
                                                            {{ $question->created_at }}
                                                        </div>-->

            @foreach($question->answer as $answer)

            @include('actingSurvey.answer')


            @endforeach

            <!--                                        </div>
                                                </div>-->
        </div>
        @endforeach


    </div>

    <div id="bottom-wizard">
        <!-- /middle-wizard -->
        <a href="{{ route('survey.index') }}"><button type="button" name="backward" class="backward">Prev</button></a>
        <button type="button" name="forward" class="forward">Next</button>
        <button type="submit" name="process" class="submit">Submit</button>
        <!-- /bottom-wizard -->
    </div>

</form>

<!--                </div>
            </div>-->
<!--</div>-->

<!--    </div>
</div>-->


