{{-- answer\show.blade.php --}}

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
                            <h3>Show Answer</h3>
                            <h5>Survey Name[{{ $answer->question->survey->name }}]</h5>
                            <h5>Question Name[{{ $answer->question->name }}]</h5>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('answer.index', ['questionId' => $answer->question->id]) }}"><button class="forward">Back to Answer</button></a>
                        </div>
                        <div class="mb-5 w-50 float-left pb-3 b-line"</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $answer->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Details:</strong>
                        {{ $answer->detail }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection