{{--
Parameters:

$question       -> string
$name           -> string               (The HTML name field, will also be the key for the question JSON object in the form data)
$scale          -> array of integers    (The scale for the ratings, defaults to 1,2,3,4,5)
--}}

@php
    $scale = isset($scale) && is_array($scale) ? $scale : [1, 2, 3, 4, 5];
    $rating = $pageData['questions'][$name]['answer'] ?? null;
@endphp

<p class="font-medium">{{ $question }}</p>
@once
<style>
    .nobsmarg{
        margin:0px !important;
    }
</style>
@endonce
<div class="flex gap-4"
    data-type="radio"
    data-question="{{ $question }}"
    name="{{ $name }}">
    @foreach($scale as $option)
        <div class="flex items-center">
            <input
                type="radio"
                name="{{ $name }}"
                value="{{ $option }}"
                id="{{ $option }}"
                class="nobsmarg w-6 h-6 text-blue-600 focus:ring-blue-500"
                {{ $rating == $option ? 'checked' : '' }}
                required
                onchange='answerQuestion(@json($name), { question: @json($question), type: "radio", answer: this.value })'
                {{ $locked ? 'disabled' : '' }}
            >
            <label for="{{ $option }}" class="mb-0 ml-2" style="font-weight:300;">{{ $option }}</label>
        </div>
    @endforeach
</div>

