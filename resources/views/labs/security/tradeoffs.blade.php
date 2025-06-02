<script src="https://www.google.com/recaptcha/api.js"></script>
<div class="bg-gray-100 min-h-screen flex flex-col justify-between">
    <div class="container mx-auto px-6 py-8 flex-grow">
        <h1 class="text-3xl font-bold mb-6">Security vs. Usability Tradeoffs</h1>

        <!-- Options Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <button onclick="showInterface('high-security')"
                class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow {{ $formData['learn_more_clicked']['high-security'] ?? false ? 'ring-2 ring-blue-500' : '' }}">
                <h2 class="text-xl font-bold mb-2">High Security, Low Usability</h2>
                <p class="text-gray-600">Maximum protection, complex user experience</p>
            </button>

            <button onclick="showInterface('high-usability')"
                class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow {{ $formData['learn_more_clicked']['high-usability'] ?? false ? 'ring-2 ring-blue-500' : '' }}">
                <h2 class="text-xl font-bold mb-2">High Usability, Low Security</h2>
                <p class="text-gray-600">Seamless experience, minimal protection</p>
            </button>

            <button onclick="showInterface('balanced')"
                class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow {{ $formData['learn_more_clicked']['balanced'] ?? false ? 'ring-2 ring-blue-500' : '' }}">
                <h2 class="text-xl font-bold mb-2">Balanced Approach</h2>
                <p class="text-gray-600">Security with user-friendly design</p>
            </button>
        </div>

        <!-- Mock Interface Display -->
        <div id="interface-display" class="bg-white p-6 rounded-lg shadow min-h-[500px]">
            <div class="text-center text-gray-500 mt-20">
                <p class="text-xl">Select an approach above to view its mock interface</p>
            </div>
        </div>
    </div>

    <div id="learnMoreModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl max-h-[80vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4" id="modalTitle"></h2>
            <div id="modalContent" class="prose"></div>
            <button onclick="closeLearnMoreModal()"
                class="mt-6 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Close
            </button>
        </div>
    </div>

    <div id="alertModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Notice</h2>
            <p id="modalMessage" class="mb-6"></p>
            <button onclick="closeModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                OK
            </button>
        </div>
    </div>
