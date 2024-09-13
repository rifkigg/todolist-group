<x-layout>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-navbar>
            <x-slot name="dashboard">
                <li class="nav-item active">
                    <a class="nav-link active" href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
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
            @if (auth()->user()->role == 'admin')
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('manage_user.index') }}" aria-bs-expanded="true"
                        aria-bs-controls="collapseTwo">
                        <i class="fa-solid fa-users-gear"></i>
                        <span>Manage User</span>
                    </a>
                </li>
            @else
            @endif
        </x-navbar>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-navbar-topbar></x-navbar-topbar>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Projects</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_project }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-list-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Boards</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_board }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-display fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        {{ $total_task }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                People Involved</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_user }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            {{-- <i class="fas fa-comments fa-2x text-gray-300"></i> --}}
                                            <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="assignment">
                        <p>{{ $total_selesai }} / {{ $total_tasknya }}</p>
                        <p>{{ $format_persenan }} %</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Task to do</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->timer_status }}</td>
                                        <td>
                                            <button>Play</button>
                                            <button>Pause</button>
                                            <button>Stop</button>
                                            <button class="btn" data-bs-toggle="modal"
                                            data-bs-target="#view-{{ $task->id }}">Show</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="view-{{ $task->id }}" tabindex="-1"
                                        aria-labelledby="createModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title w-100" id="createModalLabel">
                                                        <input type="text" class="form-control border-0"
                                                            id="name" name="name"
                                                            value="{{ $task->name }}"
                                                            onchange="updateHiddenInput(this.value)">
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-around">
                                                        <div style="width: 55%">
                                                            @if ($task->description && count($task->description) > 0)
                                                                @foreach ($task->description as $desc)
                                                                    <form
                                                                        action="{{ route('description.update', $desc->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <label for="description"
                                                                            class="form-label">Description</label>
                                                                        <input type="text" name="task_id"
                                                                            value="{{ $task->id }}" hidden>
                                                                        <textarea class="form-control mb-3" id="textarea1" name="name" readonly>{{ old('name', $desc->name) }}</textarea>
                                                                    </form>
                                                                @endforeach
                                                            @else
                                                                <form
                                                                    action="{{ route('description.store', $task->id) }}"
                                                                    method="post" enctype="multipart/form-data"
                                                                    id="formAddDescription">
                                                                    @csrf
                                                                    <input type="text" name="task_id"
                                                                        value="{{ $task->id }}" hidden>
                                                                    <textarea class="form-control mb-3" id="textarea1" name="name" hidden></textarea>
                                                                    <div class="mb-3 d-flex justify-content-between">
                                                                        <p class="m-0">Description</p>
                                                                    </div>
                                                                </form>
                                                                <p>No description found.</p>
                                                            @endif

                                                            <div class="d-flex justify-content-between">
                                                                <label for="checklist"
                                                                    class="form-label">Checklist</label>
                                                            </div>

                                                            @if ($task->checklist && count($task->checklist) > 0)
                                                                <div class="my-3 bg-secondary-subtle p-2 overflow-auto rounded"
                                                                    style="max-height: 300px">
                                                                    <form action="{{ route('update.completed') }}"
                                                                        method="POST" id="formChecklist">
                                                                        @foreach ($task->checklist as $gg)
                                                                            @csrf
                                                                            <div
                                                                                class="d-flex align-items-center justify-content-between p-2 rounded bg-light mb-2">
                                                                                <div class="d-flex gap-1">
                                                                                    <input type="hidden"
                                                                                        name="checklist[{{ $gg->id }}]"
                                                                                        value="0">
                                                                                    <input type="checkbox"
                                                                                        name="checklist[{{ $gg->id }}]]"
                                                                                        value="1" class="m-0"
                                                                                        id="checkbox-{{ $gg->id }}"
                                                                                        {{ $gg->completed == 1 ? 'checked' : '' }}
                                                                                        onchange="toggleLineThrough({{ $gg->id }})">
                                                                                    <span
                                                                                        id="text-{{ $gg->id }}"
                                                                                        class="{{ $gg->completed == 1 ? 'text-decoration-line-through' : '' }} ">
                                                                                        {{ $gg->name }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </form>
                                                                    @foreach ($task->checklist as $check)
                                                                        <form
                                                                            action="{{ route('checklist.destroy', $check->id) }}"
                                                                            method="POST" class="d-inline"
                                                                            id="deleteChecklist_{{ $check->id }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    @endforeach
                                                                    <button type="submit"
                                                                        class="btn btn-primary mt-2"
                                                                        onclick="event.preventDefault(); document.getElementById('formChecklist').submit();">Save
                                                                        All</button>
                                                                </div>
                                                            @else
                                                                <p>No checklist items found.</p>
                                                            @endif


                                                            <p for="attachments" class="form-label">Attachment
                                                            </p>
                                                            <div class="overflow-auto" style="max-height: 300px">
                                                                @if ($task->attachments && count($task->attachments) > 0)
                                                                    @foreach ($task->attachments as $img)
                                                                        <div
                                                                            class="mb-3 d-flex align-items-start gap-2">
                                                                            <a
                                                                                href="{{ asset('storage/attachments/' . $img->file_name) }}">
                                                                                <img src="{{ asset('storage/attachments/' . $img->file_name) }}"
                                                                                    alt="{{ $img->file_name }}"
                                                                                    width="150">
                                                                            </a>
                                                                            <div
                                                                                class="d-flex justify-content-between w-100">
                                                                                <p>Created at:
                                                                                    {{ $img->created_at }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <p>No attachments found.</p>
                                                                @endif
                                                            </div>

                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-3">
                                                                <p for="activities" class="form-label">
                                                                    Activities
                                                                </p>

                                                            </div>
                                                            @if ($task->activities && count($task->activities) > 0)
                                                                <div class="bg-secondary-subtle rounded p-2 overflow-auto "
                                                                    style="max-height: 300px">
                                                                    @foreach ($task->activities as $act)
                                                                        <div class="p-2 rounded bg-light mb-2">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-baseline">
                                                                                <p class="m-0 fw-bold">
                                                                                    {{ $act->username }}</p>
                                                                                <p class="m-0"
                                                                                    style="font-size: 0.8rem">
                                                                                    {{ $act->created_at }}</p>
                                                                            </div>
                                                                            <p class="m-0">
                                                                                {{ $act->activity }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <p>No activities found.</p>
                                                            @endif
                                                            <div class="collapse mt-3" id="collapseExample">
                                                                <form action="{{ route('activity.store') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="task_id"
                                                                        value="{{ $task->id }}" hidden>
                                                                    <input type="hidden" name="username"
                                                                        value="{{ Auth::user()->username }}" hidden>
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

                                                        {{-- uhuy --}}

                                                        <div style="width: 35%">
                                                            <form action="{{ route('task.update', $task->id) }}"
                                                                method="POST" enctype="multipart/form-data"
                                                                id="formUpdate-{{ $task->id }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="text" class="form-control border-0"
                                                                    id="hiddenName" name="name"
                                                                    value="{{ $task->name }}" hidden>

                                                                <label for="board_id" class="form-label">Task
                                                                    Board</label>
                                                                <select name="board_id" id="board_id"
                                                                    class="form-select mb-3" disabled>
                                                                    @foreach ($board as $items)
                                                                        <option value="{{ $items->id }}"
                                                                            {{ old('board_id', $task->board_id) == $items->id ? 'selected' : '' }}>
                                                                            {{ $items->board_name ?? ' ' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="status_id" class="form-label">Task
                                                                    Status</label>
                                                                <select name="status_id" id="status_id"
                                                                    class="form-select mb-3" disabled>
                                                                    @foreach ($status as $items)
                                                                        <option value="{{ $items->id }}"
                                                                            {{ old('status_id', $item->status_id) == $items->id ? 'selected' : '' }}>
                                                                            {{ $items->name ?? ' ' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="priority_id" class="form-label">Task
                                                                    Priority</label>
                                                                <select name="priority_id" id="priority_id"
                                                                    class="form-select mb-3" disabled>
                                                                    @foreach ($priority as $items)
                                                                        <option value="{{ $items->id }}"
                                                                            {{ old('priority_id', $item->priority_id) == $items->id ? 'selected' : '' }}>
                                                                            {{ $items->name ?? ' ' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="task_label_id" class="form-label">Task
                                                                    Label</label>
                                                                <select name="task_label_id" id="task_label_id"
                                                                    class="form-select mb-3" disabled>
                                                                    @foreach ($label as $items)
                                                                        <option value="{{ $items->id }}"
                                                                            {{ old('task_label_id', $item->task_label_id) == $items->id ? 'selected' : '' }}>
                                                                            {{ $items->name ?? ' ' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="project_id" class="form-label">Task
                                                                    Project</label>
                                                                <select name="project_id" id="project_id"
                                                                    class="form-select mb-3" disabled>
                                                                    @foreach ($project as $items)
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
                                                                    class="form-select mb-3" multiple disabled>
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
                                                                    <ul class="d-flex flex-wrap gap-2 list-unstyled">
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
                                                                    <div id="stopwatch-container-{{ $task->id }}">
                                                                        <span id="time-display-{{ $task->id }}"
                                                                            class="mb-3">
                                                                            {{ old('time_count', $task->time_count) }}
                                                                        </span>
                                                                    </div>
                                                                    <input type="hidden" name="time_count[]"
                                                                        id="time_count_{{ $task->id }}"
                                                                        value="{{ is_array(old('time_count', $task->time_count)) ? implode(',', old('time_count', $task->time_count)) : old('time_count', $task->time_count) }}">

                                                                </div>
                                                                <label for="due_date" class="form-label">Due
                                                                    Date</label>
                                                                <input type="date" name="due_date" id="due_date"
                                                                    class="form-control mb-3"
                                                                    value="{{ old('due_date', $task->due_date) }}"
                                                                    disabled>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ route('task.destroy', $task->id) }}" method="POST"
                                                    class="d-none" id="deleteForm-{{ $task->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <form action="{{ route('attachments.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="text" name="task_id" value="{{ $task->id }}"
                                                        hidden>
                                                    <div>
                                                        <input type="file" name="file_name"
                                                            id="file_name_{{ $task->id }}"
                                                            class="form-control @error('file') is-invalid @enderror"
                                                            style="display: none;" onchange="this.form.submit();">
                                                        @error('file')
                                                            <div class="alert alert-danger">{{ $message }}
                                                            </div>
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
                                    <tr>
                                        <td colspan="2" class="text-center">No tasks assigned to you.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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
                        userDiv.classList.add('selected-user','mb-2' ,'p-2', 'rounded', 'd-flex', 'justify-content-between', 'align-items-center', 'bg-secondary', 'text-white');
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
            function updateHiddenInput(value) {
                // Mengupdate nilai dari input hidden dengan nilai yang diubah
                document.getElementById('hiddenName').value = value;
            }
        </script>
        <script>
            function toggleLineThrough(id) {
                const checkbox = document.getElementById('checkbox-' + id);
                const text = document.getElementById('text-' + id);

                if (checkbox.checked) {
                    text.classList.add('text-decoration-line-through');
                } else {
                    text.classList.remove('text-decoration-line-through');
                }
            }
        </script>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var fragment = window.location.hash; // Mendapatkan fragment dari URL
        
                        if (fragment && fragment.startsWith('#view-')) {
                            var modalId = fragment.replace('#', ''); // Menghapus '#' dari fragment
                            var modalElement = document.getElementById(modalId); // Mendapatkan elemen modal berdasarkan ID
        
                            if (modalElement) {
                                var modalInstance = new bootstrap.Modal(modalElement);
                                modalInstance.show(); // Membuka modal
                            }
                        }
                    });
                </script>
</x-layout>
