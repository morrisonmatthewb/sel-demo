<div class="text-1xl font-bold mb-2">Adding a page:</div>
<p class="mb-2">
    For every page in the <code>$pages</code> list needs to have a view except for "index" and "review". To make the view, create the file
    <code>resources/views/labs/labid/pageid.blade.php</code>
</p>
<p class="mb-2">
    These blade files are automatically included into a skeleton, so you don't need to write anything like <code>&lt;html&gt;</code>, just the contents of the body.
</p>
<br>
<div class="text-1xl font-bold mb-2">Using Components:</div>
<p class="mb-2">
    Components are used for anything in a module that could be reused.
    All forms of questions should be done through a component.
    Complicated static elements that are used frequently are also components (such as the syntax highlighted code block).
</p>
<p class="mb-2">
    This module doesn't include documentation for every component, but the way you use a component is the same for all of them. You can find all the available components in
    <code>resource/views/components</code> and they all (should) have comments describing which parameters to set.
</p>
<p class="mb-2">
    If you end up creating something that you need for your module, consider whether it makes more sense as a component and if so, create it as such.
</p>
<br>
<div class="text-1xl font-bold mb-2">Component Usage example:</div>
@include('components.code', [
    'language' => 'php',
    'code' => "@include('components.rating', [\"question\"=>\"How much do you like this module?\", \"name\"=>\"review\"])"
])
<p class="mb-2">
    Doing that creates this component:
</p>
<div class="bg-gray-50 p-6 rounded-lg shadow mb-6">
    @include('components.rating', ["question"=>"How much do you like this module?", "name"=>"review"])
</div>
<br>
<div class="text-1xl font-bold mb-2">Code for this page:</div>
<p class="mb-2">Here is an example of what the blade file for this page looks like (<code>resources/views/labs/module-making/pages.blade.php</code>)</p>
@include('components.code', [
    'language' => 'html',
    'codepath' => resource_path("/views/labs/module-making/pages.blade.php")
])
