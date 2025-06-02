@extends('master')

@section('title', '$display Module')

@section('content')

    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6">{{ $display }} Module</h1>
            @if(isset($objectives))
                <div class="bg-blue-50 p-6 rounded-lg mb-8">
                    <h2 class="text-xl font-semibold mb-4">Learning Objectives</h2>
                    <ul class="list-disc pl-6 space-y-2">
                        @foreach ($objectives as $objective)
                            <li>{{ $objective }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Module Overview</h2>
                    <p class="mb-4">{{ $description }}</p>
                    <!-- Module Start/Resume Button -->
                    <a href="{{ $link_to }}"><button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">{{ is_null($last_page) ? "Start Module" : "Resume Module" }}</button></a>
                    <p id="resume-text" class="mt-2 text-gray-600 text-center">
                        @if(!is_null($last_page))
                            Last Page Visited: {{ $last_page }}
                        @endif
                    </p>
                </div>
                @if(isset($willlearn))
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-4">What You'll Learn</h2>
                        <ul class="list-disc pl-6 space-y-2">
                            @foreach ($willlearn as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
