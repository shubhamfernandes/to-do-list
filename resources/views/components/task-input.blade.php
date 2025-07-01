{{-- Left Column: Add Task Form --}}
<div class="w-100 px-3" style="max-width: 400px; padding-top: 60px; margin: 0 auto;">

    <form action="{{ route('tasks.store') }}" method="POST" class="d-flex flex-column gap-2">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="Insert task name">
        <button type="submit" class="btn btn-primary w-100">Add</button>
    </form>
</div>
