 <div class="list-container">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th class="text-start" style="width: 5%;">#</th>
                <th class="text-start" style="width: 70%;">Task</th>
                <th class="text-start" style="width: 25%;"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td class="text-start">
                        {{ ($tasks->currentPage() - 1) * $tasks->perPage() + $loop->iteration }}
                    </td>
                    <td @class(['text-start', 'completed' => $task->is_completed])>
                        {{ $task->name }}
                    </td>
                    <td class="text-start">
                        @if (! $task->is_completed)
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-green btn-sm">
                                    <img src="{{ asset('assets/check.png') }}" alt="Bootstrap" width="24" height="24">
                                </button>
                            </form>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-red btn-sm">
                                    <img src="{{ asset('assets/remove.png') }}" alt="Bootstrap" width="24" height="24">
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-muted text-center">No tasks yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

        {{-- Pagination --}}
        <x-pagination :paginator="$tasks" />



</div>
