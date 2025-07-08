<h1 class="text-3xl font-bold text-center mb-6">Introduction to Security</h1>
@php
use Illuminate\Support\Facades\Blade;
$auth_1 = resource_path("/codesnippets/security/auth-1");
$auth_2 = resource_path("/codesnippets/security/auth-2");
$auth_3 = resource_path("/codesnippets/security/auth-3");
$auth_4 = resource_path("/codesnippets/security/auth-4");
$auth_5 = resource_path("/codesnippets/security/auth-5");
$xss_1 = resource_path("/codesnippets/security/xss-1");
$xss_2 = resource_path("/codesnippets/security/xss-2");
$xss_3 = resource_path("/codesnippets/security/xss-3");
$xss_4 = resource_path("/codesnippets/security/xss-4");
$xss_5 = resource_path("/codesnippets/security/xss-5");
$xss_6 = resource_path("/codesnippets/security/xss-6");
$xss_7 = resource_path("/codesnippets/security/xss-7");
$xss_8 = resource_path("/codesnippets/security/xss-8");
$sql_1 = resource_path("/codesnippets/security/sql-1");
$sql_2 = resource_path("/codesnippets/security/sql-2");
$sql_3 = resource_path("/codesnippets/security/sql-3");
$sql_4 = resource_path("/codesnippets/security/sql-4");
$sql_5 = resource_path("/codesnippets/security/sql-5");
$sql_6 = resource_path("/codesnippets/security/sql-6");
$idor_1 = resource_path("/codesnippets/security/idor-1");
$idor_2 = resource_path("/codesnippets/security/idor-2");
$idor_3 = resource_path("/codesnippets/security/idor-3");
$idor_4 = resource_path("/codesnippets/security/idor-4");
$idor_5 = resource_path("/codesnippets/security/idor-5");
$encryption_1 = resource_path("/codesnippets/security/encryption-1");
$encryption_2 = resource_path("/codesnippets/security/encryption-2");
$encryption_3 = resource_path("/codesnippets/security/encryption-3");
$encryption_4 = resource_path("/codesnippets/security/encryption-4");
$encryption_5 = resource_path("/codesnippets/security/encryption-5");
$csrf_1 = resource_path("/codesnippets/security/csrf-1");
$csrf_2 = resource_path("/codesnippets/security/csrf-2");
$csrf_3 = resource_path("/codesnippets/security/csrf-3");
$file_upload_1 = resource_path("/codesnippets/security/file-upload-1");
$file_upload_2 = resource_path("/codesnippets/security/file-upload-1");
$file_upload_3 = resource_path("/codesnippets/security/file-upload-3");

$auth_content = '
<h2 class="font-bold mb-4">Authentication vs Authorization</h2>
<p class="mb-4">Authentication verifies who you are, while authorization determines what you can do.</p>

<h3 class="font-semibold mb-2">Authentication</h3>
<p class="mb-2">Handles user identity verification through:</p>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>Username/password verification</li>
    <li>Multi-factor authentication (2FA)</li>
    <li>Session token management</li>
    <li>Biometric verification</li>
</ul>

<h3 class="font-semibold mb-2">Authorization</h3>
<p class="mb-2">Controls user access through:</p>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>User roles and permissions</li>
    <li>Access control lists</li>
    <li>Resource-level restrictions</li>
    <li>Action-based permissions</li>
</ul>

<h3 class="font-semibold mb-2">Vulnerable Authentication Example:</h3>
<p class="mb-2">This code has several security issues:</p>
@include("components.code", ["language" => "python", "codepath" => $auth_1])

<h3 class="font-semibold mb-2">Vulnerable Authorization Example:</h3>
<p class="mb-2">This code lacks proper access controls:</p>
@include("components.code", ["language" => "python", "codepath" => $auth_2])

<h3 class="font-semibold mb-2">Common Attack Scenarios:</h3>
<p class="mb-2">Attackers often exploit these vulnerabilities:</p>
@include("components.code", ["language" => "python", "codepath" => $auth_3])

<h3 class="font-semibold mt-6 mb-2">Secure Implementation:</h3>
<p class="mb-2">Proper authentication should include password hashing and session management:</p>
@include("components.code", ["language" => "python", "codepath" => $auth_4])

<p class="mb-2">Proper authorization should verify permissions before access:</p>
@include("components.code", ["language" => "python", "codepath" => $auth_5])

<p class="mt-2">Security best practices implemented:</p>
<ul class="list-disc pl-6 space-y-2">
    <li>Password hashing and verification</li>
    <li>Secure session token generation</li>
    <li>Permission checks before access</li>
    <li>Separation of authentication and authorization logic</li>
