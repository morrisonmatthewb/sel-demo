@extends('labs.validation-testing.templates.activity-template')

@section('app-content')
    @php
        $completed = $pageData['completed'] ?? false;
        $budgetEntries = $pageData['budgetEntries'] ?? [];
    @endphp
    <script>
        let budgetEntries = @json($budgetEntries);
        let prevCompleted = @json($completed);
        document.addEventListener('DOMContentLoaded', function () {
            populateBudgetEntries();
            const additionalInfoDiv = document.getElementById('additionalInfo');

            // Create a new <p> element
            const reqMsg = document.createElement('p');
            reqMsg.id = 'reqMsg'; // Set the ID for the <p> element
            reqMsg.textContent = '';

            // Append the <p> element to the div

            if (!prevCompleted) {
                disableButton('next');
                let metReqs = budgetRequirementsMet();
                reqMsg.classList.remove('text-red-500', 'text-green-500');
                reqMsg.textContent = `${metReqs}/5 budget requirements are met.`;
                reqMsg.classList.add('font-bold', 'text-red-500');
            }
            additionalInfoDiv.appendChild(reqMsg);
        });
        
        function populateBudgetEntries() {
            budgetEntries.forEach(entry => {
                listItem = document.createElement('li');
                listItem.textContent = `Month: ${entry.month}, Week: ${entry.week}, 
                                        Label: ${entry.label}, Amount: $${entry.amount}`;
                document.querySelector('#inputs ul').appendChild(listItem);
            });
        }

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
            listItem.textContent = `Month: ${budgetData.month}, Week: ${budgetData.week}, 
                                    Label: ${budgetData.label}, Amount: $${budgetData.amount}`;
            document.querySelector('#inputs ul').appendChild(listItem);

            updateForm('budgetEntries', budgetEntries, `Added budget entry: ${listItem.textContent}`);
            renderNavBar();
        }

        function undoEntry() {
            if (budgetEntries.length > 0) {
                // Remove the last entry from the array
                const lastEntry = budgetEntries.pop();

                const listItems = document.querySelector('#inputs ul').getElementsByTagName('li');

                // Remove the last <li> element from the list
                if (listItems.length > 0) {
                    listItems[listItems.length - 1].remove();
                }

                // Log the action
                updateForm('budgetEntries', budgetEntries, 
                            `Removed budget entry: Month: ${lastEntry.month}, Week: ${lastEntry.week}, 
                            Label: ${lastEntry.label}, Amount: $${lastEntry.amount}`);
                writeLog();
                
                // Update the navbar after removing the entry
                renderNavBar();
            } else {
                alert('No entries to undo!');
            }
        }

        function parseToFloat(x) {
            return !isNaN(x) && parseFloat(x).toString() === x ? parseFloat(x) : x;
        }

        function validateInput() {
            const label = document.getElementById('incomeLabel').value;
            const amount = parseToFloat(document.getElementById('amount').value);
            const month = document.getElementById('month').value;
            const week = document.getElementById('week').value;
            const budgetData = {
                label: label,
                amount: amount,
                month: month,
                week: week,
            };
            if (!label || !amount || !month || !week) {
                alert('Please provide a label, an amount, a month, and a week.');
                return false;
            }
            return budgetData;
        }

        function renderNavBar() {
            const reqMsg = document.getElementById('additionalInfo');
            let metReqs = budgetRequirementsMet();
            reqMsg.classList.remove('text-red-500', 'text-green-500');
            reqMsg.innerHTML = `${metReqs}/5 budget requirements are met.`;

            if (!prevCompleted && metReqs == 5) {
                writeLog(`Completed budget tracker activity on ${page}`);
                prevCompleted = true;
                updateForm('completed', true);
            }
            
            if (!reqMsg.classList.contains('font-bold')) {
                reqMsg.classList.add('font-bold');
            }
            if (prevCompleted){
                enableButton('next');
                reqMsg.classList.add('text-green-500');
            } else {
                reqMsg.classList.add('text-red-500');
            }
        }

        function budgetRequirementsMet() {
            let metReqs = 0;
            
            // Check for biweekly income labeled "Work" for 2000
            let isOnOddWeeks = false;

            let workEntries = [];
            let workEntriesMap = new Map();
            budgetEntries.forEach(entry => {
                if (entry.label === "Work" && entry.amount === 2000) {
                    workEntries.push(entry);
                    workEntriesMap.set(`${entry.month}-${entry.week}`, true);
                }
            });
            // Array length checks for 12 total entries while Map length checks for 12 unique entries
            // This is to make sure this case is false: 
            // (k > 12) if we had k entries, with k-12 of those being duplicates.
            if (workEntries.length === 12 && workEntriesMap.size === 12) {
                // Determine if the first "Work" entry is on an odd or even week
                isOnOddWeeks = workEntries[0].week % 2 !== 0;
                
                // Check if there are 12 "Work" entries with biweekly pattern in all six months
                let validWorkEntries = workEntries.every(entry => 
                    (isOnOddWeeks && entry.week % 2 !== 0 || !isOnOddWeeks && entry.week % 2 === 0));
                
                if (validWorkEntries) {
                    metReqs += 1;
                    document.getElementById('workCheck').textContent = '✓';
                    document.getElementById('workCheck').className = 'text-green-500 font-bold';
                } else {
                    document.getElementById('workCheck').textContent = '•';
                    document.getElementById('workCheck').className = '';
                }
            }
            
            // Check for monthly expense labeled "Rent" for -1500
            let rentEntries = [];
            let rentEntriesMap = new Map();
            budgetEntries.forEach(entry => {
                if (entry.label === "Rent" && entry.amount === -1500) {
                    rentEntries.push(entry);
                    rentEntriesMap.set(entry.month, true);
                }
            });

            // Array length checks for 6 total entries while Map length checks for 6 unique entries
            // This is to make sure this case is false: 
            // (k > 24) if we had k entries, with k-6 of those being duplicates.
            if (rentEntries.length === 6 && rentEntriesMap.size === 6) {
                metReqs += 1;
                document.getElementById('rentCheck').textContent = '✓';
                document.getElementById('rentCheck').className = 'text-green-500 font-bold';
            } else {
                document.getElementById('rentCheck').textContent = '•';
                document.getElementById('rentCheck').className = '';
            }

            // Check for monthly expense labeled "Utilities" for -400
            let utilitiesEntries = [];
            let utilitiesEntriesMap = new Map();
            budgetEntries.forEach(entry => {
                if (entry.label === "Utilities" && entry.amount === -400) {
                    utilitiesEntries.push(entry);
                    utilitiesEntriesMap.set(entry.month, true);
                }
            });

            // Array length checks for 6 total entries while Map length checks for 6 unique entries
            // This is to make sure this case is false: 
            // (k > 24) if we had k entries, with k-6 of those being duplicates.
            if (utilitiesEntries.length === 6 && utilitiesEntriesMap.size === 6) {
                metReqs += 1;
                document.getElementById('utilitiesCheck').textContent = '✓';
                document.getElementById('utilitiesCheck').className = 'text-green-500 font-bold';
            } else {
                document.getElementById('utilitiesCheck').textContent = '•';
                document.getElementById('utilitiesCheck').className = '';
            }

            // Check for weekly expense labeled "Groceries" for -100
            let groceriesEntries = [];
            let groceriesEntriesMap = new Map();
            budgetEntries.forEach(entry => {
                if (entry.label === "Groceries" && entry.amount === -100) {
                    groceriesEntries.push(entry);
                    groceriesEntriesMap.set(`${entry.month}-${entry.week}`, true);
                }
            });

            // Array length checks for 24 total entries while Map length checks for 24 unique entries
            // This is to make sure this case is false: 
            // (k > 24) if we had k entries, with k-24 of those being duplicates. 
            if (groceriesEntries.length === 24 && groceriesEntriesMap.size === 24) {
                metReqs += 1;
                document.getElementById('groceriesCheck').textContent = '✓';
                document.getElementById('groceriesCheck').className = 'text-green-500 font-bold';
            } else {
                document.getElementById('groceriesCheck').textContent = '•';
                document.getElementById('groceriesCheck').className = '';
            }

            // Check for semiannual income labeled "Bonus" for 3000
            bonusEntries = budgetEntries.filter(entry => entry.label === "Bonus" && entry.amount === 3000);
            if (bonusEntries.length === 1) {
                metReqs += 1;
                document.getElementById('bonusCheck').textContent = '✓';
                document.getElementById('bonusCheck').className = 'text-green-500 font-bold';
            } else {
                document.getElementById('bonusCheck').textContent = '•';
                document.getElementById('bonusCheck').className = '';
            }
            
            return metReqs;
        }
    </script>

    <!-- Input Section -->
    <h1 class="text-3xl font-bold text-center mb-6">Budget Tracker v2</h1>
    
    <h2 class="text-xl font-semibold mb-4">Add Income/Expense</h2>
    <div class="flex flex-col mb-4">
        <label for="incomeLabel" class="font-semibold mb-2">Label: </label>
        <input {{ $locked ? 'disabled' : '' }} type="text" id="incomeLabel" class="border border-gray-300 p-2 rounded" placeholder="e.g. Work, Rent" />
    </div>

    <div class="flex items-center gap-x-4 mb-4">
        <div class="flex items-center">
            <label for="amount" class="mr-2">Amount:</label>
            <input {{ $locked ? 'disabled' : '' }} type="text" id="amount" name="amount" class="border border-gray-300 p-2 rounded w-96" placeholder="Enter Amount">
        </div>

        <div class="flex items-center">
            <label for="month" class="mr-2">Month:</label>
            <input {{ $locked ? 'disabled' : '' }} type="number" id="month" name="month" min="1" max="6" class="border border-gray-300 p-2 rounded w-16">
        </div>

        <div class="flex items-center">
            <label for="week" class="mr-2">Week:</label>
            <input {{ $locked ? 'disabled' : '' }} type="number" id="week" name="week" min="1" max="4" class="border border-gray-300 p-2 rounded w-16">
        </div>
    </div>


    <button {{ $locked ? 'disabled' : '' }} onclick="addEntry('income')" type="button" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-2">Add Income</button>
    <button {{ $locked ? 'disabled' : '' }} onclick="addEntry('expense')" type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Add Expense</button>
    <button {{ $locked ? 'disabled' : '' }} onclick="undoEntry()" type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2">Undo</button>

    
    <!-- Output Section -->
    <div id="inputs">
        <h3 class="text-xl font-semibold mt-6">Budget Entries:</h3>
        <ul class="list-disc ml-6"></ul>
    </div>
@endsection