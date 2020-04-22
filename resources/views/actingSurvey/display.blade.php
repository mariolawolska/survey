{{-- survey\display.blade.php --}}

@php
$surveyObject = json_decode($jsonObject);
@endphp

<div id="top-wizard">
    <div id="progressbar"></div>
</div>
<!-- /top-wizard -->

<form id="wrapped" method="POST">
    @csrf
    <input id="website" name="website" type="text" value="">
    <!-- Leave for security protection, read docs for details -->
    <div id="middle-wizard">
        {{-- Counting the Index of Questions --}}
        @php
        $index = 1;
        @endphp

        @foreach( $surveyObject->question as $question ) {{-- Question --}}
        @if($index < $surveyObject->survey->questionQty) {{-- Answer --}}
        <div class="step">
            <h3 class="main_question"><strong>[{{ $index++ }}/{{$surveyObject->survey->questionQty}}]</strong> {{ $question->name }}</h3>
            @foreach($question->answer as $answer)
            @include('actingSurvey.answer')
            @endforeach
        </div>
        {{-- Answer END --}}
        @else {{-- Summary --}}
        <div class="submit step">
            <h3 class="main_question"><strong>[{{ $index++ }}/{{$surveyObject->survey->questionQty}}]</strong> {{ $question->name }}</h3>
            @include('actingSurvey.summary')
        </div>
        @endif {{-- Summary END --}}
        @endforeach {{-- Question END --}}
    </div>

    <div id="bottom-wizard">
        <!-- /middle-wizard -->
        <a href="{{ route('survey.index') }}"><button type="button" name="backward" class="backward">Prev</button></a>
        <button type="button" name="forward" class="forward">Next</button>
        <button type="submit" name="process" class="submit">Submit</button>
        <!-- /bottom-wizard -->
    </div>

</form>