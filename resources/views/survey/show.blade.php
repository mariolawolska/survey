{{-- survey\show.blade.php --}}

@extends('layouts.app')

@section('content')


<div class="container-fluid full-height">
    <div class="row row-height">
        {{-- leftWrapper --}}
        @include('layouts.frame.content.leftWrapper')
        <!-- /content-left-wrapper -->

        <div class="col-lg-6 content-right" id="start">
            <!--<div>-->
                <!-- /top-wizard -->
<!--                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h3 class="main_question wizard-header">Show Survey</h3>
                        </div>

                    </div>
                </div>-->

<!--                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="">
                            <strong>Name:</strong>
                            {{ $survey->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="">
                            <strong>Details:</strong>
                            {{ $survey->detail }}
                        </div>
                    </div>
                </div>-->

                <div id="wizard_container">
                    
                    @include('actingSurvey.display')
                    
                 
                </div>

            <!--</div>-->
        </div>
        
        
    </div>
</div>
@endsection
<div class="cd-overlay-nav">
    <span></span>
</div>
 <!--/cd-overlay-nav--> 

<div class="cd-overlay-content">
    <span></span>
</div>
 <!--/cd-overlay-content--> 

