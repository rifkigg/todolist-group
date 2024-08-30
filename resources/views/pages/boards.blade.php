<x-layout>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-navbar>
            <x-slot name="dashboard">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="/boards">
                        <i class="fa-solid fa-chess-board"></i>
                        <span>Boards</span>
                    </a>
                </li>
            </x-slot>

            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Project</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if (auth()->user()->role == 'admin')
                            <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                            <a class="collapse-item " href="{{ route('projectcategories.index') }}">Categories</a>
                            <a class="collapse-item" href="{{ route('project_status.index') }}">Project Status</a>
                        @elseif (auth()->user()->role == 'manajer')
                            <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                        @else
                            <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                    aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                    <i class="fas fa-clipboard-list "></i>
                    <span>Task</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if (auth()->user()->role == 'admin')
                            <a class="collapse-item " href="{{ route('task.index') }}">Task</a>
                            <a class="collapse-item" href="{{ route('task_status.index') }}">Task Status</a>
                            <a class="collapse-item " href="{{ route('priorities.index') }}">Task Priorities</a>
                            <a class="collapse-item" href="{{ route('labels.index') }}">Task Labels/Tags</a>
                        @else
                            <a class="collapse-item " href="{{ route('task.index') }}">Task</a>
                        @endif
                    </div>
                </div>
            </li>
        </x-navbar>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-navbar-topbar></x-navbar-topbar>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form method="GET" action="{{ route('boards.index') }}">
                        <div class="form-group">
                            <label for="projectSelect">Select Project:</label>
                            <select id="projectSelect" name="project_id" class="form-control"
                                onchange="this.form.submit()">
                                <option value="" disabled selected>Choose Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>


                    <div style="height: 100vh;">
                        <div class="board-container overflow-auto d-flex flex-nowrap align-items-start"
                            style="max-width: 100%; padding: 10px;">
                            @forelse ($boards as $board)
                                <div class="board-item"
                                    style="min-width: 300px; height: auto;  margin-right: 10px; border: 1px solid #ccc; border-radius: 5px; padding: 10px; background-color: #f9f9f9;">
                                    <h5 style="margin: 0;">{{ $board->board_name }}</h5>
                                    <br>

                                    @forelse ($board->tasks as $task)
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#view-{{ $task->id }}">
                                            <div class="text-white bg-secondary rounded p-2">
                                                <p class="mb-0">{{ $task->name }}</p>
                                            </div>
                                        </a>
                                        <br>

                                        <div class="modal fade" id="view-{{ $task->id }}" tabindex="-1"
                                            aria-labelledby="createModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <form action="{{ route('task.update', $task->id) }}" method="POST"
                                                        enctype="multipart/form-data"
                                                        id="formUpdate-{{ $task->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title w-100" id="createModalLabel">
                                                                <input type="text" class="form-control border-0"
                                                                    id="name" name="name"
                                                                    value="{{ $task->name }}">
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-around">
                                                                <div style="width: 55%">
                                                                    <label for="description"
                                                                        class="form-label">Description</label>
                                                                    <textarea class="form-control mb-3" id="textarea1" name="description">{{ old('description', $task->description) }}</textarea>

                                                                    <div class="mb-3 d-flex justify-content-between">
                                                                        <label for="checklist"
                                                                            class="form-label">Checklist</label>
                                                                        <button class="btn btn-success btn-sm"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseChecklist"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseChecklist"
                                                                            onclick="alert('The input to add an checklist is below')">
                                                                            <i class="fa-solid fa-plus"></i> Add
                                                                            Checklist
                                                                        </button>
                                                                    </div>

                                                                    <div class="bg-secondary-subtle p-2 overflow-auto"
                                                                        style="max-height: 300px">
                                                                        @if ($task->checklist)
                                                                            @foreach ($task->checklist as $gg)
                                                                                <div class="p-2 rounded bg-light mb-2">
                                                                                    <input type="radio"
                                                                                        value="{{ $gg->id }}"
                                                                                        class="m-0">
                                                                                    {{ $gg->name }}</input>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <p>No checklist items found.</p>
                                                                        @endif
                                                                    </div>

                                                                    <p for="attachments" class="form-label">Attachment
                                                                    </p>
                                                                    <div class="overflow-auto"
                                                                        style="max-height: 300px">
                                                                        @foreach ($task->attachments as $img)
                                                                            <div
                                                                                class="mb-3 d-flex align-items-start gap-2">
                                                                                <a
                                                                                    href="{{ asset('storage/attachments/' . $img->file_name) }}">
                                                                                    <img src="{{ asset('storage/attachments/' . $img->file_name) }}"
                                                                                        alt="{{ $img->file_name }}"
                                                                                        width="150">
                                                                                </a>
                                                                                <div>
                                                                                    <button type="button"
                                                                                        onclick="if(confirm('Are you sure you want to delete this attachment?')) { document.getElementById('deleteGambar-{{ $img->id }}').submit(); }"
                                                                                        class="btn btn-danger btn-sm">
                                                                                        <i
                                                                                            class="fa-solid fa-trash"></i>
                                                                                    </button>
                                                                                    <p>Created at:
                                                                                        {{ $img->created_at }}</p>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>

                                                                    <div
                                                                        class="mb-3 d-flex align-items-center justify-content-between">
                                                                        <p for="activities" class="form-label">
                                                                            Activities
                                                                        </p>
                                                                        <button class="btn btn-success btn-sm"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseExample"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseExample"
                                                                            onclick="alert('The input to add an activities is below')">
                                                                            <i class="fa-solid fa-plus"></i> Add
                                                                            Activities
                                                                        </button>

                                                                    </div>
                                                                    <div class="bg-secondary-subtle p-2 overflow-auto"
                                                                        style="max-height: 300px">
                                                                        @foreach ($task->activities as $act)
                                                                            <div class="p-2 rounded bg-light mb-2">
                                                                                <p class="m-0">{{ $act->activity }}
                                                                                </p>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                                <div style="width: 35%">
                                                                    <label for="board_id" class="form-label">Task
                                                                        Board</label>
                                                                    <select name="board_id" id="board_id"
                                                                        class="form-select mb-3">
                                                                        <option value="{{ $board->id }}"
                                                                            {{ old('board_id', $task->board_id) == $board->id ? 'selected' : '' }}>
                                                                            {{ $board->board_name ?? ' ' }}
                                                                        </option>
                                                                    </select>

                                                                    <label for="status_id" class="form-label">Task
                                                                        Status</label>
                                                                    <select name="status_id" id="status_id"
                                                                        class="form-select mb-3">
                                                                        @foreach ($status as $items)
                                                                            <option value="{{ $items->id }}"
                                                                                {{ old('status_id', $task->status_id) == $items->id ? 'selected' : '' }}>
                                                                                {{ $items->name ?? ' ' }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="priority_id" class="form-label">Task
                                                                        Priority</label>
                                                                    <select name="priority_id" id="priority_id"
                                                                        class="form-select mb-3">
                                                                        @foreach ($priority as $items)
                                                                            <option value="{{ $items->id }}"
                                                                                {{ old('priority_id', $task->priority_id) == $items->id ? 'selected' : '' }}>
                                                                                {{ $items->name ?? ' ' }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="task_label_id" class="form-label">Task
                                                                        Label</label>
                                                                    <select name="task_label_id" id="task_label_id"
                                                                        class="form-select mb-3">
                                                                        @foreach ($label as $items)
                                                                            <option value="{{ $items->id }}"
                                                                                {{ old('task_label_id', $task->task_label_id) == $items->id ? 'selected' : '' }}>
                                                                                {{ $items->name ?? ' ' }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="project_id" class="form-label">Task
                                                                        Project</label>
                                                                    <select name="project_id" id="project_id"
                                                                        class="form-select mb-3">
                                                                        @foreach ($projects as $items)
                                                                            <option value="{{ $items->id }}"
                                                                                {{ old('project_id', $task->project_id) == $items->id ? 'selected' : '' }}>
                                                                                {{ $items->name ?? ' ' }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <!-- Assignees (Multi-Select) -->
                                                                    <label for="assignees"
                                                                        class="form-label">Assignees</label>
                                                                    <select name="assignees[]" id="assignees"
                                                                        class="form-select mb-3" multiple>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id }}"
                                                                                {{ in_array($user->id, old('assignees', $task->users->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                                {{ $user->username }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <!-- Tempat untuk menampilkan hasil pilihan -->
                                                                    <div id="selected-assignees">
                                                                        <p>Selected Assignees:</p>
                                                                        <ul
                                                                            class="d-flex flex-wrap gap-2 list-unstyled">
                                                                            @foreach ($task->users as $user)
                                                                                <li
                                                                                    class="d-flex align-items-center border rounded px-2 py-1">
                                                                                    {{ $user->username }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>


                                                                    <div class="task-row"
                                                                        data-task-id="{{ $task->id }}">
                                                                        <p for="time_count_{{ $task->id }}"
                                                                            class="form-label">Time Count</p>
                                                                        <div
                                                                            id="stopwatch-container-{{ $task->id }}">
                                                                            <span
                                                                                id="time-display-{{ $task->id }}"
                                                                                class="mb-3">
                                                                                {{ old('time_count', $task->time_count) }}
                                                                            </span>
                                                                            <br>
                                                                            <button type="button"
                                                                                id="start-stopwatch-{{ $task->id }}"
                                                                                class="btn btn-success">Start</button>
                                                                            <button type="button"
                                                                                id="stop-stopwatch-{{ $task->id }}"
                                                                                class="btn btn-danger"
                                                                                disabled>Stop</button>
                                                                            <button type="button"
                                                                                id="reset-stopwatch-{{ $task->id }}"
                                                                                class="btn btn-secondary"
                                                                                disabled>Reset</button>
                                                                        </div>
                                                                        <input type="hidden" name="time_count[]"
                                                                            id="time_count_{{ $task->id }}"
                                                                            value="{{ old('time_count', $task->time_count) }}">
                                                                    </div>
                                                                    <label for="due_date" class="form-label">Due
                                                                        Date</label>
                                                                    <input type="date" name="due_date"
                                                                        id="due_date" class="form-control mb-3"
                                                                        value="{{ old('due_date', $task->due_date) }}">


                                                                    <button type="button" class="btn btn-secondary"
                                                                        onclick="document.getElementById('file_name_{{ $task->id }}').click();">
                                                                        Attachment
                                                                    </button>


                                                                    {{-- tombol delete --}}
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="document.getElementById('deleteForm-{{ $task->id }}').submit();">
                                                                        Delete
                                                                    </button>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form>
                                                    <div class="collapse mt-3" id="collapseExample">
                                                        <!-- Collapse Content -->
                                                        <div class="card card-body">
                                                            <form action="{{ route('activity.store') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="task_id"
                                                                    value="{{ $task->id }}" hidden>
                                                                <label for="focusedInput">Add Activity : </label>
                                                                <textarea class="form-control mb-3" id="focusedInput" name="activity" placeholder="Add Activity"></textarea>
                                                                @error('activity')
                                                                    <div class="alert alert-danger">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                                <button type="submit" class="btn btn-primary">Add
                                                                    Activity</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="collapse mt-3" id="collapseChecklist">
                                                        <div class="card card-body">
                                                            <form action="{{ route('checklist.store') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="task_id"
                                                                    value="{{ $item->id }}" hidden>
                                                                <label for="focusedInput">Add Checklist : </label>
                                                                <textarea class="form-control mb-3" id="focusedInput" name="name" placeholder="Add Activity"></textarea>
                                                                @error('name')
                                                                    <div class="alert alert-danger">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                                <button type="submit" class="btn btn-primary">Add
                                                                    Checklist</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary w-100"
                                                        onclick="document.getElementById('formUpdate-{{ $task->id }}').submit();">Save
                                                        and Close</button>

                                                    <form action="{{ route('task.destroy', $task->id) }}"
                                                        method="POST" class="d-none"
                                                        id="deleteForm-{{ $task->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <form action="{{ route('attachments.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" name="task_id"
                                                            value="{{ $task->id }}" hidden>
                                                        <div>
                                                            <input type="file" name="file_name"
                                                                id="file_name_{{ $task->id }}"
                                                                class="form-control @error('file') is-invalid @enderror"
                                                                style="display: none;" onchange="this.form.submit();">
                                                            @error('file')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </form>

                                                    @foreach ($task->attachments as $img)
                                                        <div>
                                                            <form
                                                                action="{{ route('attachments.destroy', ['task_id' => $task->id, 'file_name' => $img->file_name]) }}"
                                                                method="POST" id="deleteGambar-{{ $img->id }}"
                                                                onsubmit="return confirm('Are you sure you want to delete this attachment?');">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No tasks found for this board.</p>
                                    @endforelse
                                    <div class="d-flex gap-2 card-footer">
                                        <button type="button"
                                            class="btn btn-primary create-task-btn btn-sm w-100 d-flex align-items-center gap-2"
                                            data-board-id="{{ $board->id }}" data-bs-toggle="modal"
                                            data-bs-target="#createTaskModal">
                                            <i class="fa-solid fa-circle-plus fa-sm"></i> Add task
                                        </button>
                                        <form action="{{ route('boards.destroy', $board->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Are you sure you want to delete this board?')"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p>Tidak ada board yang ditemukan untuk proyek ini.</p>
                            @endforelse

                            <!-- Form untuk membuat Board baru -->
                            <div class="board-item"
                                style="margin-right: 10px; border-radius: 5px; padding: 10px; background-color: #f9f9f9; ">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample" style="min-width: 200px">
                                    Create Board
                                </button>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body" style="min-width: 300px">
                                        <form action="{{ route('boards.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="boardName"
                                                    name="board_name" value="{{ old('board_name') }}"
                                                    placeholder="Enter board name" required>
                                                <input type="hidden" id="projectIdInput" name="project_id"
                                                    value="{{ request('project_id') }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create Board</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Modal for Creating Task -->
                        <div class="modal fade" id="createTaskModal" tabindex="-1"
                            aria-labelledby="createModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModalLabel">Create Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('taskboards.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="taskName" class="form-label">Task Name</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}"
                                                    placeholder="Enter Task Name">
                                                @error('name')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" id="projectIdInput" name="project_id"
                                                    value="{{ request('project_id') }}">
                                            </div>
                                            <div class="">
                                                <input type="hidden" id="board_id_uhuy" name="board_id"
                                                    class="form-control" readonly>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create Task</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const selectElements = document.querySelectorAll('[id^="assignees"]');
                    const selectedAssigneesContainers = document.querySelectorAll('[id^="selected-assignees"]');

                    // Function to update selected assignees display for a specific pair of select and container
                    function updateSelectedAssignees(selectElement, selectedAssigneesContainer) {
                        const selectedOptions = Array.from(selectElement.selectedOptions);
                        selectedAssigneesContainer.innerHTML = '';

                        selectedOptions.forEach(option => {
                            const userId = option.value;
                            const userName = option.textContent;

                            const userDiv = document.createElement('div');
                            userDiv.classList.add('selected-user');
                            userDiv.dataset.id = userId;
                            userDiv.innerHTML = `
                            <span class="me-2">${userName}</span>
                            <button type="button" class="btn btn-sm btn-danger ms-2 remove-assignee" aria-label="Remove">x</button>
                        `;
                            selectedAssigneesContainer.appendChild(userDiv);
                        });
                    }

                    // Iterate over all select elements and attach event listeners
                    selectElements.forEach((selectElement, index) => {
                        const selectedAssigneesContainer = selectedAssigneesContainers[index];

                        // Event listener for when the select value changes
                        selectElement.addEventListener('change', function() {
                            updateSelectedAssignees(selectElement, selectedAssigneesContainer);
                        });

                        // Event delegation to handle removal of assignees
                        selectedAssigneesContainer.addEventListener('click', function(event) {
                            if (event.target.classList.contains('remove-assignee')) {
                                const userDiv = event.target.closest('.selected-user');
                                const userId = userDiv.dataset.id;

                                // Remove the user from the select
                                const optionToRemove = Array.from(selectElement.options).find(option =>
                                    option.value === userId);
                                if (optionToRemove) {
                                    optionToRemove.selected = false;
                                }

                                // Remove the user div from the display
                                userDiv.remove();
                            }
                        });

                        // Initialize display on page load
                        updateSelectedAssignees(selectElement, selectedAssigneesContainer);

                        // Ensure that changes in data after load are reflected in the UI
                        new MutationObserver(() => updateSelectedAssignees(selectElement,
                            selectedAssigneesContainer)).observe(selectElement, {
                            childList: true,
                            subtree: true,
                            attributes: true,
                            characterData: true
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.task-row').forEach(function(row) {
                        const taskId = row.dataset.taskId;
                        let startTime, elapsedTime = 0,
                            timerInterval;
                        const timeDisplay = document.getElementById(`time-display-${taskId}`);
                        const timeInput = document.getElementById(`time_count_${taskId}`);

                        function updateTimeDisplay(time) {
                            const hours = Math.floor(time / 3600000);
                            const minutes = Math.floor((time % 3600000) / 60000);
                            const seconds = Math.floor((time % 60000) / 1000);
                            timeDisplay.textContent =
                                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                            timeInput.value = timeDisplay.textContent;
                        }

                        function startStopwatch() {
                            startTime = Date.now() - elapsedTime;
                            timerInterval = setInterval(function() {
                                elapsedTime = Date.now() - startTime;
                                updateTimeDisplay(elapsedTime);
                            }, 1000);
                        }

                        function stopStopwatch() {
                            clearInterval(timerInterval);
                        }

                        function resetStopwatch() {
                            clearInterval(timerInterval);
                            elapsedTime = 0;
                            updateTimeDisplay(0);
                        }

                        document.getElementById(`start-stopwatch-${taskId}`).addEventListener('click', function() {
                            startStopwatch();
                            this.disabled = true;
                            document.getElementById(`stop-stopwatch-${taskId}`).disabled = false;
                            document.getElementById(`reset-stopwatch-${taskId}`).disabled = false;
                        });

                        document.getElementById(`stop-stopwatch-${taskId}`).addEventListener('click', function() {
                            stopStopwatch();
                            this.disabled = true;
                            document.getElementById(`start-stopwatch-${taskId}`).disabled = false;
                        });

                        document.getElementById(`reset-stopwatch-${taskId}`).addEventListener('click', function() {
                            resetStopwatch();
                            this.disabled = true;
                            document.getElementById(`start-stopwatch-${taskId}`).disabled = false;
                            document.getElementById(`stop-stopwatch-${taskId}`).disabled = true;
                        });

                        // Initialize with existing time count if any
                        if (timeInput.value !== '00:00:00') {
                            const timeParts = timeInput.value.split(':');
                            elapsedTime = (+timeParts[0]) * 3600000 + (+timeParts[1]) * 60000 + (+timeParts[2]) *
                                1000;
                            updateTimeDisplay(elapsedTime);
                        }
                    });
                });
            </script>
            <script>
                document.querySelectorAll('.create-task-btn').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var boardId = this.getAttribute('data-board-id');
                        document.getElementById('board_id_uhuy').value = boardId;
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const projectSelect = document.getElementById('projectSelect');
                    const projectIdInput = document.getElementById('projectIdInput');

                    projectSelect.addEventListener('change', function() {
                        projectIdInput.value = this.value;
                    });
                });
            </script>

</x-layout>
