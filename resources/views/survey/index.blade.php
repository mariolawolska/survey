{{-- survey\index.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}
        @include('layouts.frame.content.leftWrapper')
        <!-- /content-left-wrapper -->

        <div class="col-lg-6 content-right" id="start">
            <div id="container">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a href="{{ route('survey.create') }}"><button class="forward"> Create New Survey</button></a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <table class="table table-bordered " style="margin-top: 15px">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Questions</th>
                        <th>Created</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($surveyCollection as $survey)
                    <tr>
                        <td>{{ $survey->id }}</td>
                        <td>{{ $survey->name }}</td>
                        <td>{{ $survey->detail }}</td>
                        <td>{{ $survey->question->count() }}</td>
                        <td>{{ $survey->created_at }}</td>
                        <td>
                            <form action="{{ route('survey.destroy',$survey->id) }}" method="POST">

                                <a class="btn btn-info btn-action" href="{{ route('question.create',['surveyId'=> $survey->id]) }}">Add Question</a>

                                {{-- Show Question --}}
                                @if($survey->question->count()>0)
                                <a class="btn btn-info btn-action" href="{{ route('question.index',['surveyId'=> $survey->id]) }}">Show Question</a>
                                @endif
                                {{-- Show Question END --}}                                

                                <a class="btn btn-info btn-action" href="{{ route('survey.show',$survey->id) }}">Show</a>

                                <a class="btn btn-primary btn-action" href="{{ route('survey.edit',$survey->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-action">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>

                {!! $surveyCollection->links() !!}
            </div>
        </div>
    </div>

    @endsection
