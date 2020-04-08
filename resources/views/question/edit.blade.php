{{-- question\edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Question</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('question.index', ['surveyId' => $question->survey->id]) }}">Back to Question</a>
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

<form action="{{ route('question.update', $question->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        {{-- Name --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $question->name }}" class="form-control" placeholder="Name">
            </div>
        </div>

        {{-- Type --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type:</strong>
                <select name="type" id="type" class="form-control">
                    @foreach($questionType as $id => $type )
                    <option value="{{ $id }}" {{ $question->type == $id ? 'selected' : '' }}>{{ $type }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Detail --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $question->detail }}</textarea>
            </div>
        </div>

        {{-- Submit --}}        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection