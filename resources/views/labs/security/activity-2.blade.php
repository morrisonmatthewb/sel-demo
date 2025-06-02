<!-- Scenario Description -->
<div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
    <h2 class=" font-bold mb-2">Scenario: E-commerce Website Redesign</h2>
    <p class="mb-2">You're tasked with improving the security and usability of an e-commerce website that sells
        handmade crafts. The site needs to:</p>
    <ul class="list-disc pl-6 mb-2">
        <li>Protect customer payment information</li>
        <li>Keep user accounts secure</li>
        <li>Maintain an easy shopping experience</li>
        <li>Support both regular and guest customers</li>
    </ul>
    <p class="font-bold">Goal: Achieve at least 70/100 for both security and usability ratings</p>
</div>

<!-- Score Display -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6" id="score-display" 
    class="{{ isset($lastAttempt) ? '' : 'hidden' }}">
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-bold mb-2">Security Score</h3>
        <div class="relative pt-1">
            <div class="flex mb-2 items-center justify-between">
                <div>
                    <span id="security-score"
                        class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white 
                        {{ isset($lastAttempt) && $lastAttempt['security_score'] >= 70 ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ isset($lastAttempt) ? $lastAttempt['security_score'] : '0' }}/100
                    </span>
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                <div id="security-progress" 
                    style="width:{{ isset($lastAttempt) ? $lastAttempt['security_score'] : '0' }}%"
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center 
                    {{ isset($lastAttempt) && $lastAttempt['security_score'] >= 70 ? 'bg-green-500' : 'bg-red-500' }} 
                    transition-all duration-500">
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-bold mb-2">Usability Score</h3>
        <div class="relative pt-1">
            <div class="flex mb-2 items-center justify-between">
                <div>
                    <span id="usability-score"
                        class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-red-500">
                        0/100
                    </span>
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                <div id="usability-progress" style="width:0%"
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500 transition-all duration-500">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Security Measures Selection -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold mb-4 text-center ">Authentication Measures</h3>
        <div class="space-y-3">
            <!-- Password Security -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Password Security</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Basic Requirements (min 8 chars)']) ? 'checked' : '' }}>
                        <span>Basic Requirements (min 8 chars)</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Complex Requirements (16+ chars, special chars)']) ? 'checked' : '' }}>
                        <span>Complex Requirements (16+ chars, special chars)</span>
                    </label>
                </div>
            </div>

            <!-- 2FA Options -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Two-Factor Authentication</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Optional 2FA']) ? 'checked' : '' }}>
                        <span>Optional 2FA</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Mandatory 2FA']) ? 'checked' : '' }}>
                        <span>Mandatory 2FA</span>
                    </label>
                </div>
            </div>

            <!-- Login Options -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Login Options</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Social Media Login']) ? 'checked' : '' }}>
                        <span>Social Media Login</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Guest Checkout']) ? 'checked' : '' }}>
                        <span>Guest Checkout</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Remember Me Option']) ? 'checked' : '' }}>
                        <span>Remember Me Option</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold mb-4 text-center">Session & Data Security</h3>
        <div class="space-y-3">
            <!-- Encryption Options -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Data Encryption</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['HTTPS Encryption']) ? 'checked' : '' }}>
                        <span>HTTPS Encryption</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['End-to-End Encryption']) ? 'checked' : '' }}>
                        <span>End-to-End Encryption</span>
                    </label>
                </div>
            </div>

            <!-- Session Management -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Session Management</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['24-hour Session Timeout']) ? 'checked' : '' }}>
                        <span>24-hour Session Timeout</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['7-day Session with Remember Me']) ? 'checked' : '' }}>
                        <span>7-day Session with Remember Me</span>
                    </label>
                </div>
            </div>

            <!-- Payment Security -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Payment Security</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Basic Payment Gateway']) ? 'checked' : '' }}>
                        <span>Basic Payment Gateway</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['PCI Compliant Gateway']) ? 'checked' : '' }}>
                        <span>PCI Compliant Gateway</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Security Features -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold mb-4 text-center ">Additional Security Features</h3>
        <div class="space-y-3">
            <!-- Login Enhancements -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Login Enhancements</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Biometric Login Option']) ? 'checked' : '' }}>
                        <span>Biometric Login Option</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Rate Limiting on Login']) ? 'checked' : '' }}>
                        <span>Rate Limiting on Login</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Device Fingerprinting']) ? 'checked' : '' }}>
                        <span>Device Fingerprinting</span>
                    </label>
                </div>
            </div>

            <!-- Account Recovery -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Account Recovery</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Password Recovery Email']) ? 'checked' : '' }}>
                        <span>Password Recovery Email</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Security Questions']) ? 'checked' : '' }}>
                        <span>Security Questions</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold mb-4 text-center">Enhanced User Experience</h3>
        <div class="space-y-3">
            <!-- Monitoring Features -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Account Monitoring</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['IP-based Login Alerts']) ? 'checked' : '' }}>
                        <span>IP-based Login Alerts</span>
                    </label>
                </div>
            </div>

            <!-- Quick Checkout -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">Quick Checkout Features</h4>
                <div class="ml-4 space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['Save Card for Later']) ? 'checked' : '' }}>
                        <span>Save Card for Later</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" class="form-checkbox" name="security-option"
                            {{ isset($lastAttempt) && isset($lastAttempt['selected_options']['One-Click Checkout']) ? 'checked' : '' }}>
                        <span>One-Click Checkout</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Submit Button -->
<div class="text-center mb-6">
    <button onclick="calculateScores()" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
        Submit Security Choices
    </button>
</div>

<!-- Feedback Area -->
<div id="feedback" class="bg-white p-6 rounded-lg shadow mb-6 hidden">
    <h3 class="font-bold mb-2">Analysis Feedback</h3>
    <p id="feedback-text" class="text-gray-700"></p>
</div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-green-600">Challenge Complete!</h2>
        <p class="mb-4">Congratulations! You've successfully balanced security and usability.</p>
        <button onclick="closeSuccessModal()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Continue
        </button>
    </div>
</div>

<script>
    const measures = [
        'Basic Requirements (min 8 chars)',
        'Complex Requirements (16+ chars, special chars)',
        'Optional 2FA',
        'Mandatory 2FA',
        'Social Media Login',
        'Guest Checkout',
        'Remember Me Option',
        'HTTPS Encryption',
        'End-to-End Encryption',
        '24-hour Session Timeout',
        '7-day Session with Remember Me',
        'Basic Payment Gateway',
        'PCI Compliant Gateway',
        'Biometric Login Option',
        'Rate Limiting on Login',
        'Password Recovery Email',
        'Security Questions',
        'IP-based Login Alerts',
        'Save Card for Later',
        'One-Click Checkout',
        'Device Fingerprinting'
    ];

    // Initialize checkboxes based on last attempt
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($lastAttempt))
            // Show the score display
            document.getElementById('score-display').classList.remove('hidden');
            
            // Update scores
            updateUI(
                {{ $lastAttempt['security_score'] }}, 
                {{ $lastAttempt['usability_score'] }}
            );
        @endif
    });

    async function calculateScores() {
        try {
            // Get all selected options
            const selectedOptions = {};
            document.querySelectorAll('input[name="security-option"]:checked').forEach(checkbox => {
                const optionName = checkbox.nextElementSibling.textContent.trim();
                selectedOptions[optionName] = true;
            });

            // Send to endpoint and get response
            const response = await fetch('{{ route("modules.labpost", ["lab" => "security", "subroute" => "balance-challenge-handler"]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    selected_options: selectedOptions
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            if (!result.success) {
                throw new Error(result.message || 'Unknown error occurred');
            }

            // Update UI with scores from server
            document.getElementById('score-display').classList.remove('hidden');
            updateUI(result.security_score, result.usability_score);

            // Show modal based on server response
            if (result.challenge_completed) {
                document.getElementById('successModal').classList.remove('hidden');
                document.getElementById('successModal').classList.add('flex');
            }

        } catch (error) {
            console.error('Error calculating scores:', error);
            alert('An error occurred while calculating scores. Please try again.');
        }
    }

    function updateUI(securityScore, usabilityScore) {
        const securityProgress = document.getElementById('security-progress');
        const usabilityProgress = document.getElementById('usability-progress');
        const securityScoreElement = document.getElementById('security-score');
        const usabilityScoreElement = document.getElementById('usability-score');

        // Update widths
        securityProgress.style.width = `${securityScore}%`;
        usabilityProgress.style.width = `${usabilityScore}%`;

        // Update score text
        securityScoreElement.textContent = `${Math.round(securityScore)}/100`;
        usabilityScoreElement.textContent = `${Math.round(usabilityScore)}/100`;

        // Update colors based on scores
        if (securityScore >= 70) {
            securityProgress.classList.remove('bg-red-500');
            securityProgress.classList.add('bg-green-500');
            securityScoreElement.classList.remove('bg-red-500');
            securityScoreElement.classList.add('bg-green-500');
        } else {
            securityProgress.classList.remove('bg-green-500');
            securityProgress.classList.add('bg-red-500');
            securityScoreElement.classList.remove('bg-green-500');
            securityScoreElement.classList.add('bg-red-500');
        }

        if (usabilityScore >= 70) {
            usabilityProgress.classList.remove('bg-red-500');
            usabilityProgress.classList.add('bg-green-500');
            usabilityScoreElement.classList.remove('bg-red-500');
            usabilityScoreElement.classList.add('bg-green-500');
        } else {
            usabilityProgress.classList.remove('bg-green-500');
            usabilityProgress.classList.add('bg-red-500');
            usabilityScoreElement.classList.remove('bg-green-500');
            usabilityScoreElement.classList.add('bg-red-500');
        }
    }

    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>