</div>
<script>
    const interfaces = {
        'high-security': `
                    <div class="max-w-md mx-auto">
                        <h2 class="text-2xl font-bold mb-6 text-center">Maximum Security Login</h2>
                        
                        <!-- Security Level Warning -->
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <p class="text-red-700">
                                ⚠️ High Security Mode Active: Multiple verification steps required
                            </p>
                        </div>

                        <!-- 2FA Setup Check -->
                        <div class="mb-6 bg-yellow-50 p-4 rounded">
                            <h3 class="font-bold mb-2">Required Security Steps:</h3>
                            <ul class="list-disc pl-4 space-y-1">
                                <li>Complete all verification challenges</li>
                                <li>Use security key or authenticator app</li>
                                <li>Verify device fingerprint</li>
                                <li>Accept terms of security policy</li>
                            </ul>
                        </div>

                        <!-- Login Form -->
                        <form onsubmit="return validateHighSecurity(event)" class="space-y-6">
                            <!-- Device Fingerprint Check -->
                            <div class="bg-gray-50 p-4 rounded">
                                <div class="flex items-center mb-2">
                                    <div id="security-spinner" class="animate-spin rounded-full h-4 w-4 border-b-2 border-gray-900 mr-2"></div>
                                    <span id="security-status">Verifying device security...</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    Checking: Browser integrity, VPN detection, Bot patterns
                                </div>
                            </div>

                            <!-- Username with requirements -->
                            <div>
                                <label class="block mb-1">Username</label>
                                <input type="text" id="high-sec-username"
                                    class="w-full p-2 border rounded"
                                    pattern="^(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{8,20}$"
                                    title="Username must be 8-20 characters, include a capital letter and a number"
                                    required>
                                <p class="text-sm text-gray-600 mt-1">
                                    8-20 characters, must include capital letter and number
                                </p>
                            </div>
                            
                            <!-- Enhanced Password Section -->
                            <div>
                                <label class="block mb-1">Password</label>
                                <input type="password" id="high-sec-password"
                                    class="w-full p-2 border rounded"
                                    oninput="checkPasswordStrength(this.value)"
                                    required>
                                
                                <!-- Password Requirements -->
                                <div class="password-requirements p-3 bg-yellow-50 rounded text-sm mt-2">
                                    <h3 class="font-bold mb-2">Enhanced Password Requirements:</h3>
                                    <ul class="list-none pl-0 space-y-1" id="password-checks">
                                        <li id="length-check" class="text-red-500">✗ Minimum 16 characters</li>
                                        <li id="upper-check" class="text-red-500">✗ At least 2 uppercase letters</li>
                                        <li id="lower-check" class="text-red-500">✗ At least 2 lowercase letters</li>
                                        <li id="number-check" class="text-red-500">✗ At least 2 numbers</li>
                                        <li id="special-check" class="text-red-500">✗ At least 2 special characters</li>
                                        <li id="sequence-check" class="text-red-500">✗ No sequential characters (123, abc)</li>
                                        <li id="repeat-check" class="text-red-500">✗ No repeated characters (aa, 11)</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Math CAPTCHA -->
                            <div class="mb-4 p-4 bg-gray-100 rounded">
                                <label class="block mb-2">Security Challenge 1: Math Verification</label>
                                <div id="captcha-question" class="font-bold mb-2"></div>
                                <input type="number" id="captcha-answer" 
                                    class="w-full p-2 border rounded"
                                    required>
                            </div>
                            
                            <!-- 2FA Verification -->
                            <div class="mb-4 p-4 bg-gray-100 rounded">
                                <label class="block mb-2 font-bold">Security Challenge 2: Two-Factor Authentication</label>
                                <div id="twoFactorSection">
                                    <p class="text-sm text-gray-600 mb-2">Enter the 6-digit code sent to your authenticator app</p>
                                    <div class="flex gap-2 mb-2">
                                        <input type="text" 
                                               id="2fa-code" 
                                               class="w-full p-2 border rounded"
                                               maxlength="6"
                                               placeholder="000000"
                                               pattern="[0-9]{6}"
                                               required>
                                        <button type="button" 
                                                onclick="verify2FA()"
                                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                            Verify
                                        </button>
                                    </div>
                                    <div id="2fa-status" class="text-sm"></div>
                                </div>
                            </div>

                            <!-- Security Agreement -->
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" required class="mr-2">
                                    I accept the enhanced security measures
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" required class="mr-2">
                                    I understand my session will expire in 2 minutes
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" required class="mr-2">
                                    I agree to immediate logout on any suspicious activity
                                </label>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                                Initiate Secure Login Protocol
                            </button>

                            <p class="text-xs text-gray-500 text-center">
                                Note: Failed verification will result in a 5-minute lockout
                            </p>
                        </form>
                    </div>
                `,
        'high-usability': `
                    <div class="max-w-md mx-auto">
                        <h2 class="text-2xl font-bold mb-6 text-center">Quick Login</h2>
                        
                        <form onsubmit="return validateHighUsability(event)" class="space-y-4">
                            <div>
                                <input type="text" 
                                    placeholder="Username (anything works!)"
                                    class="w-full p-3 border rounded text-lg">
                            </div>
                            
                            <div>
                                <input type="password" 
                                    placeholder="Password (minimum 4 characters)"
                                    class="w-full p-3 border rounded text-lg">
                            </div>

                            <button type="submit" 
                                    class="w-full bg-green-500 text-white p-3 rounded-lg text-lg hover:bg-green-600">
                                One-Click Login
                            </button>

                            <button onclick="" 
                                    class="w-full bg-gray-100 p-3 rounded-lg text-lg hover:bg-gray-200">
                                Continue as Guest
                            </button>
                        </form>
                    </div>
                `,
        'balanced': `
                    <div class="max-w-md mx-auto">
                        <h2 class="text-2xl font-bold mb-6 text-center">Smart Login</h2>
                        
                        <form onsubmit="return validateBalanced(event)" class="space-y-4">
                            <div>
                                <label class="block mb-1">Email</label>
                                <input type="email" id="balanced-email"
                                    class="w-full p-2 border rounded"
                                    required>
                            </div>
                            
                            <div>
                                <label class="block mb-1">Password</label>
                                <input type="password" id="balanced-password"
                                    class="w-full p-2 border rounded"
                                    required
                                    minlength="8">
                                <p class="text-sm text-gray-600 mt-1">
                                    Minimum 8 characters with letters and numbers
                                </p>
                            </div>

                            <div id="suspicious-activity-captcha" class="hidden">
                                <div class="g-recaptcha mb-4" 
                                    data-sitekey="YOUR_RECAPTCHA_SITE_KEY">
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                                Login
                            </button>
                        </form>
                    </div>
                `
    };

    // Track login attempts
    let loginAttempts = 0;
    let captchaNum1, captchaNum2;

    const learnMoreClicked = {!! json_encode($formData['learn_more_clicked'] ?? [
    'high-security' => false,
    'high-usability' => false,
    'balanced' => false
]) !!};

    function showInterface(type) {
        const display = document.getElementById('interface-display');
        display.innerHTML = interfaces[type];

        // Highlight selected approach
        document.querySelectorAll('.interface-button').forEach(btn => {
            btn.classList.remove('ring-2', 'ring-blue-500');
        });
        event.currentTarget.classList.add('ring-2', 'ring-blue-500');

        // Initialize components for high security interface
        if (type === 'high-security') {
            generateMathCaptcha();
            initializeSecurityCheck();

            // Initialize slider
            const slider = document.getElementById('slider-captcha');
            if (slider) {
                slider.addEventListener('input', function () {
                    updateSlider(this.value);
                });
            }
        }
    }

    function generateMathCaptcha() {
        captchaNum1 = Math.floor(Math.random() * 10) + 1;
        captchaNum2 = Math.floor(Math.random() * 10) + 1;
        document.getElementById('captcha-question').textContent =
            `What is ${captchaNum1} + ${captchaNum2}?`;
    }

    function checkPasswordStrength(password) {
        const checks = {
            'length-check': {
                test: password.length >= 16,
                text: 'Minimum 16 characters'
            },
            'upper-check': {
                test: (password.match(/[A-Z]/g) || []).length >= 2,
                text: 'At least 2 uppercase letters'
            },
            'lower-check': {
                test: (password.match(/[a-z]/g) || []).length >= 2,
                text: 'At least 2 lowercase letters'
            },
            'number-check': {
                test: (password.match(/[0-9]/g) || []).length >= 2,
                text: 'At least 2 numbers'
            },
            'special-check': {
                test: (password.match(/[^A-Za-z0-9]/g) || []).length >= 2,
                text: 'At least 2 special characters'
            },
            'sequence-check': {
                test: !(/abc|bcd|cde|def|efg|234|345|456|567/.test(password.toLowerCase())),
                text: 'No sequential characters (123, abc)'
            },
            'repeat-check': {
                test: !(/(.)\1/.test(password)),
                text: 'No repeated characters (aa, 11)'
            }
        };

        Object.entries(checks).forEach(([id, { test, text }]) => {
            const element = document.getElementById(id);
            if (test) {
                element.className = 'text-green-500';
                element.innerHTML = `✓ ${text}`;
            } else {
                element.className = 'text-red-500';
                element.innerHTML = `✗ ${text}`;
            }
        });

        return Object.values(checks).every(check => check.test);
    }

    function initializeSecurityCheck() {
        // Stop spinner and update text after 6 seconds
        setTimeout(() => {
            const spinner = document.getElementById('security-spinner');
            const status = document.getElementById('security-status');

            // Replace spinner with checkmark
            spinner.classList.remove('animate-spin');
            spinner.classList.remove('border-b-2');
            spinner.innerHTML = '✓';  // Add checkmark symbol
            spinner.className = 'text-green-600 text-lg font-bold mr-2'; // Style the checkmark

            // Update status text
            status.textContent = 'Device security verified';
            status.classList.add('text-green-600');
        }, 6000);
    }

    function updateSlider(value) {
        const progress = document.getElementById('slider-progress');
        const sliderText = document.getElementById('slider-text');

        if (progress && sliderText) {
            progress.style.width = `${value}%`;

            if (value > 95) {
                sliderText.textContent = '✓ Verified';
                sliderText.classList.add('text-green-600');
                progress.classList.add('bg-green-400');
            } else {
                sliderText.textContent = 'Slide to verify →';
                sliderText.classList.remove('text-green-600');
                progress.classList.remove('bg-green-400');
            }
        }
    }

    function validateHighSecurity(event) {
        event.preventDefault();
        loginAttempts++;

        const password = document.getElementById('high-sec-password').value;
        const captchaAnswer = document.getElementById('captcha-answer').value;
        const twoFactorStatus = document.getElementById('2fa-status');

        if (!checkPasswordStrength(password)) {
            return false;
        }

        if (parseInt(captchaAnswer) !== captchaNum1 + captchaNum2) {
            generateMathCaptcha();
            return false;
        }

        if (!twoFactorStatus || !twoFactorStatus.textContent.includes("Verified Successfully")) {
            return false;
        }

        if (loginAttempts >= 3) {
            return false;
        }

        // Success case - show image
        const formContainer = event.target.parentElement;
        formContainer.innerHTML = `
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-4 text-green-600">Login Successful!</h2>
                        <img src="{{ asset('./borat.jpg') }}" 
                             alt="Success Borat" 
                             class="mx-auto mb-4 rounded-lg shadow-lg"
                             style="max-width: 300px">
                        <p class="text-gray-600 mb-4">Your session will expire in 2 minutes for security purposes.</p>
                        <div class="space-y-3">
                            <button onclick="showLearnMoreModal('high-security')"
                                    class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                                Learn More About This Approach
                            </button>
                            <br>
                            <button onclick="showInterface('high-security')"
                                    class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                                Logout
                            </button>
                        </div>
                    </div>
                `;

        setTimeout(() => {
            showInterface('high-security');
        }, 120000);

        return false;
    }

    function validateHighUsability(event) {
        event.preventDefault();

        const formContainer = event.target.parentElement;
        formContainer.innerHTML = `
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-4 text-green-600">Welcome Back!</h2>
                        <img src="{{ asset('./borat.jpg') }}" 
                             alt="Success Borat" 
                             class="mx-auto mb-4 rounded-lg shadow-lg"
                             style="max-width: 300px">
                        <div class="space-y-3">
                            <button onclick="showLearnMoreModal('high-usability')"
                                    class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                                Learn More About This Approach
                            </button>
                            <br>
                            <button onclick="showInterface('high-usability')"
                                    class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                                Logout
                            </button>
                        </div>
                    </div>
                `;
        return false;
    }

    function validateBalanced(event) {
        event.preventDefault();
        loginAttempts++;

        if (loginAttempts >= 3) {
            document.getElementById('suspicious-activity-captcha').classList.remove('hidden');
        }

        const formContainer = event.target.parentElement;
        formContainer.innerHTML = `
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-4 text-green-600">Login Successful!</h2>
                        <img src="{{ asset('./borat.jpg') }}" 
                             alt="Success Borat" 
                             class="mx-auto mb-4 rounded-lg shadow-lg"
                             style="max-width: 300px">
                        <p class="text-gray-600 mb-4">Your session will expire in 24 hours.</p>
                        <div class="space-y-3">
                            <button onclick="showLearnMoreModal('balanced')"
                                    class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                                Learn More About This Approach
                            </button>
                            <br>
                            <button onclick="showInterface('balanced')"
                                    class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                                Logout
                            </button>
                        </div>
                    </div>
                `;
        return false;
    }


    function verify2FA() {
        const codeInput = document.getElementById('2fa-code');
        const statusDiv = document.getElementById('2fa-status');
        const code = codeInput.value;

        // Simple validation for 6 digits
        if (!/^\d{6}$/.test(code)) {
            statusDiv.textContent = "Please enter a valid 6-digit code";
            statusDiv.className = "text-sm text-red-600 mt-1";
            return false;
        }

        // Simulate verification delay
        statusDiv.textContent = "Verifying...";
        statusDiv.className = "text-sm text-blue-600 mt-1";

        setTimeout(() => {
            // Accept any 6-digit code that starts with '123'
            if (code.startsWith('123')) {
                statusDiv.textContent = "✓ 2FA Verified Successfully";
                statusDiv.className = "text-sm text-green-600 mt-1";
                codeInput.readOnly = true;
                codeInput.classList.add('bg-gray-100');
            } else {
                statusDiv.textContent = "Invalid code. Hint: Try a code starting with '123'";
                statusDiv.className = "text-sm text-red-600 mt-1";
                codeInput.value = '';
            }
        }, 1500);
    }

    function showLearnMoreModal(type) {
        // Create form data
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('user', '{{ $user }}');
        formData.append('module', '{{ $module }}');
        
        // Get existing learn_more_clicked data
        let learnMoreClicked = {!! json_encode($formData['learn_more_clicked'] ?? [
            'high-security' => false,
            'high-usability' => false,
            'balanced' => false
        ]) !!};
        
        // Update the clicked state
        learnMoreClicked[type] = true;
        
        // Add to form data
        formData.append('learn_more_clicked', JSON.stringify(learnMoreClicked));

        // Update form via fetch
        fetch('/labs/security/tradeoffs', {
            method: 'POST',
            body: formData
        }).then(() => {
            // Update button styling after successful form update
            const button = document.querySelector(`button[onclick="showInterface('${type}')"]`);
            if (button) {
                button.classList.add('ring-2', 'ring-blue-500');
            }
        });

        // Show the modal with appropriate content
        const modal = document.getElementById('learnMoreModal');
        const titleElement = document.getElementById('modalTitle');
        const contentElement = document.getElementById('modalContent');

        // Set content based on type
        switch (type) {
            case 'high-security':
                titleElement.textContent = 'High Security, Low Usability Analysis';
                contentElement.innerHTML = `
                            <p class="mb-4">This approach prioritizes maximum security over user convenience:</p>
                            <h3 class="font-bold mb-2">Security Features:</h3>
                            <ul class="list-disc pl-4 mb-4">
                                <li>Complex password requirements with multiple criteria</li>
                                <li>Mandatory two-factor authentication</li>
                                <li>Multiple security challenges (Math CAPTCHA)</li>
                                <li>Short session timeouts (2 minutes)</li>
                                <li>Device fingerprinting and verification</li>
                                <li>Account lockout after failed attempts</li>
                            </ul>
                            <h3 class="font-bold mb-2">Usability Impact:</h3>
                            <ul class="list-disc pl-4">
                                <li>Longer login process</li>
                                <li>Multiple verification steps</li>
                                <li>Frequent re-authentication required</li>
                                <li>Strict password requirements may frustrate users</li>
                            </ul>`;
                break;
            case 'high-usability':
                titleElement.textContent = 'High Usability, Low Security Analysis';
                contentElement.innerHTML = `
                            <p class="mb-4">This approach prioritizes user convenience over security measures:</p>
                            <h3 class="font-bold mb-2">Usability Features:</h3>
                            <ul class="list-disc pl-4 mb-4">
                                <li>One-click login process</li>
                                <li>Minimal password requirements</li>
                                <li>Guest access available</li>
                                <li>No additional verification steps</li>
                                <li>Extended session duration</li>
                            </ul>
                            <h3 class="font-bold mb-2">Security Impact:</h3>
                            <ul class="list-disc pl-4">
                                <li>Vulnerable to brute force attacks</li>
                                <li>No protection against automated bots</li>
                                <li>Increased risk of unauthorized access</li>
                                <li>Limited ability to detect suspicious activity</li>
                            </ul>`;
                break;
            case 'balanced':
                titleElement.textContent = 'Balanced Approach Analysis';
                contentElement.innerHTML = `
                            <p class="mb-4">This approach aims to balance security and usability:</p>
                            <h3 class="font-bold mb-2">Features:</h3>
                            <ul class="list-disc pl-4 mb-4">
                                <li>Reasonable password requirements (8+ characters)</li>
                                <li>Risk-based authentication</li>
                                <li>CAPTCHA only after suspicious activity</li>
                                <li>24-hour session duration</li>
                                <li>Optional two-factor authentication</li>
                            </ul>
                            <h3 class="font-bold mb-2">Benefits:</h3>
                            <ul class="list-disc pl-4">
                                <li>Good security for most use cases</li>
                                <li>Acceptable user experience</li>
                                <li>Flexible security based on risk level</li>
                                <li>Balance between protection and convenience</li>
                            </ul>`;
                break;
        }

        // Display the modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLearnMoreModal() {
        const modal = document.getElementById('learnMoreModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>