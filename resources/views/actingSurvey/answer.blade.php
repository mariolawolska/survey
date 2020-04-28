{{-- 1 => Single choice (radio buttons)) --}}
@if( $question->type == 1)
<div class="form-group">
    <label class="container_radio version_2" title="{{ $answer->detail }}"> {{ $answer->name }}
        <input type="radio" name='questionId##{{$question->id}}' value="{{ $answer->id }}" class="required" onchange="getVals(this, '{{ $answer->id }}');">
        <span class="checkmark"></span>
    </label>
</div>
@endif

{{-- 2 => Multiple choice (checkboxes) --}}
@if( $question->type == 2)
<div class="form-group">
    <label class="container_check version_2" title="{{ $answer->detail }}"> {{ $answer->name }}
        <input type="checkbox" name="questionId##{{$question->id}}[]" value="{{ $answer->id }}" class="required" onchange="getVals(this, 'question_{{$question->id}}[]');">
        <span class="checkmark"></span>
    </label>
</div>
@endif

{{-- 3 => Text --}}
@if( $question->type == 3)
<div class="form-group">
    <textarea name="questionId##{{$question->id}}" class="form-control questionId##{{$question->id}} required" style="height:150px;" placeholder="{{ $question->detail }}" onkeyup="getVals(this, 'questionId##{{$question->id}}');"></textarea>
</div>
@endif

{{-- 7 => Slider --}}
@if( $question->type == 7)
<div class="budget_slider">
    <input type="range" name="answer##{{ $answer->id }}" min="3" max="168" step="1" value="0" data-orientation="horizontal" onchange="getVals(this, 'timeframe');">
    <span>hours</span>
</div>
<p>Lorem ipsum dolor sit amet, esse mazim disputando vix in. Quem reprimique eum ea, vim cu <strong>partem persius</strong> efficiantur.</p>
<p>Ex has option delectus. Duo ex iuvaret delicata pertinacia, no nam tale summo euismod.</p>
@endif


{{-- 8 => Star rating grid --}}
@if( $question->type == 8)
<div class="form-group rating_wp clearfix">
    <label class="rating_type">{{ $answer->name }}</label>
    <span class="rating">
        <input type="radio" class="required rating-input" id="rating-input-{{ $answer->id }}-5" name="rating_input_{{ $answer->id }}" value="5 Stars" onchange="getVals(this, 'rating_input_{{ $answer->id }}');">
        <label for="rating-input-{{ $answer->id }}-5" class="rating-star"></label>
        <input type="radio" class="required rating-input" id="rating-input-{{ $answer->id }}-4" name="rating_input_{{ $answer->id }}" value="4 Stars" onchange="getVals(this, 'rating_input_{{ $answer->id }}');">
        <label for="rating-input-{{ $answer->id }}-4" class="rating-star"></label>
        <input type="radio" class="required rating-input" id="rating-input-{{ $answer->id }}-3" name="rating_input_{{ $answer->id }}" value="3 Stars" onchange="getVals(this, 'rating_input_{{ $answer->id }}');">
        <label for="rating-input-{{ $answer->id }}-3" class="rating-star"></label>
        <input type="radio" class="required rating-input" id="rating-input-{{ $answer->id }}-2" name="rating_input_{{ $answer->id }}" value="2 Stars" onchange="getVals(this, 'rating_input_{{ $answer->id }}');">
        <label for="rating-input-{{ $answer->id }}-2" class="rating-star"></label>
        <input type="radio" class="required rating-input" id="rating-input-{{ $answer->id }}-1" name="rating_input_{{ $answer->id }}" value="1 Star" onchange="getVals(this, 'rating_input_{{ $answer->id }}');">
        <label for="rating-input-{{ $answer->id }}-1" class="rating-star"></label>
    </span>
</div>
@endif

{{-- 9 => Essay (long text) --}}
@if( $question->type == 9)
<div class="form-group add_top_30">
    <textarea name="answer##{{ $answer->id }}" class="form-control review_message required" placeholder="Write your review here..." onkeyup="getVals(this, 'review_message');"></textarea>
</div>
@endif

{{-- 10 => File upload --}}
@if( $question->type == 10)
<div class="form-group add_top_30">
    <label>Additional information</label>
    <textarea name="answer##{{ $answer->id }}" class="form-control required" style="height:150px;" placeholder="Type here additional info..." onkeyup="getVals(this, '{{$answer->name}}');"></textarea>
</div>
<div class="form-group add_top_30">
    <label>Optional file upload<br><small>(Files accepted: gif, jpg, jpeg, .png, .pdf, .doc/docx - Max file size: 50k for demo purpose, you can increase based on your host settings.)</small></label>
    <div class="fileupload">
        <input type="file" name="answer##{{ $answer->id }}" accept="image/*,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="getVals(this, 'fileupload');">
    </div>
</div>
@endif