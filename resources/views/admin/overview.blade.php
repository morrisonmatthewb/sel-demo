@use('App\Models\Module')
@use('App\Http\Controllers\StudentController')
@use('Illuminate\Support\Carbon')
@extends('master')

@section('content')
<a href="{{ route("admin.console") }}">< Back</a>
<h1>Teacher Panel - {{ StudentController::$labControllers[$lab]::$display }}</h1>
<h3>Students (who've started):</h3>
<div id="assigned-editor" class="editor panel panel-default" hidden>
    <div id="assigned-editor-title", class="editor-title">Editing "security":</div>
    <form id="editAssigned" onsubmit="submit_assign_editor(event)">
        @csrf
        <input name="module" id="assign-editor-module-name" hidden value="security">
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
            var update = document.getElementById("edit-assigned-update").value;
            var due_date = document.getElementById("editdue").value;
            var locked = document.getElementById("editlocked").value;
            var module = document.getElementById("assign-editor-module-name").value;
            var json = {
                "where": {"module": "{{ $lab }}", "user": module},
                "values": {}
            };
            if(update !== "locked"){
                json.values.due = due_date;
            }
            if(update !== "due"){
                json.values.locked = locked === "locked";
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
<div>
{{ Module::where("module", $lab)->whereNotNull("user")->count() }} Records
</div>
@foreach(Module::where("module", $lab)->whereNotNull("user")->get() as $item)
<div class="assigned-module panel panel-default">
    <div class="txt">
        <a href="{{ route('admin.summary', ['lab' => $lab, 'student' => $item["user"]]) }}">{{ $item["user"] }}</a>
    </div>
    <div class="txt">
        @if ($item["locked"])
            Locked
        @else
            Unlocked
        @endif
    </div>
    <div class="txt">
        @if($item["submitted"]) Submitted
        @else Unsubmitted
        @endif
    </div>
    <div class="txt due">
        @if($item["due"])
            Due {{ Carbon::parse($item["due"])->format("D M d, Y h:ia") }}
        @else
            No Due Date
        @endif
    </div>
    <button class="edit_button" onclick="edit('{{ $item['user'] }}')">Edit</button>
</div>
@endforeach
<br>
@endsection

@section('optionscripts')

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