</ul>

';

$xss_content = '
<h2 class="font-bold mb-4">Cross-Site Scripting (XSS)</h2>
<p class="mb-4">Attackers inject malicious scripts into web pages viewed by other users.</p>

<h3 class="font-semibold mb-2">Protection Measures:</h3>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>Sanitize user input before storing or displaying</li>
    <li>Encode output when rendering user-provided content</li>
    <li>Implement Content Security Policy (CSP) headers</li>
    <li>Use modern framework\'s built-in XSS protection</li>
</ul>

<h3 class="font-semibold mb-2">Vulnerable Example:</h3>
<p class="mb-2">This code directly inserts user input into HTML without any sanitization:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_1])

<h3 class="font-semibold mb-2">Normal Usage:</h3>
<p class="mb-2">With regular input, the page works as intended:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_2])

<h3 class="font-semibold mb-2">Attack Examples:</h3>

<h4 class="font-medium mt-4 mb-2">1. Basic Alert Injection</h4>
<p class="mb-2">The simplest form of XSS, showing an alert popup:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_3])

<h4 class="font-medium mt-4 mb-2">2. Cookie Theft</h4>  
<p class="mb-2">Stealing user\'s session cookies by sending them to an attacker\'s server:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_4])


<h4 class="font-medium mt-4 mb-2">3. Page Defacement</h4>
<p class="mb-2">Modifying the page content and appearance:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_5])


<h4 class="font-medium mt-4 mb-2">4. Hidden Script Execution</h4>
<p class="mb-2">Using HTML attributes to execute JavaScript without script tags:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_6])

<h3 class="font-semibold mt-6 mb-2">Protected Implementation:</h3>
<p class="mb-2">Using HTML escaping to prevent script injection:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_7])

<p class="mb-2">When an attacker tries to inject a script, it gets escaped:</p>
@include("components.code", ["language" => "python", "codepath" => $xss_8])

<p class="mt-2">Security measures implemented:</p>
<ul class="list-disc pl-6 space-y-2">
    <li>HTML special characters are escaped</li>
    <li>Script tags are rendered as text, not HTML</li>
    <li>JavaScript cannot execute</li>
    <li>HTML structure remains intact</li>
</ul>
';

$sql_content = '
<h2 class="font-bold mb-4">SQL Injection</h2>
<p class="mb-4">Malicious SQL code is inserted into database queries to manipulate or extract data.</p>

<h3 class="font-semibold mb-2">Prevention Methods:</h3>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>Use parameterized queries or prepared statements</li>
    <li>Implement proper input validation</li>
    <li>Apply the principle of least privilege for database users</li>
    <li>Use ORMs (Object-Relational Mapping) when possible</li>
</ul>

<h3 class="font-semibold mb-2">Vulnerable Example:</h3>
<p class="mb-2">In this vulnerable code, user input is directly concatenated into the SQL query:</p>
@include("components.code", ["language" => "python", "codepath" => $sql_1])

<h3 class="font-semibold mb-2">Normal Usage:</h3>
<p class="mb-2">During normal login attempts, the query works as expected:</p>
@include("components.code", ["language" => "python", "codepath" => $sql_2])

<h3 class="font-semibold mb-2">Attack Examples:</h3>
<p class="mb-2">Attackers can manipulate the query in several ways:</p>

<h4 class="font-medium mt-4 mb-2">1. Login Bypass</h4>
<p class="mb-2">Using SQL comments to ignore the password check:</p>
@include("components.code", ["language" => "python", "codepath" => $sql_3])

<h4 class="font-medium mt-4 mb-2">2. Retrieving All Users</h4>
<p class="mb-2">Using OR condition to make the WHERE clause always true:</p>
@include("components.code", ["language" => "python", "codepath" => $sql_4])

<h4 class="font-medium mt-4 mb-2">3. Accessing Other Tables</h4>
<p class="mb-2">Using UNION to combine results from another table:</p>
@include("components.code", ["language" => "python", "codepath" => $sql_5])

<h3 class="font-semibold mt-6 mb-2">Protected Implementation:</h3>
<p class="mb-2">Using parameterized queries prevents SQL injection by separating code from data:</p>
@include("components.code", ["language" => "python", "codepath" => $sql_6])

<p class="mt-2">This approach is secure because:</p>
<ul class="list-disc pl-6 space-y-2">
    <li>The database treats inputs as data values, not code</li>
    <li>Special characters in the input can\'t change the query structure</li>
    <li>SQL commands in the input are treated as plain text</li>
</ul>
';

$idor_content = '
<h2 class="font-bold mb-4">Insecure Direct Object References (IDOR)</h2>
<p class="mb-4">Attackers can access other users\' data by modifying resource IDs in requests.</p>

