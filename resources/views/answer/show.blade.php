{{-- answer\show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Answer</h2>
            <h4>Survey Name[{{ $answer->question->survey->name }}]</h4>
            <h6>Question Name[{{ $answer->question->name }}]</h6>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('answer.index', ['questionId' => $answer->question->id]) }}">Back to Answer</a>
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
@endsection