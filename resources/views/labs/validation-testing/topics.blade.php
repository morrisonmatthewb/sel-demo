<h1 class="text-3xl font-bold text-center mb-6">Introduction to Validation Testing</h1>
@php
    use Illuminate\Support\Facades\Blade;
    $unit_test_code = resource_path("/codesnippets/validation-testing/unit-test");
    $unit_test_content = '
                        <h2 class="text-2xl font-bold mb-4">Unit Tests</h2>
                        <div class="prose max-w-none">
                            <p class="mb-4">Unit tests are designed to test individual components or functions of a software application in isolation. 
                                            They are critical for ensuring that each part of the application behaves as expected.</p>
                            
                            <h3 class="text-xl font-semibold mb-3">Benefits of Unit Testing</h3>
                            <ul class="list-disc pl-6 mb-4">
                                <li>Early Bug Detection: Identify issues during development, which is cheaper to fix.</li>
                                <li>Facilitates Code Refactoring: Confidence to change code without breaking existing functionality.</li>
                                <li>Documentation: Acts as documentation for how functions are expected to work.</li>
                                <li>Enhances Design: Encourages better software design and modularity.</li>
                            </ul>

                            <h3 class="text-xl font-semibold mb-3">Key Characteristics</h3>
                            <ul class="list-disc pl-6 mb-4">
                                <li>Unit tests should execute quickly to encourage frequent running during development.</li>
                                <li>Each unit test should test a single “unit” of functionality in isolation.</li>
                                <li>Unit tests should be able to run automatically and repeatedly.</li>
                                <li>Tests should be straightforward and focus on a single behavior.</li>
                                
                            </ul>

                            <h3 class="text-xl font-semibold mb-3">Writing Unit Tests</h3>
                            <p class="mb-4">Unit tests should be automated, easy to run, and provide immediate feedback. 
                                            A typical structure includes:</p>
                            <ul class="list-disc pl-6 mb-4">
                                <li><strong>Setup:</strong> Prepare the necessary environment and inputs.</li>
                                <li><strong>Execution:</strong> Call the method or function being tested.</li>
                                <li><strong>Assertion:</strong> Verify that the output matches the expected result.</li>
                                <li><strong>Teardown:</strong> Clean up resources if necessary.</li>
                            </ul>

                            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold mb-2">Calculator App Example</h3>
                                <p>Performing unit test on the calculator app to verify that a function works correctly.</p>
                                <p>One example is testing the addition function with various numbers to ensure it 
                                returns the correct result.</p>
                                <p>Does 3 + 2 return 5?</p>

                                <br>

                                <h3 class="text-lg font-semibold mb-2">Setting Up a Unit Test</h3>
                                <ol class="list-decimal pl-6 mb-4">
                                    <li><strong>Identify the Functionality:</strong> Determine which individual 
                                        component or function you want to test. For example, in the Calculator App, 
                                        you might want to test the addition function.</li>
                                    <li><strong>Create a Test Case:</strong> Write a test case that specifies 
                                        the expected input and output for the function. Use a testing framework 
                                        like <code>unittest</code> in Python or <code>JUnit</code> in Java to 
                                        structure your test.</li>
                                    <li><strong>Write the Test Code:</strong> Implement the test code using assertions 
                                        to check if the actual output matches the expected output.</li>
                                    <li><strong>Run the Test:</strong> Execute the test to verify that the function 
                                        behaves as expected. If the test passes, it indicates that the function works correctly.</li>
                                    <li><strong>Refactor as Needed:</strong> If the test fails, analyze the code 
                                        and make necessary changes to fix any issues. Rerun the test to confirm 
                                        the problem has been resolved.</li>
                                </ol>
                                
                                <br>

                                <h3 class="text-lg font-semibold mb-2">Example Python Code</h3>
                                @include("components.code", ["language" => "python", "codepath" => $unit_test_code])
                            </div>

                            <h3 class="text-xl font-semibold mb-3">Common Pitfalls</h3>
                            <ul class="list-disc pl-6 mb-4">
                                <li>Testing implementation instead of behavior</li>
                                <li>Ignoring edge cases</li>
                                <li>Neglecting to update tests when code changes</li>
                            </ul>

                            <p>Unit testing is an essential practice in software engineering that 
                            contributes to software quality, maintainability, and developer productivity.
                            Incorporating unit tests into your development workflow from the start 
                            will help you become a more effective software engineer.</p>
                        </div>
                        ';
                        

    $unit_test_content = Blade::render($unit_test_content, compact('unit_test_code'));
    $system_test_code = resource_path("/codesnippets/validation-testing/system-test");
    $system_test_content = '
                            <h2 class="text-2xl font-bold mb-4">System Tests</h2>
                            <div class="prose max-w-none">
                                <p class="mb-4">System tests evaluate the complete and integrated software application to ensure 
                                                it meets the specified requirements. These tests focus on the overall functionality 
                                                of the application and verify that all components work together as intended.</p>
                                
                                <h3 class="text-xl font-semibold mb-3">Benefits of System Testing</h3>
                                <ul class="list-disc pl-6 mb-4">
                                    <li>Comprehensive Validation: Tests the entire application as a whole, ensuring all components work together as intended.</li>
                                    <li>Requirement Verification: Validates that the system meets both functional and non-functional requirements.</li>
                                    <li>End-User Perspective: Provides insight into how the application will behave in production from an end-user\’s viewpoint.</li>
                                    <li>Identifies Integration Issues: Detects problems that may arise from the interaction between different components.</li>
                                </ul>

                                <h3 class="text-xl font-semibold mb-3">Key Characteristics</h3>
                                <ul class="list-disc pl-6 mb-4">
                                    <li>Tests the complete system as a whole</li>
                                    <li>Focuses on functional and non-functional requirements</li>
                                    <li>Conducted in an environment that simulates real-world scenarios and user behaviors</li>
                                    <li>Can include automated and manual testing approaches</li>
                                </ul>

                                <h3 class="text-xl font-semibold mb-3">Writing System Tests</h3>
                                <p class="mb-4">System tests should be planned to cover various scenarios, including:</p>
                                <ul class="list-disc pl-6 mb-4">
                                    <li><strong>Functional Tests:</strong> Validate that the system performs its intended functions.</li>
                                    <li><strong>Performance Tests:</strong> Assess how the system behaves under load.</li>
                                    <li><strong>Security Tests:</strong> Evaluate the system\'s defenses against potential threats.</li>
                                </ul>

                                <div class="bg-gray-100 p-4 rounded-lg mb-6">
                                    <h3 class="text-lg font-semibold mb-2">Calculator App Example</h3>
                                    <p>Performing system tests on the calculator app to verify that all functions 
                                    work correctly in an integrated environment.</p>
                                    <p>Examples of tests might include:</p>
                                    <ul class="list-disc pl-6 mb-4">
                                        <li>Can the calculator handle multiple operations in a single expression, like <strong>2 + 3 * 4</strong>?</li>
                                        <li>Does the calculator correctly maintain state between operations?</li>
                                        <li>Is the UI responsive when performing calculations with large numbers or complex expressions?</li>
                                    </ul>

                                    <h3 class="text-lg font-semibold mb-2">Setting Up a System Test</h3>
                                    <ol class="list-decimal pl-6 mb-4">
                                        <li><strong>Define the Test Environment:</strong> Set up an environment that mirrors 
                                            the production environment as closely as possible. This includes the operating 
                                            system, database, and any required services.</li>
                                        <li><strong>Identify Test Scenarios:</strong> Determine which end-to-end scenarios 
                                            you want to test. For the Calculator App, you might test how the application 
                                            behaves when performing a sequence of operations like addition followed by multiplication.</li>
                                        <li><strong>Create Test Cases:</strong> Write detailed test cases that describe 
                                            the inputs, execution steps, and expected outcomes for each scenario.</li>
                                        <li><strong>Gather Test Data:</strong> Prepare any necessary test data needed for 
                                            your scenarios, such as valid and invalid input sets.</li>
                                        <li><strong>Execute the Tests:</strong> Run the system tests and observe the 
                                            application\'s behavior. Document any discrepancies between expected and 
                                            actual outcomes.</li>
                                        <li><strong>Review and Report Results:</strong> Analyze the test results to 
                                            identify any issues or failures. Provide feedback to the development team 
                                            for resolution.</li>
                                    </ol>

                                    <br>

                                    <h3 class="text-lg font-semibold mb-2">Example Python Code</h3>
                                    @include("components.code", ["language" => "python", "codepath" => $system_test_code])
                                </div>

                                <h3 class="text-xl font-semibold mb-3">Common Pitfalls</h3>
                                <ul class="list-disc pl-6 mb-4">
                                    <li>Not replicating production environments accurately.</li>
                                    <li>Not covering edge cases or unusual scenarios</li>
                                    <li>Not testing the interaction of multiple components.</li>
                                    <li>Neglecting performance and security aspects</li>
                                </ul>

                                <p>System testing is a vital phase in the software development lifecycle. 
                                By validating the complete system, engineers can ensure that the software 
                                meets user expectations and performs reliably in real-world conditions. 
                                Effective system testing leads to higher quality software and improved user satisfaction.</p>
                            </div>
                        ';
    $system_test_content = Blade::render($system_test_content, compact('system_test_code'));

    $topics = [
        "unit_tests" => [
            "title" => "Unit Tests",
            "content" => $unit_test_content
                        ],
        "system_tests" => [
            "title" => "System Tests",
            "content" => $system_test_content
                        ],
        "acceptance-tests" => [
        "title" => "Acceptance Tests",
        "content" => '
                        <h2 class="text-2xl font-bold mb-4">Acceptance Tests</h2>
                        <div class="prose max-w-none">
                            <p class="mb-4">Acceptance tests are conducted to determine whether the software 
                                            meets the acceptance criteria set forth by stakeholders. These tests are 
                                            usually performed at the end of the development process to ensure that the 
                                            software is ready for deployment and satisfies user requirements.</p>
                            
                            <h3 class="text-xl font-semibold mb-3">Benefits of Acceptance Testing:</h3>
                            <ul class="list-disc pl-6 mb-4">
                                <li>User Satisfaction: Confirms that the software meets user expectations before it goes live.</li>
                                <li>Risk Mitigation: Identifies issues early, reducing the risk of failure in production.</li>
                                <li>Stakeholder Confidence: Provides assurance to stakeholders that the product is ready for release.</li>
                            </ul>

                            <h3 class="text-xl font-semibold mb-3">Key Characteristics</h3>
                            <ul class="list-disc pl-6 mb-4">
                                <li>Performed by end-users or stakeholders</li>
                                <li>Focuses on high-level functionality and user requirements</li>
                                <li>Can be manual or automated</li>
                                <li>Confirms compliance with specified acceptance criteria</li>
                            </ul>

                            <h3 class="text-xl font-semibold mb-3">Types of Acceptance Tests</h3>
                            <ul class="list-disc pl-6 mb-4">
                                <li><strong>User Acceptance Testing (UAT):</strong> Conducted by end-users to 
                                    validate that the software meets their needs.</li>
                                <li><strong>Operational Acceptance Testing:</strong> Ensures the system is 
                                    operationally ready for use, including backup, recovery, and maintenance tasks.</li>
                                <li><strong>Contract Acceptance Testing:</strong> Verifies that the software 
                                    meets contractual requirements as specified in a contract.</li>
                            </ul>

                            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold mb-2">Calculator App Example</h3>
                                <p>Performing acceptance tests on the calculator app to verify it meets user 
                                    expectations and requirements.</p>
                                <p>Examples of acceptance tests might include:</p>
                                <ul class="list-disc pl-6 mb-4">
                                    <li>Can the user perform a series of calculations and get expected results?</li>
                                    <li>Is the user interface intuitive and easy to navigate for performing calculations?</li>
                                    <li>Does the application handle invalid inputs gracefully, providing appropriate error messages?</li>
                                </ul>

                                <br>

                                <h3 class="text-lg font-semibold mb-2">Setting Up an Acceptance Test</h3>
                                <ol class="list-decimal pl-6 mb-4">
                                    <li><strong>Identify Stakeholders:</strong> Gather input from end-users, clients, 
                                        and other stakeholders to define the acceptance criteria clearly.</li>
                                    <li><strong>Define Acceptance Criteria:</strong> Create specific, measurable criteria 
                                        that the software must meet to be considered acceptable. This may include 
                                        functionality, usability, and performance requirements.</li>
                                    <li><strong>Recruit Testers:</strong> Find appropriate testers, such as:
                                        <ul class="list-disc pl-6 mb-2">
                                            <li>Current users who can provide real-world insights.</li>
                                            <li>New users for fresh perspectives on usability.</li>
                                            <li>Stakeholders with a vested interest in the application\'s success.</li>
                                        </ul>
                                    </li>
                                    <li><strong>Prepare Testing Environment:</strong> Set up a dedicated testing environment 
                                        that mirrors the production environment as closely as possible.</li>
                                    <li><strong>Conduct Testing Sessions:</strong> Facilitate sessions where testers 
                                        can use the application to complete tasks based on real-world scenarios.</li>
                                    <li><strong>Collect Feedback:</strong> Gather feedback from testers during and after 
                                        the sessions to understand their experiences and concerns.</li>
                                    <li><strong>Analyze Results:</strong> Review the feedback and determine if 
                                        the software meets the acceptance criteria. Identify any issues that need to be 
                                        addressed before the final release.</li>
                                </ol>
                            </div>

                            <h3 class="text-xl font-semibold mb-3">Common Pitfalls</h3>
                            <ul class="list-disc pl-6 mb-4">
                                <li>Ambiguous acceptance criteria that lead to misunderstandings and incomplete tests.</li>
                                <li>Insufficient involvement from key stakeholders, resulting in missed expectations.</li>
                                <li>Failing to adequately prepare the testing environment, which can yield inaccurate results.</li>
                                <li>Not allowing enough time for thorough testing and feedback collection, 
                                    leading to rushed conclusions.</li>
                            </ul>

                            <p>Acceptance testing is a critical phase in the software development lifecycle that 
                            focuses on confirming the software meets the needs of end-users and stakeholders. 
                            Conducting thorough acceptance tests helps ensure user satisfaction, mitigates risks, 
                            and boosts stakeholder confidence in the final product.</p>
                        </div>
                    '
                    ],
    "certification-tests" => [
        "title" => "Certification Tests",
        "content" => '
                    <h2 class="text-2xl font-bold mb-4">Certification Tests</h2>
                    <div class="prose max-w-none">
                        <p class="mb-4">Certification tests are formal evaluations that assess whether 
                                        a software product complies with specific standards or regulations. 
                                        These tests are essential in industries where safety, reliability, 
                                        and performance are critical, ensuring that the software adheres to 
                                        regulatory requirements.</p>
                        
                        <h3 class="text-xl font-semibold mb-3">Benefits of Certification Testing</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Compliance Assurance: Verifies that the software meets industry standards and regulations.</li>
                            <li>Enhanced Credibility: Certification can improve the software’s reputation and marketability.</li>
                            <li>Risk Mitigation: Helps identify and address potential issues that could 
                                lead to failures or non-compliance.</li>
                        </ul>

                        <h3 class="text-xl font-semibold mb-3">Key Characteristics</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Focus on regulatory requirements</li>
                            <li>May involve third-party evaluations</li>
                            <li>Comprehensive testing against standards</li>
                            <li>Documentation of compliance results</li>
                        </ul>

                        <h3 class="text-xl font-semibold mb-3">Types of Certification Tests</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Functional Certification:</strong> Ensures the software meets 
                                functional requirements as specified by standards.</li>
                            <li><strong>Performance Certification:</strong> Assesses whether the software 
                                meets performance benchmarks.</li>
                            <li><strong>Security Certification:</strong> Evaluates the software\'s security 
                                features against security standards.</li>
                        </ul>

                        <div class="bg-gray-100 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-semibold mb-2">Calculator App Example</h3>
                            <p>Conducting certification tests on the calculator app to verify compliance with 
                                standards, such as the <a href="https://en.wikipedia.org/wiki/IEEE_754" 
                                                        class="text-blue-500 underline hover:text-blue-700">
                                                        IEEE 754 Standard
                                                    </a> for floating-point arithmetic.</p>
                            <p>One of the questions we will evaluate is: <strong>Does 0/0 return NaN instead 
                                of an error?</strong></p>
                            
                            <br>

                            <h3 class="text-lg font-semibold mb-2">Setting Up a Certification Test</h3>
                            <ol class="list-decimal pl-6 mb-4">
                                <li><strong>Identify Relevant Standards:</strong> Determine which industry standards or 
                                    regulations apply to the software. For the calculator app, this may involve the IEEE 754 
                                    Standard.</li>
                                <li><strong>Define Certification Criteria:</strong> Specify the criteria that must
                                    be met for compliance with the identified standards.</li>
                                <li><strong>Prepare Test Cases:</strong> Develop test cases that address the 
                                    certification criteria. For example, a test case for the division operation 
                                    should check how the application handles the input 0/0.</li>
                                <li><strong>Execute Tests:</strong> Run the certification tests in a controlled 
                                    environment, simulating various scenarios that the software may encounter.</li>
                                <li><strong>Document Results:</strong> Keep detailed records of test results, 
                                    including any failures or compliance issues, to provide evidence for certification.</li>
                                <li><strong>Review and Validate:</strong> Review the results with stakeholders 
                                    to ensure all compliance requirements have been met before moving forward 
                                    with certification.</li>
                            </ol>
                        </div>

                        <h3 class="text-xl font-semibold mb-3">Common Pitfalls</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Inadequate understanding of applicable standards, leading to incomplete testing.</li>
                            <li>Insufficient documentation of test cases and results, which can complicate 
                                the certification process.</li>
                            <li>Failure to engage with third-party certifiers early in the process, resulting in delays.</li>
                            <li>Neglecting to update tests to align with changes in standards or regulations.</li>
                        </ul>

                        <p>Certification testing is crucial for ensuring software compliance with industry 
                        standards. For a calculator app, verifying compliance with standards like IEEE 754 
                        not only assures functionality but also enhances the application\'s reliability and 
                        acceptance in the market.</p>
                    </div>
                    '
                    ],
        "regression-tests" => [
        "title" => "Regression Tests",
        "content" => '
                    <h2 class="text-2xl font-bold mb-4">Regression Tests</h2>
                    <div class="prose max-w-none">
                        <p class="mb-4">Regression tests are essential in the software development lifecycle, 
                                        designed to ensure that previously developed and tested software still 
                                        performs correctly after changes have been made. These tests are critical 
                                        for identifying any unintended side effects of modifications, whether 
                                        due to new features, bug fixes, or enhancements.</p>
                        
                        <h3 class="text-xl font-semibold mb-3">Benefits of Regression Testing</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Ensures Stability: Verifies that existing functionality remains intact after changes.</li>
                            <li>Reduces Risk: Minimizes the risk of introducing new bugs into previously working code.</li>
                            <li>Supports Continuous Integration: Facilitates the adoption of agile practices 
                                by allowing frequent updates with confidence.</li>
                            <li>Enhances Software Quality: Contributes to overall software reliability and user satisfaction.</li>
                        </ul>

                        <h3 class="text-xl font-semibold mb-3">Key Characteristics</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Focused on verifying existing functionality</li>
                            <li>Often automated to ensure efficiency</li>
                            <li>Executed frequently, especially after changes</li>
                            <li>Can cover both functional and non-functional aspects</li>
                        </ul>

                        <h3 class="text-xl font-semibold mb-3">Types of Regression Tests</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li><strong>Unit Regression Tests:</strong> Focus on individual components and ensure 
                                they function correctly after changes.</li>
                            <li><strong>Partial Regression Tests:</strong> Validate specific areas impacted by 
                                the latest changes.</li>
                            <li><strong>Complete Regression Tests:</strong> Test the entire application to ensure 
                                all functionalities work as expected.</li>
                        </ul>

                        <div class="bg-gray-100 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-semibold mb-2">Calculator App Example</h3>
                            <p>In our Calculator App, let’s say we recently added a new feature for calculating 
                            square roots. After implementing this feature, we must run regression tests to 
                            ensure that existing functionalities, such as addition and subtraction, still work correctly.</p>
                            
                            <h3 class="text-lg font-semibold mb-2">Setting Up a Regression Test:</h3>
                            <ol class="list-decimal pl-6 mb-4">
                                <li><strong>Identify Impacted Areas:</strong> Determine which parts of 
                                    the application may be affected by the recent changes (e.g., addition, subtraction).</li>
                                <li><strong>Select Test Cases:</strong> Choose existing test cases that 
                                    cover the functionalities related to the impacted areas.</li>
                                <li><strong>Automate Tests:</strong> Implement automated tests if possible 
                                    to streamline the regression testing process.</li>
                                <li><strong>Execute Tests:</strong> Run the regression tests after each 
                                    update to check for any failures or discrepancies.</li>
                                <li><strong>Analyze Results:</strong> Review the test results to identify 
                                    any issues and address them promptly.</li>
                            </ol>
                        </div>

                        <h3 class="text-xl font-semibold mb-3">Common Pitfalls:</h3>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Neglecting to update regression tests when features change or new ones are added.</li>
                            <li>Overlooking areas that may not seem directly impacted by changes but still could be affected.</li>
                            <li>Relying solely on manual testing, which can lead to oversights and increased testing time.</li>
                            <li>Not executing regression tests frequently enough, increasing the risk of undetected issues.</li>
                        </ul>

                        <p>Regression testing is a crucial process in software development that helps 
                        ensure the continued functionality and stability of the application. For the 
                        Calculator App, performing thorough regression tests after any changes, like 
                        adding a new feature, is essential to maintaining a high-quality user experience.</p>
                    </div>
                    '
                    ]

    ];
@endphp

<!-- Validation Test Definition Box -->
<div class="p-4 bg-white border border-gray-300 rounded shadow-md mb-4">
    <h2 class="text-2xl font-semibold">What are Validation Tests?</h2>
    <p>Validation testing is a process that ensures a software product meets the needs of its users and quality standards.</p>
    <p>Designing and performing quality tests are <strong>important</strong> to delivering a successful product.</p>
    <p>We will go through the various types of validation tests and what we should test for by using the example of a calculator app.</p>
    <p>When you press a button, a description will appear. Go through and learn about the types of tests and focus areas.</p>
</div>

@include('templates.topics', [
    'topicHeader'       => 'Types of Tests',
    'placeholderText'   => 'Select a test to view its details',
    'topics'            => $topics
])