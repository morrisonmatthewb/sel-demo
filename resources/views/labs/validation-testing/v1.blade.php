@extends('labs.validation-testing.templates.activity-template')

@section('title', 'Budget Tracker v1 | Validation Testing Module')

@section('app-content')
    @php
        $completed = $formData[$page]['completed'] ?? false;
        $locked = false;
    @endphp
    <script>
        let budgetEntries = [];
        let prevCompleted = @json($completed);
        document.addEventListener('DOMContentLoaded', function () {
            const additionalInfoDiv = document.getElementById('additionalInfo');

            // Create a new <p> element
            const reqMsg = document.createElement('p');
            reqMsg.id = 'reqMsg'; // Set the ID for the <p> element
            reqMsg.textContent = '';

            // Append the <p> element to the div

            if (!prevCompleted) {
                disableButton('next');
                reqMsg.textContent = 'Some budget requirements are not met.';
                reqMsg.classList.add('font-bold', 'text-red-500');
            }
            additionalInfoDiv.appendChild(reqMsg);
        });

        function addEntry(type) {
            const budgetData = validateInput();
            // Checks to see if there is a label and an amount
            if(budgetData == false) {
                return;
            }

            // Amount is negative if it is an expense
            if(type == 'expense') {
                budgetData.amount *= -1;
            }

            budgetEntries.push(budgetData);

            // Store the budget entry as a list item under "Budget Entries"
            listItem = document.createElement('li');
            listItem.textContent = `Label: ${budgetData.label}, Frequency: ${budgetData.frequency}, Amount: \$${budgetData.amount}`;
            document.querySelector('#inputs ul').appendChild(listItem);
            writeLog(`Added budget entry: ${listItem.textContent}`);
            renderNavBar();
        }

        function validateInput() {
            label = document.getElementById('incomeLabel').value;
            amount =        parseInt(document.getElementById('amount1m').value) * 1000000 +
                            parseInt(document.getElementById('amount100k').value) * 100000 +
                            parseInt(document.getElementById('amount10k').value) * 10000 +
                            parseInt(document.getElementById('amount1k').value) * 1000 +
                            parseInt(document.getElementById('amount100').value) * 100 +
                            parseInt(document.getElementById('amount10').value) * 10 +
                            parseInt(document.getElementById('amount1').value) + 
                            parseInt(document.getElementById('amount0.1').value) * 0.1 +
                            parseInt(document.getElementById('amount0.01').value) * 0.001;
            budgetData = {
                label: label,
                amount: amount,
                frequency: document.getElementById('frequency').value,
            };
            if (!label || amount === 0) {
                alert('Please provide a label and a valid amount.');
                return false; // Prevent form submission
            }
            return budgetData; // Allow form submission
        }

        // Function to render the appropriate navigation bar
        function renderNavBar() {
            const reqMsg = document.getElementById('reqMsg');
            if (!prevCompleted && budgetRequirementsMet()) {
                writeLog(`Completed budget tracker activity on ${page}`);
                prevCompleted = true;
                updateForm('completed', true);
            }

            if (prevCompleted) {
                enableButton('next');
                reqMsg.innerHTML = '';
            } else {
                reqMsg.innerHTML = 'Some budget requirements are not met.';
                reqMsg.classList.add('font-bold', 'text-red-500');
            }
        }

        function budgetRequirementsMet() {
            hasBiweeklyIncome = false;
            hasMonthlyRent = false;
            hasWeeklyGroceries = false;
            hasMonthlyUtilities = false;
            hasSemiannualBonus = false;

            // Check for each required entry
            budgetEntries.forEach(entry => {
                if (entry.label === "Work" && entry.frequency === "Biweekly" && entry.amount === 2000) {
                    hasBiweeklyIncome = true;
                } else if (entry.label === "Rent" && entry.frequency === "Monthly" && entry.amount === -1500) {
                    hasMonthlyRent = true;
                } else if (entry.label === "Groceries" && entry.frequency === "Weekly" && entry.amount === -100) {
                    hasWeeklyGroceries = true;
                } else if (entry.label === "Utilities" && entry.frequency === "Monthly" && entry.amount === -400) {
                    hasMonthlyUtilities = true;
                } else if (entry.label === "Bonus" && entry.frequency === "Semiannual" && entry.amount === 3000) {
                    hasSemiannualBonus = true;
                }
            });

            // Return true only if all conditions are met
            return hasBiweeklyIncome && hasMonthlyRent && hasWeeklyGroceries && hasMonthlyUtilities && hasSemiannualBonus;
        }
    </script>
    <!-- Input Section -->
    <h1 class="text-3xl font-bold text-center mb-6">Budget Tracker v1</h1>

    <br>

    <h2 class="text-xl font-semibold mb-4">Add Income/Expense</h2>
    <div class="flex flex-col mb-4">
        <label for="incomeLabel" class="font-semibold mb-2">Label:</label>
        <input {{ $locked ? 'disabled' : '' }} type="text" id="incomeLabel" class="border border-gray-300 p-2 rounded" placeholder="e.g. Work, Rent"/>
    </div>

    <div class="flex items-center mb-4">
        <label for="incomeAmount" class="font-semibold mr-4">Amount:</label>
        <div class="flex items-center">
            <span class="text-xl mr-2">$</span>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount1m">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <span class="text-xl mx-1">,</span>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount100k">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount10k">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount1k">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <span class="text-xl mx-1">,</span>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount100">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount10">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount1">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <span class="text-xl mx-1">.</span>
            <select class="border border-gray-300 rounded" id="amount0.1">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
            <select {{ $locked ? 'disabled' : '' }} class="border border-gray-300 rounded" id="amount0.01">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
        </div>
    </div>

    <div class="flex mb-4">
        <label for="frequency" class="font-semibold mr-4">Frequency:</label>
        <select {{ $locked ? 'disabled' : '' }} id="frequency" class="border border-gray-300 rounded">
            <option value="One-Time">One-Time</option>
            <option value="Weekly">Weekly</option>
            <option value="Biweekly">Biweekly</option>
            <option value="Monthly">Monthly</option>
            <option value="Semiannual">Semiannual</option>
            <option value="Biannual">Biannual</option>
        </select>
    </div>

    <div class="flex mb-4">
        <button {{ $locked ? 'disabled' : '' }} name="type" type="button" onclick="addEntry('income')" class="bg-green-500 text-white px-4 py-2 rounded">Add Income</button>
        <button {{ $locked ? 'disabled' : '' }} name="type" type="button" onclick="addEntry('expense')" class="bg-red-500 text-white px-4 py-2 rounded ml-4">Add Expense</button>
    </div>


    <br>

    <!-- Output Section -->
    <h2 class="text-xl font-semibold mb-4">Budget Entries</h2>
    <div id="inputs">
        <ul>
        </ul>
    </div>
@endsection