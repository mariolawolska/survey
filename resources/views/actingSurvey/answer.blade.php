{{-- 1 => Single choice (radio buttons)) --}}

xxx{{$question->type}}

@if( $question->type == 1)
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <label class="container_check version_2" title="{{ $answer->detail }}"> {{ $answer->name }}
                            <input type="radio" name=" {{ $answer->name }}" value=" {{ $answer->id }}" class="required" onchange="getVals(this, ' {{ $answer->name }}');">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- 2 => Multiple choice (checkboxes) --}}
@if( $question->type == 2)
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <label class="container_check version_2" title="{{ $answer->detail }}"> {{ $answer->name }}
                            <input type="checkbox" name=" {{ $answer->name }}" value=" {{ $answer->id }}" class="required" onchange="getVals(this, ' {{ $answer->name }}');">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- 3 => Text --}}
@if( $question->type == 3)
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="form-group add_top_30">
                            <label>Additional information</label>
                            <textarea name="additional_message" class="form-control required" style="height:150px;" placeholder="Type here additional info..." onkeyup="getVals(this, 'additional_message');"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif