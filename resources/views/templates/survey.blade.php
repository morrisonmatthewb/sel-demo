{{--
Parameters:
$textHead                    ->           (html content string that goes above text questions)
$textQuestions
$dropdownHead                ->           (html content string that goes above text questions)
$dropdownQuestions           ->            [[ question => [], options => []], ...]
$ratingHead                  ->           (html content string that goes above text questions)
$ratingQuestions
--}}

{{-- Render text questions --}}
@if (!empty($textQuestions))
    @if (!empty($textHead))
        {!! $textHead !!}<br>
    @else
        <h2 class="text-1xl font-bold mb-4">Short Answer Questions</h2><br>
    @endif
    <div class="mb-8">
        @foreach ($textQuestions as $index => $question)
            @include('components.textbox', [
                'question' => $question,
                'name' => 'textarea' . ($index + 1)
            ])
        @endforeach
    </div>
@endif

{{-- Render dropdown questions --}}
@if (!empty($dropdownQuestions))
    @if (!empty($dropdownHead))
        {!! $dropdownHead !!} <br>
    @endif
    <div class="mb-8">
        @foreach ($dropdownQuestions as $dropdown)
            @include('components.dropdown', [
                'question' => $dropdown['question'],
                'name' => 'dropdown_' . ($loop->index + 1),
                'options' => $dropdown['options']
            ])
        @endforeach
    </div>
@endif

{{-- Render rating questions --}}
@if (!empty($ratingQuestions))
    @if (!empty($ratingHead))
        {!! $ratingHead !!}
    @else 
        <h2 class="text-1xl font-bold mb-4">Rate Your Knowledge (1-5)</h2>
    @endif
    <div class="mb-8">
        @foreach ($ratingQuestions as $index => $question)
            @include('components.rating', [
                'question' => $question,
                'name' => 'rating_' . ($index + 1),
                'scale' => [1, 2, 3, 4, 5]
            ])
        @endforeach
    </div>
@endif
