@php
$options = ["Low Complexity", "Medium Complexity", "High Complexity"]
@endphp

<!-- Instruction Block -->
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <p><strong>Scenario Description:</strong> The Hospital Management System (HMS) is designed to handle key operations including patient registration, scheduling, medical records, billing, and external system integration.</p>
    <ul class="list-disc pl-6">
        <li><strong>Patient Registration and Management:</strong> Patients input personal details, medical history, and insurance information. Data validation occurs against internal patient records and external insurance databases. Consider the data fields and interactions.</li>
        <li><strong>Doctor Scheduling and Appointment System:</strong> Staff schedule appointments based on doctor availability and patient needs. The system generates doctor schedules, sends reminders, and produces consultation summaries and prescriptions.</li>
        <li><strong>Appointment Search and History Lookup:</strong> Allows staff to search patient histories by date, doctor, or treatment. Displays past appointment data for review.</li>
        <li><strong>Patient Records and Billing Information:</strong> Manages extensive records, including medical history, treatments, and billing. Regular updates and integration with billing and insurance systems occur.</li>
        <li><strong>Insurance Integration and Lab Reports:</strong> Interfaces with external insurance verification and lab systems to retrieve test results and manage patient insurance claims.</li>
    </ul>
    <p>Use <strong>File Types Referenced (FTR)</strong> and <strong>Data Element Types (DET)</strong> to determine the complexity of each component.</p>
