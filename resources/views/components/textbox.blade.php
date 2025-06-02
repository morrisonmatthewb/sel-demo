{{-- 
Parameters:

$question       -> string   
$name           -> string               (The HTML name field, will also be the key for the question JSON object in the form data)
$id
--}}

@php
    $answer = $pageData['questions'][$name]['answer'] ?? '';
@endphp

<label class="block font-medium mb-2">{{ $question }}</label>
<textarea 
    name="{{ $name }}" 
    @if(isset($id)) id="{{ $id }}" @endif
    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
    rows="3" 
    required
    data-type="textarea"
    data-question="{{ $question }}"
    onchange='answerQuestion(@json($name), { question: @json($question), type: "textarea", answer: this.value })'
    {{ $locked ? 'disabled' : '' }}
>{{  $answer ?? '' }}</textarea>