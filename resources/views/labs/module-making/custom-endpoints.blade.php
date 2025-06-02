<p class="mb-2">
    Some modules contain activities that require backend endpoints specifically for their function.
    There are some rules that should be followed when writing these endpoints. Most modules will not need to do this.
</p>
<ul class="mt-2 mb-2 pl-6 space-y-2 list-disc">
    <li>All files should made and referenced using the FormApi, do not directly reference filepaths</li>
    <li>Do not make any queries to the main database. Some activities using databases can create module specific sqlite files</li>
    <li>Do not do anything that will have an impact outside of your module</li>
</ul>
<br>
<p class="mb-2">
    There are 2 function in the <code>DefaultController</code> that by default return a 404 error.
    <code>nonPage</code> is called when a get request is made to a page not in the <code>$pages</code> list and
    <code>post</code> is called when a post request is made to any page.
    You can override each of these functions in your module's controller to write your own handler for these requests.
</p>
@include('components.code', [
    "language"=>"php",
    "codepath"=>resource_path("/codesnippets/module-making/functions")
])
<p class="mb-2">
    Just make sure that when you override them that any endpoints that you do not handle cause <code>abort(404)</code>.
</p>
