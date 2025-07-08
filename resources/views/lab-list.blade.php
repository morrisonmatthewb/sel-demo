@use('App\Helpers\FormApi')
@extends('master')

@section('content')

<h3>Modules</h3>
@if(FormApi::logged_in_admin())
<div><a href="{{ route("admin.console") }}">Teacher Console</a></div><br>
@csrf
@endif
@foreach($module_items as $module)
@if ($module->name != "cicd-config-management")
<div class="panel panel-default" style="padding:5px">
    <p>
    <span style="display: inline-block; width:20em;"><b>
    @if($module->assigned)
    <a href="{{ route('modules.lab', ['lab' => $module->name]) }}"> {{ $module->displayName() }} Module </a>
    @else
    {{ $module->displayName() }} Module
    @endif
    </b>
    </span>
    <span style="display: inline-block; width:15em;">
        {{ $module->assigned ? "$module->due" : "Unassigned"}}
    </span>
    <span style="display: inline-block; color:{{ $module->status ? "green" : "red"}}">{{ $module->assigned ? ($module->status ? "Submitted" : "Unsubmitted") : ""}}</span></p>
    <p></p><pre style="white-space: pre-wrap; word-break: keep-all;">{{ $module->description() }}</pre><p></p>
    </div>
@endif
@endforeach
@endsection