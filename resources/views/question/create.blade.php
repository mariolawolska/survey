{{--  --}}

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
                            <h5>Survey Name[{{ $survey->name }}]</h5>
                            <h3>Add New Question</h3>
                        </div>
                        <div class="pull-right ">
                            <a href="{{ route('question.index',['surveyId'=>$survey->id]) }}"><button class="forward">Back to Question</button></a>
                        </div>
                        <div class="mb-5 w-50 float-left pb-3 b-line"</div>
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

            <form action="{{ route('question.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- Survey Id --}}
                    <input type="hidden" name="surveyId" class="form-control" value="{{ $survey->id }}">

                    {{-- Sub Qsuestion Id --}}
                    <input type="hidden" name="subquestionId" class="form-control" value="{{ $subquestionId }}">
                    {{-- Flow --}}
                    <input type="hidden" name="flow" class="form-control" value="{{ $flow }}">

                    {{-- Name --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>

                    {{-- Type --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Type:</strong>
                            <select name="type" id="type" class="form-control">
                                @foreach($questionType as $id => $type)
                                <option value="{{ $id }}">{{ $type }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Detail --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Detail:</strong>
                            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="col-lg-12 margin-tb">
                        <div class="float-right">
                            <button type="submit" class="forward">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
