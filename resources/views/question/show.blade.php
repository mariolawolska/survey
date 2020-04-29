{{-- question\show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}
        @include('layouts.frame.content.leftWrapper')
        <!-- /content-left-wrapper -->

        <div class="col-lg-6 content-right mt-3" id="start">
            <div id="containert">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="mb-5 text-right">
                            <h3>Show Question</h3>
                            <h5>Survey Name[{{ $question->survey->name }}]</h5>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('question.index', ['surveyId' => $question->survey->id]) }}"><button class="forward">Back to Question</button></a>
                        </div>
                        <div class="mb-5 w-50 float-left pb-3 b-line"></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $question->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ App\Question::questionTypeToHuman($question->type) }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Details:</strong>
                            {{ $question->detail }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection