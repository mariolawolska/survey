{{-- survey\show.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}
        @include('layouts.frame.content.leftWrapper')

        <div class="col-lg-6 content-right" id="start">
            <div id="wizard_container">

                @include('actingSurvey.display')

            </div>
        </div>
        
    </div>
</div>
@endsection