<h3 class="font-semibold mb-2">Common Vulnerable Locations:</h3>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>User profile pages</li>
    <li>Document download links</li>
    <li>API endpoints</li>
    <li>Account settings</li>
</ul>

<h3 class="font-semibold mb-2">Vulnerable Example:</h3>
<p class="mb-2">This endpoint directly fetches user profiles without any authorization checks:</p>
@include("components.code", ["language" => "python", "codepath" => $idor_1])

<h3 class="font-semibold mb-2">Normal Usage:</h3>
<p class="mb-2">When used normally, a user accesses their own profile:</p>
@include("components.code", ["language" => "http", "codepath" => $idor_2])

<h3 class="font-semibold mb-2">Attack Examples:</h3>
<p class="mb-2">Attackers can access unauthorized data by changing the ID:</p>
@include("components.code", ["language" => "http", "codepath" => $idor_3])

<h3 class="font-semibold mb-2">Common Vulnerable URLs:</h3>
<p class="mb-2">IDOR vulnerabilities are often found in these URL patterns:</p>
@include("components.code", ["language" => "http", "codepath" => $idor_4])

<h3 class="font-semibold mt-6 mb-2">Protected Implementation:</h3>
<p class="mb-2">Proper implementation includes authorization checks:</p>
@include("components.code", ["language" => "python", "codepath" => $idor_5])

<p class="mt-2">Security measures implemented:</p>
<ul class="list-disc pl-6 space-y-2">
    <li>Login requirement before access</li>
    <li>Authorization check for specific user</li>
    <li>Proper error handling</li>
    <li>Access control at every endpoint</li>
</ul>
';

$encryption_content = '
<h2 class="font-bold mb-4">Data Encryption</h2>
<p class="mb-4">Protecting sensitive information by converting it into encoded text that can only be decoded
    with a key.</p>

<h3 class="font-semibold mb-2">Types of Encryption:</h3>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>Data at rest: Encrypted databases and file systems</li>
    <li>Data in transit: SSL/TLS protocols, HTTPS</li>
    <li>End-to-end encryption: Secure communication channels</li>
    <li>Password hashing: Secure credential storage</li>
</ul>

<h3 class="font-semibold mb-2">Basic Encryption Example (Caesar Cipher):</h3>
<p class="mb-2">A simple shift cipher (for demonstration only, not secure):</p>
@include("components.code", ["language" => "python", "codepath" => $encryption_1])

<p class="mb-2">Example usage:</p>
@include("components.code", ["language" => "python", "codepath" => $encryption_2])

<h3 class="font-semibold mb-2">Substitution Cipher Example:</h3>
<p class="mb-2">Replacing characters with predefined mappings (also not secure, for demonstration):</p>
@include("components.code", ["language" => "python", "codepath" => $encryption_3])

<h3 class="font-semibold mb-2">Common Vulnerabilities:</h3>
<p class="mb-2">Examples of weak encryption practices to avoid:</p>
@include("components.code", ["language" => "python", "codepath" => $encryption_4])

<h3 class="font-semibold mb-2">Predictable Key - DO NOT USE!</h3>
<p class="mb-2">Using a hardcoded key for encryption:</p>
@include("components.code", ["language" => "python", "codepath" => $encryption_5])

<h3 class="font-semibold mt-6 mb-2">Secure Implementation:</h3>
<p class="mb-2">Using modern encryption libraries for secure data storage:</p>
@include("components.code", ["language" => "python", "codepath" => $encryption_5])

<p class="mt-2">Security measures implemented:</p>
<ul class="list-disc pl-6 space-y-2">
    <li>Secure key generation</li>
    <li>Modern encryption algorithms</li>
    <li>Proper key management</li>
    <li>Secure data storage</li>
</ul>
';

$csrf_content = '
<h2 class="font-bold mb-4">Cross-Site Request Forgery (CSRF)</h2>
<p class="mb-4">CSRF tricks users into performing unwanted actions on a site where they\'re authenticated. The attack works by exploiting the user\'s active session.</p>

<h3 class="font-semibold mb-2">How CSRF Works:</h3>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>User is logged into a legitimate site (e.g., bank.com)</li>
    <li>User visits a malicious site while still logged in</li>
    <li>Malicious site triggers unauthorized requests to bank.com</li>
    <li>Requests include user\'s valid session cookies</li>
</ul>

<h3 class="font-semibold mb-2">Vulnerable Example:</h3>
<p class="mb-2">A form without CSRF protection:</p>
@include("components.code", ["language" => "html", "codepath" => $csrf_1])

