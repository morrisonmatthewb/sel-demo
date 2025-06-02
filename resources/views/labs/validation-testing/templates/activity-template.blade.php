<!-- Grid Layout -->
<div class="grid grid-cols-3 gap-6">

    <!-- Left Section       -       Dynamic Content -->
    <div class="col-span-2 bg-white p-6 rounded-lg shadow" id="app-content">
        @yield('app-content')
    </div>

    <!-- Right Section      -       Static Requirements -->
    <div class="bg-gray-50 p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Requirements</h2>
            <p> <span id="workCheck">•</span> Add a biweekly recurring income labeled <strong>"Work"</strong> of $2,000.</p>
            <p> <span id="rentCheck">•</span> Add a monthly recurring expense labeled <strong>"Rent"</strong> of $1,500.</p>
            <p> <span id="groceriesCheck">•</span> Add a weekly recurring expense labeled <strong>"Groceries"</strong> of $100.</p>
            <p> <span id="utilitiesCheck">•</span> Add a monthly recurring expense labeled <strong>"Utilities"</strong> of $400.</p>
            <p> <span id="bonusCheck">•</span> Add a twice-a-year recurring income labeled <strong>"Bonus"</strong> of $3,000.</p>
        <p class="mt-6 text-gray-600">
            Ensure all recurring transactions are projected over the first six months of the year.
            <br>
            You will not be able to proceed until all the above requirements are completed.
        </p>
    </div>

</div>