@php
    $revealed = $pageData['revealed'] ?? false;
@endphp
<div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6">
    <!-- Left Section -->
    <div class="md:w-1/2 bg-green-100 p-4 sm:p-6 rounded-lg shadow-inner">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Build a website for a local bakery.</h2>
        <p class="text-gray-600 mb-4">
            The website should display basic information about the bakery (location, hours of operation).
            It should have an attractive homepage with images of the bakery and its products.
            The website should have a contact form for customers to get in touch.
        </p>
        @include('components.textbox', [
            'question' => 'How would you approach this project? Consider the tools, structure, and key features you would focus on.',
            'name' => 'leftText'
            ])
            
        @if(!isset($pageData['rightText']))
        <button 
            type="button" 
            onclick="revealRightSide()" 
            class="mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Next Part
        </button>
        @endif
    </div>

    <!-- Right Section -->
    <div id="right-side" class="md:w-1/2 bg-blue-100 p-4 sm:p-6 rounded-lg shadow-inner {{ ($pageData['revealed'] ?? false) ? '' : 'hidden' }}">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">New Requirements for the Bakery Website</h2>
        <p class="text-gray-600 mb-4">
            The bakery wants to sell products online, including managing inventory, accepting payments, and handling shipping.
            Customers should be able to create user accounts, allowing them to save favorite products and view their order history.
            The website needs to have multi-language support to serve both local and international customers.
            The bakery also wants to implement a loyalty rewards program for frequent customers.
        </p>
        @include('components.textbox', [
            'question' => 'How do you think your initial approach to this problem does given these additional requirements? What new tools, features, or architecture considerations would you need to include?',
            'name' => 'rightText'
            ])
        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const revealed = @json($revealed);
        if(revealed) {
            document.getElementsByName("leftText")[0].readOnly = true;
        }
    });
    function revealRightSide() {
        document.getElementById('right-side').classList.remove('hidden');
        document.getElementsByName("leftText")[0].readOnly = true;
        updateForm('revealed', true, `Revealed the right side`);
    }
</script>