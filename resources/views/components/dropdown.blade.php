{{-- Parameters:

$question       -> string
$name           -> string               (The HTML name field, will also be the key for the question JSON object in the form data)
$options        -> array of strings     (The options for the dropdown)
$context        -> string               (Additional context for the question. Will appear below the question in a p)
$id             -> string
--}}
@php
    $answer = $pageData['questions'][$name]['answer'] ?? null
@endphp

<p class="block font-medium mb-2">{{ $question }}</p>
@if(isset($context)) <p class="mb-2">{{ $context }}</p> @endif
<select
    name="{{ $name }}"
    @if(isset($id)) id="{{ $id }}" @endif
    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
    required
    data-type="select"
    data-question="{{ $question }}"
    onchange='answerQuestion(@json($name), { question: @json($question), type: "select", answer: this.value })'
    {{ $locked ? 'disabled' : '' }}>
    <option value="" disabled {{ $answer == '' ? 'selected' : '' }}>Select an option</option>

    @foreach ($options as $option)
    <option value="{{ $option }}" {{ $answer === $option ? 'selected' : '' }}>
        {{ $option }}
    </option>
    @endforeach
</select>
