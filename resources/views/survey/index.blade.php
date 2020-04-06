@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('survey.create') }}"> Create New Survey</a>
        </div>
    </div>
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
        <th width="280px">Action</th>
    </tr>
    @foreach ($surveyCollection as $survey)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $survey->name }}</td>
        <td>{{ $survey->detail }}</td>
        <td>
            <form action="{{ route('survey.destroy',$survey->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('survey.show',$survey->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('survey.edit',$survey->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $surveyCollection->links() !!}

@endsection