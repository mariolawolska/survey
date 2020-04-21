{{-- answer\edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Answer</h2>
            <h4>Survey Name[{{ $answer->question->survey->name }}]</h4>
            <h6>Question Name[{{ $answer->question->name }}]</h6>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('answer.index', ['questionId' => $answer->question->id]) }}">Back to Answer</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('answer.update', $answer->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        {{-- Name --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $answer->name }}" class="form-control" placeholder="Name">
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $answer->detail }}</textarea>
            </div>
        </div>

        {{-- Submit --}}        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection