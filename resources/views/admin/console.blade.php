@use('App\Models\Module')
@use('App\Http\Controllers\StudentController')
@use('Illuminate\Support\Carbon')
@extends('master')

@section('content')
<h1>Teacher Panel</h1>
<h3>Assigned Modules:</h3>
<div id="assigned-editor" class="editor panel panel-default" hidden>
    <div id="assigned-editor-title", class="editor-title">Editing "security":</div>
    <form id="editAssigned" onsubmit="submit_assign_editor(event)">
        @csrf
        <input name="module" id="assign-editor-module-name" hidden value="security">
        <div>
            <label for="applyFor">Edit for:</label>
            <select id="applyFor" name="ApplyFor">
                <option value="all">All Students</option>
                <option value="begun">Students who have started</option>
                <option value="new">Students who haven't started</option>
            </select>
        </div>
        <div>
            <label for="update">Update:</label>
            <select id="edit-assigned-update" name="update" onchange="assigned_editor_update_vis()">
                <option value="due">Due Date</option>
                <option value="locked">Locked/Unlocked</option>
                <option value="both">Both</option>
            </select>
        </div>
        <div id="duedate">
            <label for="datetime">New Due Date:</label>
            <input type="datetime-local" id="editdue" name="datetime">
        </div>
        <div id="lockedstate" hidden>
            <label for="locked">Locked State:</label>
            <select id="editlocked" name="locked">
                <option value="locked">Locked</option>
                <option value="unlocked">Unlocked</option>
            </select>
        </div>
        <div>
            <button type="submit">Confirm</button>
            <button type="button" onclick="cancel_assign_edit()">Cancel</button>
        </div>
    </form>
    <script>
        function cancel_assign_edit(){
            document.getElementById("assigned-editor").hidden = true;
        }
        function assigned_editor_update_vis(){
            var val = document.getElementById("edit-assigned-update").value;
            var due = document.getElementById("duedate");
            var loc = document.getElementById("lockedstate");
            if (val === "due"){
                loc.hidden = true;
                due.hidden = false;
            }else if(val === "locked"){
                loc.hidden = false;
                due.hidden = true;
            }else{
                loc.hidden = false;
                due.hidden = false;
            }
        }
        function submit_assign_editor(event){
            event.preventDefault();
            var edit_for = document.getElementById("applyFor").value;
            var update = document.getElementById("edit-assigned-update").value;
            var due_date = document.getElementById("editdue").value;
            var locked = document.getElementById("editlocked").value;
            var module = document.getElementById("assign-editor-module-name").value;
            var json = {
                "where": {"module": module},
                "values": {}
            };
            if(update !== "locked"){
                json.values.due = due_date;
            }
            if(update !== "due"){
                json.values.locked = locked === "locked";
            }
            if(edit_for === "begun"){
                json.where.user = ["!=",null];
            }
            if(edit_for === "new"){
                json.where.user = ["=", null];
            }
            const jsonData = {
                "_token": document.querySelector('input[name="_token"]').value, // CSRF token
                "data": json
            };

            // Post the JSON data using fetch
            fetch('{{ route("admin.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData) // Convert the JSON object to a string
            })
            .then(response => {
                if (!response.ok) {
                    alert("Error Updating Module");
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                location.reload();
            })
            .catch((error) => {
                alert("Error Updating Module");
                console.error('Error:', error);
            });
        }
        function edit(module){
            document.getElementById("applyFor").value = "all";
            document.getElementById("edit-assigned-update").value = "due";
            document.getElementById("editdue").value = "";
            document.getElementById("editlocked").value = "locked";
            document.getElementById("assign-editor-module-name").value = module;
            document.getElementById("assigned-editor-title").innerText = "Editing \""+module+"\":";
            assigned_editor_update_vis();
            document.getElementById("assigned-editor").hidden = false;
        }
    </script>