</div>
<!-- Questions Section (Only 1 question visible at a time) -->
<div class="bg-white p-6 rounded-lg shadow mb-6" id="questionContainer">

    <!-- Question 1: External Inputs (EI) -->
    <div id="question1" class="question">
        @include('components.dropdown', ["question" => "Q1. Patient Registration and Management (External Inputs - EI)", "name" => "exercise-q1-dropdown", "options" => $options, "context" => "Allows patients to register their personal details, medical history, and insurance information.", "id" => "exercise_EI"])
        <br><br>
        @include('components.textbox', ["question" => "Explain why you chose this complexity. What assumptions are you making?", "name" => "exercise-q1-text", "id" => "exercise_EI_explanation"])
    </div>

    <!-- Question 2: External Outputs (EO) -->
    <div id="question2" class="question">
        @include('components.dropdown', ["question" => "Q2. Doctor Scheduling and Appointment System (External Outputs - EO)", "name" => "exercise-q2-dropdown", "options" => $options, "context" => "Generates doctor schedules, provides appointment summaries, and prescriptions.", "id" => "exercise_EO"])
        <br><br>
        @include('components.textbox', ["question" => "Explain why you chose this complexity. What assumptions are you making?", "name" => "exercise-q2-text", "id" => "exercise_EO_explanation"])
        <div class="flex justify-between mt-4">
        </div>
    </div>

    <!-- Question 3: External Inquiries (EQ) -->
    <div id="question3" class="question">
        @include('components.dropdown', ["question" => "Q3. Appointment Search and History Lookup (External Inquiries - EQ)", "name" => "exercise-q3-dropdown", "options" => $options, "context" => "Allows staff to search and view past appointments without modifying the data.", "id" => "exercise_EQ"])
        <br><br>
        @include('components.textbox', ["question" => "Explain why you chose this complexity. What assumptions are you making?", "name" => "exercise-q3-text", "id" => "exercise_EQ_explanation"])

    </div>

    <!-- Repeat for Question 4: Internal Logical Files (ILF) -->
    <div id="question4" class="question">
        @include('components.dropdown', ["question" => "Q4. Patient Records and Billing Information (Internal Logical Files - ILF)", "name" => "exercise-q4-dropdown", "options" => $options, "context" => "Stores patient data, including medical history, treatments, and billing records.", "id" => "exercise_ILF"])
        <br><br>
        @include('components.textbox', ["question" => "Explain why you chose this complexity. What assumptions are you making?", "name" => "exercise-q4-text", "id" => "exercise_ILF_explanation"])
        <div class="flex justify-between mt-4">
        </div>
    </div>

    <!-- Repeat for Question 5: External Interface Files (EIF) -->
    <div id="question5" class="question">
        @include('components.dropdown', ["question" => "Q5. Insurance Integration and Lab Reports (External Interface Files - EIF)", "name" => "exercise-q5-dropdown", "options" => $options, "context" => "Integrates with external systems for real-time insurance verification and lab results.", "id" => "exercise_EIF"])
        <br><br>
        @include('components.textbox', ["question" => "Explain why you chose this complexity. What assumptions are you making?", "name" => "exercise-q5-text", "id" => "exercise_EIF_explanation"])

        <div class="flex justify-between mt-4">
            <button id="submitButton" class="bg-gray-400 text-white px-4 py-2 rounded " disabled
                onclick="submitAssignment(event)">Submit</button>
        </div>
    </div>

    <!-- Result Section (Hidden initially) -->
    <div id="result" class="bg-green-100 p-4 mt-4 rounded-lg shadow" style="display:none;">
        <h3 class="text-xl font-bold">Total Function Points: <span id="totalFP"></span></h3>
        <p class="text-gray-700 mt-2 italic">Reflection: Compare your total FPA with an industry-standard estimate (39 points is the correct answer). What insights or adjustments would you make based on this exercise?</p>
    </div>

    <!-- Feedback Section (Hidden initially) -->
    <div id="feedback" class="bg-yellow-100 p-4 mt-4 rounded-lg shadow" style="display:none;">
        <h3 class="text-xl font-bold">Explanation of the Correct Complexity Levels:</h3>
        <ul id="explanationList" class="list-disc pl-6"></ul>
    </div>

    <!-- Reveal Answer Button (Hidden initially) -->
    <div id="revealAnswerButton" class="flex justify-center mt-4" style="display:none;">
        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="revealAnswer()">Reveal Answer</button>
    </div>

    <script>
        function checkAllAnswered() {
            const dropdowns = [
                document.getElementById('exercise_EI'),
                document.getElementById('exercise_EO'),
                document.getElementById('exercise_EQ'),
                document.getElementById('exercise_ILF'),
                document.getElementById('exercise_EIF')
            ];

            const textareas = Array.from(document.querySelectorAll('.question textarea'));

            // Check if all dropdowns have a value selected and all textareas are filled
            const allAnswered = dropdowns.every(dropdown => dropdown && dropdown.value) &&
                textareas.every(textarea => textarea && textarea.value.trim());

            // Get the submit button element
            const submitButton = document.getElementById('submitButton');

            // Check if submitButton exists before manipulating it
            if (submitButton) {
                if (allAnswered) {
                    submitButton.classList.remove("bg-gray-400", "cursor-not-allowed");
                    submitButton.classList.add("bg-green-500", "hover:bg-green-600", "cursor-pointer");
                    submitButton.disabled = false;
                    submitButton.style.pointerEvents = "auto";
                } else {
                    submitButton.classList.remove("bg-green-500", "hover:bg-green-600", "cursor-pointer");
                    submitButton.classList.add("bg-gray-400", "cursor-not-allowed");
                    submitButton.disabled = true;
                    submitButton.style.pointerEvents = "none";
                }
            }
        }


        function submitAssignment(event) {
            event.preventDefault();
            const dropdowns = [
                document.getElementById('exercise_EI'),
                document.getElementById('exercise_EO'),
                document.getElementById('exercise_EQ'),
                document.getElementById('exercise_ILF'),
                document.getElementById('exercise_EIF')
            ];

            const complexityWeights = {
                exercise_EI: {
                    "Low Complexity": 3,
                    "Medium Complexity": 4,
                    "High Complexity": 6
                },
                exercise_EO: {
                    "Low Complexity": 4,
                    "Medium Complexity": 5,
                    "High Complexity": 7
                },
                exercise_EQ: {
                    "Low Complexity": 3,
                    "Medium Complexity": 4,
                    "High Complexity": 6
                },
                exercise_ILF: {
                    "Low Complexity": 7,
                    "Medium Complexity": 10,
                    "High Complexity": 15
                },
                exercise_EIF: {
                    "Low Complexity": 5,
                    "Medium Complexity": 7,
                    "High Complexity": 10
                }
            };

            let totalPoints = 0;
            const correctTotalPoints = 39;
            const studentAnswers = {
                exercise_EI: dropdowns[0]?.value,
                exercise_EO: dropdowns[1]?.value,
                exercise_EQ: dropdowns[2]?.value,
                exercise_ILF: dropdowns[3]?.value,
                exercise_EIF: dropdowns[4]?.value
            };
            const correctAnswers = {
                exercise_EI: 'High Complexity',
                exercise_EO: 'High Complexity',
                exercise_EQ: 'Medium Complexity',
                exercise_ILF: 'High Complexity',
                exercise_EIF: 'Medium Complexity'
            };

            const incorrectAnswers = [];

            for (let key in studentAnswers) {
                if (studentAnswers[key]) {
                    totalPoints += complexityWeights[key][studentAnswers[key]];
                    if (studentAnswers[key] !== correctAnswers[key]) {
                        incorrectAnswers.push(key);
                    }
                }
            }
            console.log(totalPoints)
            // Update the UI with calculated points
            document.getElementById('totalFP').textContent = String(totalPoints);
            document.getElementById('result').style.display = 'block';

            const feedback = document.getElementById('feedback');
            const explanationList = document.getElementById('explanationList');
            explanationList.innerHTML = '';

            // Show hints if there are incorrect answers
            if (incorrectAnswers.length > 0) {
                feedback.style.display = 'block';

                // Populate hints for each incorrect answer
                incorrectAnswers.forEach(answer => {
                    switch (answer) {
                        case 'exercise_EI':
                            explanationList.innerHTML += `<li><strong>Hint for Patient Registration and Management (EI):</strong> Consider the variety of data types entered here, including personal information, medical history, and any billing details. This component involves extensive user interaction, with multiple fields that must be validated against internal patient records and external insurance databases. </li>`;
                            break;
                        case 'exercise_EO':
                            explanationList.innerHTML += `<li><strong>Hint for Doctor Scheduling and Appointment System (EO):</strong> Focus on the outputs generated by this system. Are there multiple schedules, notifications, or appointment details provided? Consider how structured and organized the output needs to be for smooth scheduling and patient coordination.</li>`;
                            break;
                        case 'exercise_EQ':
                            explanationList.innerHTML += `<li><strong>Hint for Appointment Search and History Lookup (EQ):</strong> Look at the search functionality for our given problem – does it need to filter by multiple parameters like date, doctor, or patient history? Assess if the system involves complex search mechanisms or if it’s a straightforward query that pulls specific information without a complex lookup.</li>`;
                            break;
                        case 'exercise_ILF':
                            explanationList.innerHTML += `<li><strong>Hint for Patient Records and Billing Information (ILF):</strong> Examine the amount and type of data stored here, including patient records and financial details. Think about how often this data is accessed, updated, and whether it supports different types of records, impacting its overall complexity.</li>`;
                            break;
                        case 'exercise_EIF':
                            explanationList.innerHTML += `<li><strong>Hint for Insurance Integration and Lab Reports (EIF):</strong> This part connects with external systems, such as insurance providers and lab services. Consider the nature of the data exchange – is it simple or does it require detailed, structured data transfer? The complexity often increases with the need for reliable, accurate integration between systems.</li>`;
                            break;
                    }
                });
            } else {
                // Display the correct answer explanations if all answers are correct
                feedback.style.display = 'block';
                explanationList.innerHTML = '';
                explanationList.innerHTML += `<li><strong>Patient Registration and Management (External Input - EI):</strong> This component has a high complexity level, earning 6 Function Points. It involves handling a large volume of input data, including personal, medical, and contact information, making it a crucial interactive part of the system with complex data handling requirements.</li>`;
                explanationList.innerHTML += `<li><strong>Doctor Scheduling and Appointment System (External Output - EO):</strong> Rated as high complexity, with 7 Function Points, this component manages important and complex scheduling data. It generates structured outputs that accommodate doctors’ schedules, appointment times, and patient notifications, requiring careful handling to maintain organization and usability.</li>`;
                explanationList.innerHTML += `<li><strong>Appointment Search and History Lookup (External Inquiry - EQ):</strong> With a medium complexity rating of 4 Function Points, this component provides a search feature for retrieving appointment history. While not overly complex, it does involve moderate querying capabilities to filter information by parameters like dates, doctors, or specific patient records.</li>`;
                explanationList.innerHTML += `<li><strong>Patient Records and Billing Information (Internal Logical File - ILF):</strong> Classified as high complexity at 15 Function Points, this component is responsible for storing and accessing extensive data related to patient medical records and billing. Given the volume and critical nature of the data, it requires robust functionality to support frequent access and updates.</li>`;
                explanationList.innerHTML += `<li><strong>Insurance Integration and Lab Reports (External Interface File - EIF):</strong> This component has medium complexity, with 7 Function Points. It involves integration with external systems, such as insurance providers and lab services, facilitating the secure and structured exchange of data, which adds complexity to the problem.</li>`;
            }
        }


        function revealAnswer() {
            document.getElementById('feedback').style.display = 'block';
            const explanationList = document.getElementById('explanationList');
            explanationList.innerHTML = '';
            explanationList.innerHTML += `<li><strong>Patient Registration and Management (External Input - EI):</strong> This component has a high complexity level, earning 6 Function Points. It involves handling a large volume of input data, including personal, medical, and contact information, making it a crucial interactive part of the system with complex data handling requirements.</li>`;
            explanationList.innerHTML += `<li><strong>Doctor Scheduling and Appointment System (External Output - EO):</strong> Rated as high complexity, with 7 Function Points, this component manages important and complex scheduling data. It generates structured outputs that accommodate doctors’ schedules, appointment times, and patient notifications, requiring careful handling to maintain organization and usability.</li>`;
            explanationList.innerHTML += `<li><strong>Appointment Search and History Lookup (External Inquiry - EQ):</strong> With a medium complexity rating of 4 Function Points, this component provides a search feature for retrieving appointment history. While not overly complex, it does involve moderate querying capabilities to filter information by parameters like dates, doctors, or specific patient records.</li>`;
            explanationList.innerHTML += `<li><strong>Patient Records and Billing Information (Internal Logical File - ILF):</strong>  Classified as high complexity at 15 Function Points, this component is responsible for storing and accessing extensive data related to patient medical records and billing. Given the volume and critical nature of the data, it requires robust functionality to support frequent access and updates.</li>`;
            explanationList.innerHTML += `<li><strong>Insurance Integration and Lab Reports (External Interface File - EIF):</strong> This component has medium complexity, with 7 Function Points. It involves integration with external systems, such as insurance providers and lab services, facilitating the secure and structured exchange of data, which adds complexity to the problem.</li>`;
            document.getElementById('revealAnswerButton').style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const inputs = [
                ...document.querySelectorAll('.answer-dropdown'),
                ...document.querySelectorAll('.question textarea')
            ];
            checkAllAnswered();
            inputs.forEach(input => {
                input.addEventListener('input', checkAllAnswered);
            });
        });
    </script>