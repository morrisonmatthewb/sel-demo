<div class="text-1xl font-bold mb-2">Set up routing:</div>
<p class="mb-2">
    Open <code>App\Http\Controllers\StudentController.php</code> and edit <code>$labControllers</code> to include <code>'yourlab' => LabsController\YourController::class</code>
</p>
<br>
<div class="text-1xl font-bold mb-2">Assigning Module:</div>
<p class="mb-2">
    When you first create the module, it will be unassigned. To assign it, go to the site as an admin and click teacher view at the top of the module list.
    Once you're in the teacher view, you can assign you module using the "Admin Panel for Assigning New Module"
</p>
<p class="mb-2">
    To assign your module, you will put the json <code>{"module": "your-module-id"}</code> and click submit.
</p>
<p class="mb-2">
    You can also include a due date or whether it's locked in the json or alternatively set them by editing the module after assigning it.
</p>
