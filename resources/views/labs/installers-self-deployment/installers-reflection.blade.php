<div class="text-1xl font-bold mb-2">Short Answer Questions</div>
<p class="mb-2">
    Please take this opportunity to deeply reflect about your overall experience with this first experience.<br> 
    Answers may be as long or short as you like, but please try to at least write a few full sentences.
</p>
<br>




<!-- Open-ended Questions -->
<div class="bg-white p-6 rounded-lg shadow mb-6">    
    @include('components.textbox', [
        "question" => "Describe your experience creating your installer. Were there any challenges, and how did you overcome them?", 
        "name" => "installers-reflection-q1"
    ])
    
    @include('components.textbox', [
        "question" => "How does your installer compare to the example installer you tried earlier? What differences or similarities did you notice?", 
        "name" => "installers-reflection-q2"
    ])
    
</div>

<!-- Rating Section -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Rate Your Experience</h2>
    <p class="mb-4 text-gray-600">1 = Poor, 5 = Excellent</p>

    <div class="space-y-1">
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => "How would you rate the overall process of creating the installer?", "name" => "installers-reflection-q3"])
        </div>
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => "How helpful was the example installer in guiding you through creating your own?", "name" => "installers-reflection-q4"])
        </div>
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            @include('components.rating', ["question" => "How much improvement do you feel your installer needs to match a professional installer?", "name" => "installers-reflection-q5"])
        </div>
    </div>
</div>
