{{-- Hidden admin section containing flag 1 --}}
<div style="display: none">
    <!-- Flag: CMSC435{hidden_admin_panel_found} -->
</div>

{{-- Header Section --}}
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <p class="text-gray-600">
        Welcome to the flags challenge! Your mission is to find three hidden flags by exploiting various
        security vulnerabilities. Each flag follows the format CMSC435{flag_text}. Use the hints if you get stuck,
        but remember that hint usage is tracked.
    </p>
</div>

{{-- Flags Progress Section --}}
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold mb-4">Your Progress</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @for ($i = 1; $i <= 3; $i++)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Flag {{$i}}</h3>
                <input type="text" id="flag-{{ $i }}-box"
                    class="w-full p-2 border rounded {{ isset($flags[$i - 1]) ? 'bg-green-100 text-green-800' : 'bg-white' }}"
                    placeholder="Enter flag {{ $i }}" {{ isset($flags[$i - 1]) ? 'readonly value=' . $flags[$i - 1] : '' }}>
                @if(!isset($flags[$i - 1]))
                    <button onclick="submitFlag({{ $i }})"
                        class="mt-2 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                        Submit
                    </button>
                @endif
            </div>
        @endfor
    </div>
</div>

{{-- Tools Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Student Search Tool --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Student Directory</h2>
        <p class="text-gray-600 mb-4">
            Search our database of students. The system uses a SQLite database with two tables: 
            <code class="bg-gray-100 px-1 rounded">students</code> (id, name, class, major) and 
            <code class="bg-gray-100 px-1 rounded">admin</code>.
        </p>
        <div class="mb-4">
            <input type="text" id="name-box" class="w-full p-2 border rounded" placeholder="Search by name...">
            <button onclick="search()"
                class="mt-2 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                Search
            </button>
        </div>
        <div id="search-results" style="max-height: 300px; overflow-y: scroll;" class="mt-4 border rounded bg-gray-50">
            <div class="p-4 text-gray-500 italic">
                Enter a name to search...
            </div>
        </div>
    </div>

    {{-- Image Upload Tool --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Image Gallery</h2>
        <form action="{{ route('modules.labpost', ['lab' => 'security', 'subroute' => 'upload']) }}" method="POST"
            enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Upload PNG Image:</label>
                <input type="file" name="image" accept=".png" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                Upload
            </button>
        </form>
    </div>
</div>

{{-- Hints Section --}}
@if(count($flags ?? []) < 3)
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        @php
            // Calculate next flag number based on completed flags
            $nextFlag = 1;
            if(isset($flags)) {
                for($i = 0; $i < 3; $i++) {
                    if(!isset($flags[$i])) {
                        $nextFlag = $i + 1;
                        break;
                    }
                }
            }
        @endphp

        <h2 class="text-xl font-bold mb-4">Hints for Flag {{ $nextFlag }}</h2>
        <div id="hints" class="space-y-2 mb-4">
            {{-- Display previously received hints --}}
            @if(isset($received_hints[$nextFlag]))
                @foreach($received_hints[$nextFlag] as $hintIndex)
                    <div class="p-3 bg-gray-50 rounded border border-gray-200 mb-2">
                        Hint {{ $hintIndex + 1 }}: {{ $hints_data[$nextFlag][$hintIndex] }}
                    </div>
                @endforeach
            @endif
        </div>
        <div class="flex items-center justify-between">
            <button onclick="hint()"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition duration-200"
                {{ isset($received_hints[$nextFlag]) && count($received_hints[$nextFlag]) >= count($hints_data[$nextFlag]) ? 'disabled' : '' }}>
                Get Next Hint
            </button>
            <span class="text-gray-500 italic">Stuck? Get hints one at a time</span>
        </div>
    </div>
@endif

{{-- Victory Message --}}
@if($won ?? false)
    <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
        <p class="font-bold">Congratulations!</p>
        <p>🎉🎉🎉 You have found all the flags! 🎉🎉🎉</p>
    </div>
@endif

<script>
    function submitFlag(flagNumber) {
        const flagValue = document.getElementById(`flag-${flagNumber}-box`).value;

        fetch('{{ route("modules.labpost", ["lab" => "security", "subroute" => "submit-flag"]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ flag_number: flagNumber, flag: flagValue })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Incorrect flag');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting flag');
            });
    }

    let currentHintIndex = {{ isset($received_hints[$nextFlag]) ? count($received_hints[$nextFlag]) : 0 }};

    function hint() {
        fetch('{{ route("modules.labpost", ["lab" => "security", "subroute" => "hint"]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                hintIndex: currentHintIndex,
                flagNumber: {{ $nextFlag }}
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.hint) {
                const hintsDiv = document.getElementById('hints');
                const hintDiv = document.createElement('div');
                hintDiv.className = 'p-3 bg-gray-50 rounded border border-gray-200 mb-2';
                hintDiv.textContent = `Hint ${currentHintIndex + 1}: ${data.hint}`;
                hintsDiv.appendChild(hintDiv);
                
                currentHintIndex++;
                
                const hintButton = document.querySelector('[onclick="hint()"]');
                if (!data.hasMore) {
                    hintButton.disabled = true;
                    hintButton.className = 'bg-gray-400 text-white font-semibold py-2 px-4 rounded cursor-not-allowed';
                }
            } else {
                alert(data.message || 'No more hints available');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error getting hint');
        });
    }

    function search() {
        const name = document.getElementById('name-box').value;
        const resultsDiv = document.getElementById('search-results');
        
        resultsDiv.innerHTML = '<div class="p-4">Searching...</div>';
        
        fetch('{{ route("modules.labpost", ["lab" => "security", "subroute" => "search"]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: name })
        })
        .then(response => response.json())
        .then(data => {
            resultsDiv.innerHTML = '';
            
            if (!data.results || data.results.length === 0) {
                resultsDiv.innerHTML = '<div class="p-4">No results found</div>';
                return;
            }
            
            data.results.forEach(student => {
                const div = document.createElement('div');
                div.className = 'p-2 bg-white border-b last:border-b-0 hover:bg-gray-50 transition-colors';
                div.textContent = `${student.name} - ${student.class} - ${student.major}`;
                resultsDiv.appendChild(div);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            resultsDiv.innerHTML = `<div class="p-4 text-red-700">Search error: ${error.message}</div>`;
        });
    }
</script>

<style>
    #search-results {
        max-height: 300px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch; /* for smooth scrolling on iOS */
    }

    #search-results::-webkit-scrollbar {
        width: 8px;
    }

    #search-results::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    #search-results::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    #search-results::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>