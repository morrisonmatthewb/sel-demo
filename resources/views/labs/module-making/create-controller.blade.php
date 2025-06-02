<p class="mb-2">
    Make a new controller in <code>app/Http/Controllers/Labs</code> (please keep it short and ending in "Controller", e.g. <code>ModuleCreationController.php</code>) inheriting <code>DefaultController</code> and set the following properties.
</p>
@include('components.code', [
    'language'=>'php',
    'codepath' => resource_path('/codesnippets/module-making/controller')
])
<ul class="mt-2 mb-2 pl-6 space-y-2 list-disc">
    <li><code>$lab</code> is the id for the module, this will be used in the backend and also in the url</li>
    <li><code>$display</code> is the display name for the module, it will be what is shown to the student</li>
    <li><code>$description</code> is the description for the module that shows in the module list and on the index page</li>
    <li><code>$pages</code> is the list of pages (id/url) and their display names. <b>The first one must be index and the last must be review.</b> The display name for index and review is not read. You must have a blade file for each page except index and review in <code>resources/views/labs/labid/pageid.blade.php</code>.</li>
    <li><code>$objectives</code> is the list of learning objectives</li>
    <li><code>$willlearn</code> is the list of items in the "What You'll Learn" section</li>
</ul>
