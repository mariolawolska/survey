@extends('layouts.app')

@section('content')
<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}
        @include('layouts.frame.content.leftWrapper')

        <div class="col-lg-6 content-right" id="start">
            <div id="wizard_container">
                <!-- /top-wizard -->
                <h3 class="main_question wizard-header">{{ __('Dashboard') }}</h3>
                <label>You are the survey creator.</label>
                <div class="pull-right" id="bottom-wizard">
                    <a  href="{{ route('survey.index') }}"><button class="submit">Show Survey</button></a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
