@use('App\Http\Controllers\StudentController')
@extends('master')
@section('content')

@php
unset($formData['currentPage']);
@endphp

<link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

<div class="bg-gray-100 flex flex-col justify-between">
    <div class="container mx-auto px-6 py-8 flex-grow">
        <h1 class="text-3xl font-bold mb-2">
            {{ $student . " " . $display . " Submission Details"}}
        </h1>
        <h2 class="font-bold mb-6">This module has {{ $submitted ? '' : 'not' }} been submitted</h2>
        <div class="px-4 py-1 space-y-1">
            @foreach($formData as $section => $sectionData)
            @if(isset($sectionData['questions']))
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-3xl font-bold mb-2"> {{ Str::title(str_replace('-', ' ', $section)) }}</h2>
                @foreach($sectionData['questions'] as $questionId => $question)
                <div class="border-b border-gray-200 last:border-0 pb-1">
                    @if($question['type'] === 'textarea')
                    <div class="flex flex-col">
                        <div class="font-bold text-black">
                            {{ $question['question'] }}
                        </div>
                        <div class="ml-4">
                            {{ $question['answer'] ?: 'No answer provided' }}
                        </div>
                    </div>
                    @else
                    <div class="flex items-center">
                        <span class="font-bold text-black mr-2">
                            {{ $question['question'] }}:
                        </span>
                        <span>
                            @if($question['type'] === 'radio')
                            Rating: {{ $question['answer'] }}/5
                            @else
                            {{ $question['answer'] ?: 'No answer provided' }}
                            @endif
                        </span>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
            @if(isset($sectionData['conversation']))
                @php $conversation = $sectionData['conversation']; @endphp
                @include('components.conversation-display', ["conversation" => $conversation, "headerText" => str_replace('-', ' ', $section)])
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection