{{--
Parameters:
$intro
$topics
$placeholderText
$topicHeader
--}}
@if (!empty($intro)) 
    {!! $intro ?? '' !!}
@endif
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Topic List Section -->
    <div class="bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold p-4 border-b">{{ $topicHeader ?? 'Topics' }}</h2>

        <input type="hidden" name="can_submit" value="false" id="can_submit">

        <div class="overflow-y-auto max-h-[600px]">
            <div id="topicsList" class="divide-y text-center">
                @foreach ($topics as $key => $topic)
                    <div class="p-4 hover:bg-gray-50 cursor-pointer flex justify-between 
                                @if(in_array($key, $formData[$page]['viewedTopics'] ?? [])) bg-blue-50 @endif" 
                         id="{{ $key }}" onclick="showTopic('{{ $key }}')">
                        <span class="text-left">{{ $topic['title'] }}</span>
                        @if(in_array($key, $formData[$page]['viewedTopics'] ?? []))
                            <span class="text-right">&check;</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Topic Content Section -->
    <div class="md:col-span-2">
        <div id="topicContent" class="bg-white p-6 rounded-lg shadow min-h-[600px]">
            <!-- Initial placeholder -->
            <div id="placeholder" class="text-center text-gray-500 mt-20">
                <p class="text-xl">{{ $placeholderText ?? 'Select a topic to view info about it' }}</p>
            </div>
            <!-- Generate all topic content divs but hide them initially -->
            @foreach ($topics as $key => $topic)
                <div id="topic-{{ $key }}" hidden>
                    {!! $topic['content'] !!}
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    const topics = @json($topics);
    const pageData = @json($pageData) ?? {};
    const locked = @json($locked);
    let topicProgress = pageData.viewedTopics || [];
    document.addEventListener('DOMContentLoaded', function () {
        if(!viewedAllTopics()) {
            disableButton('next');
        } 
    });
    
    // Show selected topic's content
    function showTopic(topicKey) {
        // Hide placeholder
        document.getElementById('placeholder').hidden = true;
        
        // Hide all topic content divs
        document.querySelectorAll('[id^="topic-"]').forEach(div => div.hidden = true);
        
        // Show selected topic
        document.getElementById('topic-' + topicKey).hidden = false;

        // Update UI for selected topic
        document.querySelectorAll('#topicsList div').forEach(div => div.classList.remove('bg-blue-50'));
        const selectedDiv = document.getElementById(topicKey);
        selectedDiv.classList.add('bg-blue-50');

        // Mark as viewed if not already marked
        if (!topicProgress.includes(topicKey) && !locked) {
            topicProgress.push(topicKey);
            updateForm('viewedTopics', topicProgress);
            selectedDiv.innerHTML += '<span class="text-right">&check;</span>';
        }
        if(viewedAllTopics()) {
            enableButton('next');
        }
    }
    function viewedAllTopics() {
        if(topics !== null) {
            return topicProgress.length === Object.keys(topics).length
        }
        return null
    }
</script>
