<style>
    .chevron {
        clip-path: polygon(85% 0%, 100% 50%, 85% 100%, 0% 100%, 15% 50%, 0% 0%);
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        opacity: 0;
        transform: translateX(-20px);
        width: 200px;
        height: 60px;
    }

    .chevron:first-child {
        clip-path: polygon(85% 0%, 100% 50%, 85% 100%, 0% 100%, 15% 50%, 0% 0%);
    }

    .chevron.active {
        opacity: 1;
        transform: translateX(0);
    }

    .pipeline-arrow {
        height: 2px;
        background-color: black;
        position: relative;
        transition: all 0.5s ease-out;
        transform-origin: left;
    }

    .pipeline-arrow::after {
        content: '';
        position: absolute;
        right: -10px;
        top: -4px;
        width: 0;
        height: 0;
        border-left: 10px solid black;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
    }

    @keyframes wiggle {

        0%,
        100% {
            transform: rotate(0deg) scale(1.05);
        }

        25% {
            transform: rotate(-3deg) scale(1.05);
        }

        75% {
            transform: rotate(3deg) scale(1.05);
        }
    }

    .nextHighlighted {
        animation: wiggle 1s ease-in-out infinite;
    }
</style>
<div class="container mx-auto px-4 py-8 max-w-full">
    <h1 class="text-3xl font-bold mb-6 ">CI/CD Module</h1>

    <h2 class="text-2xl font-bold mb-0">Introduction/ High-Level Pipeline</h2>
    <p>Click on the chevron to get information for that CI/CD step and progress to the next step.</p><br>

    <div class="bg-white p-6 rounded-lg shadow mb-2 px-10 py-20">
        <!-- Begin Button -->
        <div id="beginContainer" class="flex justify-center mb-12">
            <button id="beginButton"
                class="bg-blue-500 text-white px-10 py-6 rounded-lg font-bold text-3xl
                      hover:bg-blue-600 transform hover:scale-105 transition-all 
                      shadow-lg hover:shadow-xl"
                type="button">
                Begin
            </button>
        </div>
        <div id="pipelineContainer" class="relative w-full max-w-3xl mx-auto opacity-0 transition-all duration-500">
            <!-- CI Arrow -->
            <div class="absolute top-[-20px] left-0 w-full">
                <span class="text-sm font-bold absolute top-[-20px] left-0">CI</span>
                <div id="ciArrow" class="pipeline-arrow" style="width: 0px;"></div>
            </div>

            <!-- CD Arrow -->
            <div class="absolute bottom-[-20px] left-0 w-full">
                <div id="cdArrow" class="pipeline-arrow" style="width: 0px;"></div>
                <span class="text-sm font-bold absolute bottom-[-20px] left-0">CD</span>
            </div>

            <!-- Pipeline Steps -->
            <div class="flex justify-start items-center -space-x-0">
                <!-- Source - Initially Hidden -->
                <div id="step1" class="transform hover:scale-105 transition-all 
                      shadow-lg hover:shadow-xl chevron opacity-0 cursor-pointer bg-[#4285f4] flex items-center justify-center">
                    <span class="text-white font-bold">Source</span>
                </div>

                <!-- Other steps remain the same -->
                <div id="step2" class="transform hover:scale-105 transition-all 
                      shadow-lg hover:shadow-xl chevron cursor-pointer bg-[#ff9900] flex items-center justify-center">
                    <span class="text-white font-bold">Build</span>
                </div>

                <div id="step3" class="transform hover:scale-105 transition-all 
                      shadow-lg hover:shadow-xl chevron cursor-pointer bg-[#a142f4] flex items-center justify-center">
                    <span class="text-white font-bold">Test</span>
                </div>
                <div id="step4"
                    class="transform hover:scale-105 transition-all shadow-lg hover:shadow-xl chevron cursor-pointer bg-[#f44236] flex items-center justify-center"
                    onclick="document.getElementById('intro-complete').value ='true';"
                    onchange="updateForm(this.form)">
                    <span class="text-white font-bold">Deploy</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Info Box - Initially Hidden -->
    <div id="infoBox" class="bg-white border-2 border-gray-200 rounded-lg p-6 min-h-[200px] 
                           transition-all duration-300 mt-2 opacity-0" hidden>
    </div>

    <script>
        const steps = {
            step1: {
                title: "Source",
                content: `
            <div class="space-y-4 bg-blue-50 p-4 rounded-lg">
                <h3 id="h2-step1" class="text-3xl font-bold mb-4">Source</h3>
                <p class="text-gray-700 leading-relaxed">
                    This stage involves managing your code using version control systems like Git or Subversion.
                </p>
                
                    <h3 class="font-semibold text-blue-800 mb-2 text-2xl">Key Activities:</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Developers pushing code changes to repositories like GitHub, GitLab, or Bitbucket
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Creating feature branches for isolated development
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Using pull/merge requests for code review
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Implementing branch protection rules
                        </li>
                    </ul>
            </div>
        `,
                nextStep: "step2",
                ciWidth: "25%",
                cdWidth: "25%"
            },
            step2: {
                title: "Build Process",
                content: `
            <div class="space-y-4 bg-orange-50 p-4 rounded-lg">
                <h3 id="h2-step2" class="text-3xl font-bold mb-4">Build</h3>
                <p class="text-gray-700 leading-relaxed">
                    The build stage compiles code, installs dependencies, and creates deployable artifacts.
                </p>
            
                    <h3 class="font-semibold text-orange-800 mb-2 text-2xl">Common Steps:</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <span class="text-orange-500 mr-2">•</span>
                            Installing project dependencies (npm install, pip install, etc.)
                        </li>
                        <li class="flex items-start">
                            <span class="text-orange-500 mr-2">•</span>
                            Compiling source code into executables or bundles
                        </li>
                        <li class="flex items-start">
                            <span class="text-orange-500 mr-2">•</span>
                            Creating container images (Docker builds)
                        </li>
                        <li class="flex items-start">
                            <span class="text-orange-500 mr-2">•</span>
                            Managing build artifacts and caching
                        </li>
                    </ul>
            </div>
        `,
                nextStep: "step3",
                ciWidth: "50%",
                cdWidth: "50%"
            },
            step3: {
                title: "Testing Phase",
                content: `
            <div class="space-y-4 bg-purple-50 p-4 rounded-lg">
            <h3 id="h2-step3" class="text-3xl font-bold mb-4">Testing</h3>
                <p class="text-gray-700 leading-relaxed">
                    Testing involves multiple layers of automated testing to ensure code quality.
                </p>
                
                    <h3 class="font-semibold text-purple-800 mb-2 text-2xl">Testing Layers:</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <span class="text-purple-500 mr-2">•</span>
                            Unit tests to verify individual components
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-500 mr-2">•</span>
                            Integration tests to check component interactions
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-500 mr-2">•</span>
                            End-to-end tests simulating user behavior
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-500 mr-2">•</span>
                            Security scanning (SAST/DAST)
                        </li>
                    </ul>
            </div>
        `,
                nextStep: "step4",
                ciWidth: "75%",
                cdWidth: "75%"
            },
            step4: {
                title: "Deployment",
                content: `

            <div class="space-y-4 bg-red-50 p-4 rounded-lg">
                <h3 id="h2-step4" class="text-3xl font-bold mb-4 text-2xl">Deployment</h3>
                <p class="text-gray-700 leading-relaxed">
                    The deployment stage automates application delivery to various environments.
                </p>
                    <h3 class="font-semibold text-red-800 mb-2 text-2xl">Key Features:</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <span class="text-red-500 mr-2">•</span>
                            Using infrastructure as code (Terraform, CloudFormation)
                        </li>
                        <li class="flex items-start">
                            <span class="text-red-500 mr-2">•</span>
                            Implementing deployment strategies (blue-green, canary)
                        </li>
                        <li class="flex items-start">
                            <span class="text-red-500 mr-2">•</span>
                            Health checks and smoke tests post-deployment
                        </li>
                        <li class="flex items-start">
                            <span class="text-red-500 mr-2">•</span>
                            Automated rollback procedures if issues occur
                        </li>
                    </ul>
            </div>
        `,
                nextStep: null,
                ciWidth: "75%",
                cdWidth: "100%"
            }
        };
        let maxActivatedStep = -1; // Start at 0 instead of 1
        let currentStep = 0;
        let pipelineStarted = false;

        // Begin Button Handler
        document.getElementById('beginButton').addEventListener('click', function() {
            if (pipelineStarted) return;

            pipelineStarted = true;

            // Fade out begin button
            this.parentElement.style.display = 'none'
            document.getElementById("infoBox").hidden = false;
            // Show pipeline container
            const pipelineContainer = document.getElementById('pipelineContainer');
            pipelineContainer.classList.remove('opacity-0');

            // Show info box
            const infoBox = document.getElementById('infoBox');
            infoBox.classList.remove('opacity-0');

            // Animate in first step after a short delay
            setTimeout(() => {
                document.getElementById('ciArrow').style.width = '0%'
                document.getElementById('cdArrow').style.width = '0%'
                const firstStep = document.getElementById('step1');
                firstStep.classList.add('active', 'current', 'nextHighlighted');
                firstStep.classList.remove('opacity-0');
                maxActivatedStep = 0;
                currentStep = 1;
            }, 500);
        });

        document.querySelectorAll('.chevron').forEach(step => {
            step.addEventListener('click', function() {
                if (!pipelineStarted) return;

                const stepId = this.id;
                const currentStepNumber = parseInt(stepId.replace('step', ''));

                // Only proceed if this is an activated step
                if (!this.classList.contains('active')) return;

                // Remove 'current' class from all steps
                document.querySelectorAll('.chevron').forEach(s => {
                    s.classList.remove('current', 'nextHighlighted');
                });

                // Add 'current' class to clicked step
                this.classList.add('current');


                // Update content
                const stepInfo = steps[stepId];
                const infoBox = document.getElementById('infoBox');
                if (!document.getElementById(`h2-${stepId}`)) {
                    infoBox.innerHTML += `<div id="stepContent" class="step-content bg-white border-2 border-gray-200 rounded-lg p-6 min-h-[200px] 
                            transition-all duration-300 mt-2 ">
                <p id="p-step{stepId}" class="text-gray-600">${stepInfo.content}</p></div><br>`
                }

                // Only handle animations if this is a new furthest step
                if (currentStepNumber > maxActivatedStep) {
                    maxActivatedStep = currentStepNumber;

                    // Update arrows
                    document.getElementById('ciArrow').style.width = stepInfo.ciWidth;
                    document.getElementById('cdArrow').style.width = stepInfo.cdWidth;

                    // Activate next step if available
                    if (stepInfo.nextStep) {
                        const nextStep = document.getElementById(stepInfo.nextStep);
                        nextStep.classList.add('active');
                        nextStep.classList.add('nextHighlighted')
                    } else {
                        document.getElementById("next-page").disabled = false;
                    }
                }

                currentStep = currentStepNumber;
            });
        });
    </script>
</div>
</div>
<br> <br>