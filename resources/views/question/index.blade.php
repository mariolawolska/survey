{{-- question\index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <h4>Survey Name[{{ $survey->name }}]</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('question.create') }}">Create New Question</a>
        </div>
    </div>
</div>

<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('survey.index') }}">Back to Survey</a>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Type</th>
        <th>Details</th>
        <th>Answers</th>
        <th>Created</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($questionCollection as $question)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $question->name }}</td>
        <td>{{ $question->questionTypeToHuman() }}</td>
        <td>{{ $question->detail }}</td>
        <td>{{ $question->answer->count() }}</td>
        <td>{{ $question->created_at }}</td>

        <td>
            <form action="{{ route('question.destroy',$question->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('answer.create',['questionId'=> $question->id]) }}">Add Answers</a>
                <a class="btn btn-info" href="{{ route('answer.index',['questionId'=> $question->id]) }}">Show Answers</a>

                <a class="btn btn-info" href="{{ route('question.show', $question->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('question.edit', $question->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $questionCollection->links() !!}

@endsection