<footer id="nav-bar" class="bg-gray-200 py-4">
    <div class="container mx-auto">
        <!-- Additional Info Section -->
        <div id="additionalInfo" class="mb-4 text-center">
            {!! $additionalInfo ?? '' !!}
        </div>


        <!-- Progress Bar Section (Only shown if currentPageNumber and totalPageNumber exist) -->
        @if(isset($currentPageNumber) && isset($totalPageNumber))
            <div class="mb-3 mt-3 text-center w-1/2 mx-auto">
                <div class="relative pt-1">
                    <div class="w-full bg-gray-300 rounded h-2">
                        <div class="bg-blue-500 h-2 rounded" style="width: {{ ($currentPageNumber / $totalPageNumber) * 100 }}%;"></div>
                    </div>
                    <div class="flex items-center justify-between mt-1 text-sm font-semibold text-gray-700">
                        <span>Page {{ $currentPageNumber }} of {{ $totalPageNumber }}</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="flex justify-center space-x-4">
            @php
                $buttons = $buttons ?? [];
                $homeVisible = $homeVisible ?? true;
                if ($homeVisible) {
                    $middleIndex = (int) floor(count($buttons) / 2);
                    array_splice($buttons, $middleIndex, 0, [[
                        'text' => 'Home',
                        'link' => route('modules.lab', ['lab' => $module]),
                        'isSubmit' => false,
                        'enabled' => true,
                        'color' => 'green'
                    ]]);
                }
            @endphp

            @foreach($buttons as $key => $button)
                @php
                    $isSubmit = $button['isSubmit'] ?? false;
                    $isButton = $button['isButton'] ?? false;
                    $enabled = $button['enabled'] ?? true;
                    $color = $button['color'] ?? 'blue';
                    $hidden = $button['hidden'] ?? false;
                    $id = $button['id'] ?? '';
                    $link = $button['link'] ?? (
                        isset($button['page']) ? route('modules.lab', ['lab' => $module, 'subroute' => $button['page']]) : ''
                    );
                    $direction = $button['direction'] ?? $key; // Default to key if direction is not provided
                    $buttonClasses = $enabled
                        ? "bg-{$color}-500 text-white px-6 py-2 rounded hover:bg-{$color}-600"
                        : "bg-gray-300 text-gray-600 px-6 py-2 rounded cursor-not-allowed";
                @endphp

                @if($isSubmit || $isButton)
                    <button id="{{ $id }}" class="{{ $buttonClasses }}" {{ $enabled ? '' : 'disabled' }} data-direction="{{ $direction }}">
                        {{ $button['text'] }}
                    </button>
                @elseif($enabled)
                    <a href="{{ $link }}" id="{{ $id }}" class="{{ $buttonClasses }}" data-direction="{{ $direction }}">
                        {{ $button['text'] }}
                    </a>
                @else
                    <span class="{{ $buttonClasses }}" id="{{ $id }}">
                        {{ $button['text'] }}
                    </span>
                @endif
            @endforeach
        </div>
    </div>
</footer>



{{-- 
 How to implement in Blade file:
 * = required
 @include('components.nav', [
   *'lab'               => 'String value of lab name',                                  // Use exact same spelling as folder
    'additionalInfo'    => 'String value of HTML code you'd                             // Use backslash when using quotes 
                            like to add above nav buttons',                             // Leave out if you don't have additional info
    'homeVisible'       => (boolean value, true if standard home button is visible),    // Default to true
    'currentPageNumber' => (int value of the current page number),                      // Leave out if you don't want progress bar
    'totalPageNumber'   => int value of the total amount of pages,                      // Leave out if you don't want progress bar    
    'buttons' => [
        'previous' => [
            'text'      => 'String value of button text',
            'page'      => 'String value of page name',                                 // Routes to same lab but different page
            'link'      => 'String value of page link',                                 // Use if button doesn't route to a page within the module
            'isSubmit'  => (boolean value, true if button is a submit button),          // Default to false
            'enabled'   => (boolean value, true if button is enabled)                   // Default to true
        ],
        'next' => [
            'text'      => 'String value of button text',
            'page'      => 'String value of page name',                                 // Routes to same lab but different page
            'isSubmit'  => (boolean value, true if button is a submit button),          // Default to false
            'enabled'   => (boolean value, true if button is enabled)                   // Default to true
        ],
    ]
])
    Additional Comments:
    Disabling a button means to make the color gray and the link not work
--}}