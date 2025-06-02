<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Exercise Overview</h2>
    <p>In this portion of the exercise, you get to make your very own installer! Follow these steps to get started:</p>
    <ul class="list-decimal pl-6 mb-4">
        <li>Select the correct platform tab below and follow the steps to create an installer for <a href="https://github.com/ayhanmehdiyev/installers-exercise" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">this GitHub repository</a>.</li>
        <li>Once your installer is ready, fork that same GitHub repository and commit the installer to it.</li>
        <li>Finally, enter the GitHub Repo link down below.</li>
    </ul>
    <p>- If it would help, you can check out how the example installers were made: <a href="https://github.com/ayhanmehdiyev/example-Installers" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">example-installers</a>.</p>
</div>

<!-- Divs for each platform -->
<ul class="list-disc pl-6">
    <li>
        <strong>Create an Executable</strong>: 
        Before building an installer, you need to create a standalone executable of your application. A great tool for this is <a href="https://pyinstaller.org" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">PyInstaller</a>.
        <ul class="list-disc pl-6 mt-2">
            <li>Install PyInstaller: <code>pip install pyinstaller</code></li>
            <li>Run the following command to create a standalone executable:
                @include('components.code', [
                    'language' => 'bash',
                    'code' => "pyinstaller --name ExampleApp --onefile main.py"
                ])
            </li>
            <li>Your executable will be located in the <code>dist</code> folder (e.g., <code>dist/ExampleApp</code>).</li>
        </ul>
    </li>
    <br>
    <li>
        <strong>Prepare a License Agreement</strong>: 
        Include a legal document (<code>LICENSE.txt</code>) that users must agree to before installation begins.
        <ul class="list-disc pl-6 mt-2">
            <li>Create a plain text file named <code>LICENSE.txt</code> containing the terms and conditions of your software.</li>
            <li>Ensure the license is included in all installer configurations for each platform.</li>
        </ul>
    </li>
    <br>
    <li>
        <strong>Pathing and Environment Variables</strong>: 
        Set the default installation path and environment variables so that the software installs in a consistent location across systems.
        <ul class="list-disc pl-6 mt-2">
            <li>On Windows, define the path in the installer to typically default to <code>C:\Program Files\YourApp</code>.</li>
            <li>On macOS/Linux, use paths like <code>/usr/local/YourApp</code>.</li>
        </ul>
    </li>
</ul>
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Windows Installer Instructions</h2>
    <div id="windows-info">
        <p><strong>Tool:</strong> For Windows, use Inno Setup or NSIS. Below is an example using Inno Setup.</p>
        <br>
        <h4 class="font-semibold mb-2">Step 1: Download Inno Setup</h4>
        <p>Go to the <a href="https://jrsoftware.org/isinfo.php" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">Inno Setup website</a> and download the installer.</p>
        <br>
        <h4 class="font-semibold mb-2">Step 2: Configure the Installer Script</h4>
        <p>Inno Setup requires a script file (<code>.iss</code>). Here are the essential components:</p>

        @include('components.code', [
            'language' => 'ini',
            'code' => "[Setup]
    AppName=YourAppName
    AppVersion=1.0
    DefaultDirName={pf}\\YourApp
    DefaultGroupName=YourApp
    OutputDir=.
    OutputBaseFilename=YourAppInstaller"
        ])

        <p>Customize the script as necessary, replacing placeholders with your app’s name, version, and install directory.</p>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">macOS Installer Instructions</h2>
    <div id="macos-info">
        <p><strong>Tool:</strong> Use <code>pkgbuild</code> or <a href="http://s.sudre.free.fr/Software/Packages/about.html" class="text-blue-500 hover:underline" target="_blank" rel="noopener noreferrer">Packages</a>.</p>
        <br>
        <h4 class="font-semibold mb-2">Step 1: Prepare Your Application</h4>
        <p>Organize your application files in a folder that represents the final installation path.</p>
        <br>
        <h4 class="font-semibold mb-2">Step 2: Create the Installer Package</h4>
        <p>Use the following <code>pkgbuild</code> command to create a macOS installer package:</p>

        @include('components.code', [
            'language' => 'bash',
            'code' => 
"pkgbuild --root /path/to/your/application \
          --identifier com.yourcompany.yourapp \
          --version 1.0 \
          --install-location /Applications/YourApp \
          --component /path/to/your/application/ExampleApp \
          --license /path/to/your/application/LICENSE.txt \
          output.pkg"
        ])

        <p>Replace <code>/path/to/your/application</code> with your app’s directory, and adjust the identifier and version as needed.</p>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Linux Installer Instructions</h2>

    <div id="linux-info">
        <p><strong>Tool:</strong> Consider using AppImage or <code>dpkg-deb</code> for Debian-based distributions.</p>
        <br>
        <h4 class="font-semibold mb-2">Step 1: Prepare Your Application Directory</h4>
        <p>Ensure your application files are in a folder structured for installation, with appropriate paths set for Linux.</p>
        <br>
        <h4 class="font-semibold mb-2">Step 2: Build the <code>.deb</code> Package</h4>
        <p>Use the following <code>dpkg-deb</code> command to create a Debian package:</p>

        @include('components.code', [
            'language' => 'bash',
            'code' => 
"mkdir -p /path/to/application/folder/usr/local/bin
mkdir -p /path/to/application/folder/usr/share/licenses/yourapp
cp /path/to/executable/ExampleApp /path/to/application/folder/usr/local/bin/
cp /path/to/LICENSE.txt /path/to/application/folder/usr/share/licenses/yourapp/LICENSE.txt

dpkg-deb --build /path/to/application/folder yourapp.deb"
        ])

        <p>Replace <code>/path/to/application/folder</code> with your app’s directory path and specify the desired output file name.</p>
    </div>
</div>
<br>
<div class="mt-2 mb-2">
    @include('components.url-input', ["question" => "Enter the link to your repo (must be a github link):", "name" => "installers-creation-url", "pattern" => "https:\/\/(www\.)?github\.com\/.*", "placeholder" => "https://github.com/username/repo"])
</div>