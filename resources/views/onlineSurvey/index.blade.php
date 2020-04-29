@extends('layouts.app')

@section('content')
<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}
        @include('layouts.frame.content.leftWrapper')

        <div class="col-lg-6 content-right" id="start">
            <div id="wizard_container">
                <!-- /top-wizard -->
                <h3 class="main_question wizard-header">Thank you for taking the time to complete this survey.</h3>
                <label>We realize how important your feedback is to our continued improvement and success.</label>
            </div>
        </div>
    </div>

</div>
@endsection
