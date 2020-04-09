@extends('layouts.app')
@section('content')

<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}
        @include('layouts.frame.content.leftWrapper')
        <!-- /content-left-wrapper -->
        <!-- /content-left -->

        <div class="col-lg-6 content-right" id="start">
            <div id="wizard_container">
                <!-- /top-wizard -->
                <div class="flex-center position-ref full-height">
                    @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                        <a href="{{ url('/home') }}" class="btn_1">Home</a>
                        @else
                        <a href="{{ route('login') }}" class="btn_1">Login</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn_1">Register</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /container-fluid -->
@endsection
