{{-- survey\display.blade.php --}}


@php
$surveyObject = json_decode($jsonObject);
@endphp
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Survey[{{ $surveyObject->survey->id }}] {{ $surveyObject->survey->name }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            {{ $surveyObject->survey->detail }}
                        </div>
                        <div class="pull-right">
                            {{ $surveyObject->survey->created_at }}
                        </div>

                        @foreach( $surveyObject->question as $question )
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">Question[{{ $question->id }}] {{ $question->name }}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 margin-tb">
                                                <div class="pull-right">
                                                    {{ App\Question::questionTypeToHuman($question->type) }}
                                                </div>
                                                <div class="pull-right">
                                                    {{ $question->detail }}
                                                </div>
                                                <div class="pull-right">
                                                    {{ $question->created_at }}
                                                </div>

                                                @foreach($question->answer as $answer)

                                                @include('actingSurvey.answer')


                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


