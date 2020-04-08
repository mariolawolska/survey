{{-- answer\index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <h4>Survey Name[{{ $survey->name }}]</h4>
            <h6>Question Name[{{ $question->name }}]</h6>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('answer.create') }}">Create New Answer</a>
        </div>
    </div>
</div>

<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('question.index',['surveyId'=>$survey->id]) }}">Back to Question</a>
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
        <th>Details</th>
        <th>Created</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($answerCollection as $answer)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $answer->name }}</td>
        <td>{{ $answer->detail }}</td>
        <td>{{ $answer->created_at }}</td>
        <td>
            <form action="{{ route('answer.destroy',$answer->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('answer.show', $answer->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('answer.edit', $answer->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $answerCollection->links() !!}

@endsection