<h3 class="font-semibold mb-2">Attack Example:</h3>
<p class="mb-2">Malicious site with auto-submitting form:</p>
@include("components.code", ["language" => "html", "codepath" => $csrf_2])

<h3 class="font-semibold mt-6 mb-2">Protected Implementation:</h3>
<p class="mb-2">Using CSRF tokens to protect forms:</p>
@include("components.code", ["language" => "python", "codepath" => $csrf_3])

<p class="mt-2">Protection measures implemented:</p>
<ul class="list-disc pl-6 space-y-2">
    <li>Unique CSRF token per session</li>
    <li>Token validation on every POST request</li>
    <li>Secure token generation</li>
    <li>Token transmitted via hidden form field</li>
</ul>
';

$file_upload_content = '
<h2 class="font-bold mb-4">File Upload Vulnerabilities</h2>
<p class="mb-4">Insecure file upload functionality can lead to remote code execution, XSS, and other security issues.</p>

<h3 class="font-semibold mb-2">Common Risks:</h3>
<ul class="list-disc pl-6 space-y-2 mb-4">
    <li>Uploading malicious scripts</li>
    <li>Overwriting system files</li>
    <li>Denial of service through large files</li>
    <li>Path traversal in filenames</li>
</ul>

<h3 class="font-semibold mb-2">Vulnerable Example:</h3>
<p class="mb-2">Basic file upload without proper validation:</p>
@include("components.code", ["language" => "python", "codepath" => $file_upload_1])

<h3 class="font-semibold mb-2">Attack Examples:</h3>
@include("components.code", ["language" => "php", "codepath" => $file_upload_2])

<h3 class="font-semibold mt-6 mb-2">Protected Implementation:</h3>
<p class="mb-2">Using secure_filename and size restrictions:</p>
@include("components.code", ["language" => "python", "codepath" => $file_upload_3])

<p class="mt-2">Security measures implemented:</p>
<ul class="list-disc pl-6 space-y-2">
    <li>File type validation</li>
    <li>Size restrictions</li>
    <li>Secure filename handling</li>
    <li>Proper storage location</li>
</ul>
';

$auth_content = Blade::render($auth_content, compact('auth_1', 'auth_2', 'auth_3', 'auth_4', 'auth_5'));
$xss_content = Blade::render($xss_content, compact('xss_1', 'xss_2', 'xss_3', 'xss_4', 'xss_5', 'xss_6', 'xss_7', 'xss_8'));
$sql_content = Blade::render($sql_content, compact('sql_1', 'sql_2', 'sql_3', 'sql_4', 'sql_5', 'sql_6'));
$idor_content = Blade::render($idor_content, compact('idor_1', 'idor_2', 'idor_3', 'idor_4', 'idor_5'));
$encryption_content = Blade::render($encryption_content, compact('encryption_1', 'encryption_2', 'encryption_3', 'encryption_4', 'encryption_5'));
$csrf_content = Blade::render($csrf_content, compact('csrf_1', 'csrf_2', 'csrf_3'));
$file_upload_content = Blade::render($file_upload_content, compact('file_upload_1', 'file_upload_2', 'file_upload_3'));

$topics = [
        "authentication" => [
            "title" => "Authentication vs Authorization",
            "content" => $auth_content
        ],
        "idor" => [
            "title" => "Insecure Direct Object References (IDOR)",
            "content" => $idor_content
        ],
        "file_upload" => [
            "title" => "File Upload Vulnerabilities",
            "content" => $file_upload_content
        ],
        "encryption" => [
            "title" => "Data Encryption",
            "content" => $encryption_content
        ],
        "sql" => [
            "title" => "SQL Injection",
            "content" => $sql_content
        ],
        "xss" => [
            "title" => "Cross-Site Scripting (XSS)",
            "content" => $xss_content
        ],
        "csrf" => [
            "title" => "Cross-Site Request Forgery (CSRF)",
            "content" => $csrf_content
        ],
        
];
@endphp

<!-- Security Principle Definition Box -->
<div class="p-4 bg-white border border-gray-300 rounded shadow-md mb-4">
    <h2 class="text-2xl font-semibold">What are Security Principles?</h2>
    <p>Security principles are the foundation of secure software development. They guide the design and implementation of secure systems.</p>
    <p>Designing and implementing security principles are <strong>important</strong> to delivering a successful product.</p>
    <p>When you press a button, a description will appear. Go through and learn about the security vulnerabilities and prevention techniques.</p>
</div>

@include('templates.topics', [
    'topicHeader'       => 'Security Principles',
    'placeholderText'   => 'Select a topic to view its details',
    'topics'            => $topics
])