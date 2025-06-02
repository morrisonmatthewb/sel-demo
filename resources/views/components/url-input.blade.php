{{-- Parameters:

$question       -> string               (question)
$name           -> string               (The HTML name field, will also be the key for the question JSON object in the form data)
$pattern        -> string               (pattern to check input matches to)
$placeholder    -> string               (placeholder)
--}}

@php
    $answer = $pageData['questions'][$name]['answer'] ?? '';
@endphp

<label class="block font-medium mb-2">{{ $question }}</label>
<input
    type="url"
    name="{{ $name }}"
    pattern="{{ $pattern }}"
    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
    placeholder="{{ $placeholder }}"
    value="{{ $answer }}"
    required
    onchange='answerQuestion(@json($name), { question: @json($question), type: "url", answer: this.value })'>