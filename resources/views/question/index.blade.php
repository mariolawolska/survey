{{-- question\index.blade.php --}}

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
                        <div class="pull-right">
                            <h3>Survey Name[{{ $survey->name }}]</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a href="{{ route('question.create') }}"><button class="forward">Create New Question</button></a>
                            <a href="{{ route('survey.index') }}"><button class="forward">Back to Survey</button></a>
                        </div>
                    </div>
                </div>


                @if ($message = Session::get('success'))
                <div class="alert alert-success mt-3">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <table class="table table-bordered mt-3">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Details</th>
                        <th>Answers</th>
                        <th>Created</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($questionCollection as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->name }}</td>
                        <td>{{ App\Question::questionTypeToHuman($question->type) }}</td>
                        <td>{{ $question->detail }}</td>
                        <td>{{ $question->answer->count() }}</td>
                        <td>{{ $question->created_at }}</td>

                        <td>
                            <form action="{{ route('question.destroy',$question->id) }}" method="POST">

                                <a class="btn btn-info btn-action" href="{{ route('answer.create',['questionId'=> $question->id]) }}">Add Answers</a>
                                @if($question->answer->count()>0)
                                <a class="btn btn-info btn-action" href="{{ route('answer.index',['questionId'=> $question->id]) }}">Show Answers</a>
                                @endif
                                <a class="btn btn-info btn-action" href="{{ route('question.show', $question->id) }}">Show</a>

                                <a class="btn btn-primary btn-action" href="{{ route('question.edit', $question->id) }}">Edit</a>

                                <a class="btn btn-info btn-action" href="{{ route('question.create',['questionId'=> $question->id,'flow'=> 'sub']) }}">Sub-Question</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-action">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>

                {!! $questionCollection->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