</div>
@foreach(Module::whereNull("user")->get() as $item)
<div class="assigned-module panel panel-default">
    <div class="txt name">
        <a href="{{ route('admin.laboverview', ['lab' => $item["module"]]) }}">{{ StudentController::$labControllers[$item["module"]]::$display }}</a>
    </div>
    <div class="txt">
        @if ($item["locked"])
            Locked
        @else
            Unlocked
        @endif
    </div>
    <div class="txt">
        {{ Module::where("module", $item["module"])->whereNotNull("user")->count() }} Started
    </div>
    <div class="txt due">
        @if($item["due"])
            Due {{ Carbon::parse($item["due"])->format("D M d, Y h:ia") }}
        @else
            No Due Date
        @endif
    </div>
    <button class="edit_button" onclick="edit('{{ $item['module'] }}')">Edit</button>
</div>
@endforeach
<hr>
<h1>Admin Panel for Assigning New Module</h1>
<h3>Module Table</h3>
<pre>
    +-----------+--------------+------+-----+---------+-------+
    | Field     | Type         | Null | Key | Default | Extra |
    +-----------+--------------+------+-----+---------+-------+
    | module    | varchar(255) | YES  |     | NULL    |       |
    | user      | varchar(255) | YES  |     | NULL    |       |
    | form_path | varchar(255) | YES  |     | NULL    |       |
    | log_path  | varchar(255) | YES  |     | NULL    |       |
    | locked    | bit(1)       | YES  |     | NULL    |       |
    | submitted | bit(1)       | YES  |     | NULL    |       |
    | open      | datetime     | YES  |     | NULL    |       |
    | due       | datetime     | YES  |     | NULL    |       |
    +-----------+--------------+------+-----+---------+-------+
</pre>
<h3>Valid Modules:</h3>
<pre>{{ implode(", ", array_keys(StudentController::$labControllers)) }}</pre>
<h2>Post JSON Data to Assign Endpoint</h2>
<p>Specify values for columns that will not be default. "module" must be set. You may set the "module", "locked", and "due" columns. Any other values will not be applied.</p>
<form id="jsonForm" onsubmit="submitForm(event)">
    @csrf
    <label for="jsonInput">Enter data:</label>
    <input type="text" id="jsonInput" name="jsonInput" placeholder='{"module": "cost-estimation"}' required>
    <button type="submit">Submit</button>
    <p id="assignStatus"></p>
</form><br>

@endsection

@section('optionscripts')
<script>
    function submitForm(event) {
        let assignStatus = document.getElementById("assignStatus");
        assignStatus.innerText = "Loading...";
        event.preventDefault(); // Prevent the default form submission

        // Get the value from the textbox
        const textboxValue = document.getElementById('jsonInput').value;

        // Create the JSON payload including CSRF token
        var parsed = "";
        try{
            parsed = JSON.parse(textboxValue);
        }catch(error){
            assignStatus.innerText = error.toString();
            return;
        }

        const jsonData = {
                "_token": document.querySelector('input[name="_token"]').value, // CSRF token
                "data": parsed // Parse the input value as JSON
            };

        // Post the JSON data using fetch
        fetch('{{ route("admin.assign") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData) // Convert the JSON object to a string
        })
        .then(response => {
            if (!response.ok) {
                assignStatus.innerText = 'Network response was not ok ' + response.statusText;
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            assignStatus.innerText = 'Success: ' + JSON.stringify(data);
            console.log('Success:', data);
            // Handle success (e.g., show a message to the user)
        })
        .catch((error) => {
            assignStatus.innerText = error.toString();
            console.error('Error:', error);
            // Handle error (e.g., show an error message to the user)
        });
    }
</script>

<style>
    .editor{
        border-style:solid;
        border-width:1px;
        padding:10px;
        margin:10px;
    }
    .assigned-module{
        border-style:solid;
        border-width:1px;
        overflow: wrap;
        display:flex;
        justify-content: space-between;
        padding:10px;
        margin:10px;
        align-items:center;
    }
    .txt{
        flex: 1;
        display:inline;
        width:max-content;
        margin-right:10px;
    }
    .due{
        text-align: right;
    }
    .name{
        flex:2;
    }
    .editor-title{
        font-size:1.5em
    }
</style>
@endsection
