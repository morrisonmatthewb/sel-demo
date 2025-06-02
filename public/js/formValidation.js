console.log("formValidation.js loaded");
document.addEventListener("DOMContentLoaded", function () {
    function checkAllAnswered() {
        // Check if all dropdowns on the current page have values selected
        const dropdowns = document.querySelectorAll('.survey-question, .answer-dropdown');
        const allDropdownsAnswered = Array.from(dropdowns).every(dropdown => dropdown.value !== "");

        // Check if the textarea on the current page is filled (if it exists)
        const reflectionTextarea = document.querySelector('textarea[name="live-demo-2_q6"]');
        const risksChallengesTextarea = document.querySelector('textarea[name="pre-survey_q4"]');
        
        const isReflectionFilled = reflectionTextarea ? reflectionTextarea.value.trim() !== '' : true;
        const isRisksChallengesFilled = risksChallengesTextarea ? risksChallengesTextarea.value.trim() !== '' : true;

        // Enable or disable the Next button based on criteria for fields present on the page
        const nextButton = document.getElementById('next-button');
        if (allDropdownsAnswered && isReflectionFilled && isRisksChallengesFilled) {
            nextButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
            nextButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
            nextButton.style.pointerEvents = 'auto';
        } else {
            nextButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            nextButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
            nextButton.style.pointerEvents = 'none';
        }
    }

    // Attach event listeners for each dropdown and any textarea on the page
    document.querySelectorAll('.survey-question, .answer-dropdown').forEach((element) => {
        element.addEventListener('change', checkAllAnswered);
    });

    const reflectionTextarea = document.querySelector('textarea[name="live-demo-2_q6"]');
    if (reflectionTextarea) {
        reflectionTextarea.addEventListener('input', checkAllAnswered);
    }

    const risksChallengesTextarea = document.querySelector('textarea[name="pre-survey_q4"]');
    if (risksChallengesTextarea) {
        risksChallengesTextarea.addEventListener('input', checkAllAnswered);
    }

    // Initial check when the page loads to set the Next button's state correctly
    checkAllAnswered();
});
