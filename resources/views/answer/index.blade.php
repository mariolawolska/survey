{{-- answer\index.blade.php --}}

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
                            <h3 class="main_question wizard-header">Survey Name[{{ $survey->name }}]</h3>
                            <p>Question Name[{{ $question->name }}]</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a href="{{ route('answer.create') }}"><button class="forward">Create New Answer</button></a>
                            <a href="{{ route('question.index',['surveyId'=>$survey->id]) }}"><button class="forward">Back to Question</button></a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <table class="table table-bordered" style="margin-top: 15px">
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

                                <a class="btn btn-info btn-action" href="{{ route('answer.show', $answer->id) }}">Show</a>

                                <a class="btn btn-primary btn-action" href="{{ route('answer.edit', $answer->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-action">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>

                {!! $answerCollection->links() !!}
            </div>
        </div>
    </div>
    @endsection