@extends('layouts.app')

@section('title', 'The List of Tasks')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 d-flex flex-column flex-md-row gap-4">
        {{-- Left: Logo and Add Form --}}
        <x-task-input />

        {{-- Right: Task List --}}
        <x-task-list :tasks="$tasks" />
    </div>
</div>
@endsection
