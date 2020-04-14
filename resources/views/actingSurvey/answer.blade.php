{{-- 1 => Single choice (radio buttons)) --}}

xxx{{$question->type}}

@if( $question->type == 1)
<div class="form-group">
    <label class="container_radio version_2" title="{{ $answer->detail }}"> {{ $answer->name }}
        <input type="radio" name='question_1' value=" {{ $answer->id }}" class="required" onchange="getVals(this, '{{ $answer->name }}');">
        <span class="checkmark"></span>
    </label>
</div>
@endif

{{-- 2 => Multiple choice (checkboxes) --}}
@if( $question->type == 2)
<div class="form-group">
    <label class="container_check version_2" title="{{ $answer->detail }}"> {{ $answer->name }}
        <input type="checkbox" name="question_2" value=" {{ $answer->id }}" class="required" onchange="getVals(this, ' {{$answer->name}}');">
        <span class="checkmark"></span>
    </label>
</div>
@endif

{{-- 3 => Text --}}
@if( $question->type == 3)
<div class="form-group">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class=" add_top_30">
                <label>Additional information</label>
                <textarea name="additional_message" class="form-control required" style="height:150px;" placeholder="Type here additional info..." onkeyup="getVals(this, 'additional_message');"></textarea>
            </div>
        </div>
    </div>
</div>
@endif