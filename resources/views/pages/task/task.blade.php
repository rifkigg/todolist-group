<x-layout>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-navbar>
            <x-slot name="dashboard">
                <li class="nav-item ">
                    <a class="nav-link " href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
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
                            <a class="collapse-item active" href="{{ route('project.index') }}">Project</a>
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                        @else
                            <a class="collapse-item active" href="{{ route('project.index') }}">Project</a>
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                    aria-bs-expanded="true" aria-bs-controls="collapseThree">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Task</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if (auth()->user()->role == 'admin')
                            <a class="collapse-item active" href="{{ route('task.index') }}">Task</a>
                            <a class="collapse-item" href="{{ route('task_status.index') }}">Task Status</a>
                            <a class="collapse-item " href="{{ route('priorities.index') }}">Task Priorities</a>
                            <a class="collapse-item" href="{{ route('labels.index') }}">Task Labels/Tags</a>
                        @else
                            <a class="collapse-item active" href="{{ route('task.index') }}">Task</a>
                        @endif
                    </div>
                </div>
            </li>
        </x-navbar>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <x-navbar-topbar></x-navbar-topbar>
                <!-- Begin Page Content -->
                <div class="container text-dark">
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tasks</h6>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createTask">
                                    Create Data
                                </button>
                            @else
                            @endif
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Project Name</th>
                                        <th>Task Status</th>
                                        <th>Task Priority</th>
                                        <th>Due Date</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($task as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->project->name ?? ' ' }}</td>
                                            <td>{{ $item->status->name ?? ' ' }}</td>
                                            <td>{{ $item->priority->name ?? ' ' }}</td>
                                            <td>{{ $item->due_date ?? ' ' }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="d-flex flex-wrap">
                                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
                                                    <!-- Form untuk duplikasi -->
                                                    <form id="duplicate-form-{{ $item->id }}"
                                                        action="{{ route('task.duplicate', $item->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <!-- Ikon copy dengan event click -->
                                                    <a href="#" class="btn"
                                                        onclick="event.preventDefault(); document.getElementById('duplicate-form-{{ $item->id }}').submit();">
                                                        <i class="icon-action fa-solid fa-copy"></i>
                                                    </a>
                                                    <!-- Ikon view -->
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#view-{{ $item->id }}">
                                                        <i class="icon-action fa-solid fa-eye"></i>
                                                    </button>
                                                    <!-- Form untuk delete -->
                                                    <form action="{{ route('task.destroy', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn">
                                                            <i class="icon-action fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#view-{{ $item->id }}">
                                                        <i class="icon-action fa-solid fa-eye"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="createModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <form action="{{ route('task.update', $item->id) }}"
                                                        method="POST" enctype="multipart/form-data"
                                                        id="formUpdate-{{ $item->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title w-100" id="createModalLabel">
                                                                <input type="text" class="form-control border-0"
                                                                    id="name" name="name"
                                                                    value="{{ $item->name }}">
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-around">
                                                                <div style="width: 55%">
                                                                    <label for="description"
                                                                        class="form-label">Description</label>
                                                                    <textarea class="form-control mb-3" id="textarea1" name="description">{{ old('description', $item->description) }}</textarea>

                                                                    <label for="checklist"
                                                                        class="form-label">Checklist</label>
                                                                    <textarea class="form-control mb-3" id="textarea2" name="checklist">{{ old('checklist', $item->checklist) }}</textarea>

                                                                    <p for="attachments" class="form-label">Attachment
                                                                    </p>
                                                                    <div class="overflow-auto"
                                                                        style="max-height: 300px">
                                                                        @foreach ($item->attachments as $img)
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
                                                                    <div class="bg-secondary-subtle p-2 overflow-auto" style="max-height: 300px">
                                                                        @foreach ($item->activities as $act)
                                                                            <div class="p-2 rounded bg-light mb-2">
                                                                                <p class="m-0">{{ $act->activity }}</p>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                                <div style="width: 35%">
                                                                    <label for="board_id" class="form-label">Task
                                                                        Board</label>
                                                                    <select name="board_id" id="board_id"
                                                                        class="form-select mb-3">
                                                                        @foreach ($board as $items)
                                                                            <option value="{{ $items->id }}"
                                                                                {{ old('board_id', $item->board_id) == $items->id ? 'selected' : '' }}>
                                                                                {{ $items->board_name ?? ' ' }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="status_id" class="form-label">Task
                                                                        Status</label>
                                                                    <select name="status_id" id="status_id"
                                                                        class="form-select mb-3">
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
                                                                        class="form-select mb-3">
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
                                                                        class="form-select mb-3">
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
                                                                        class="form-select mb-3">
                                                                        @foreach ($project as $items)
                                                                            <option value="{{ $items->id }}"
                                                                                {{ old('project_id', $item->project_id) == $items->id ? 'selected' : '' }}>
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
                                                                                {{ in_array($user->id, old('assignees', $item->users->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                                {{ $user->username }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <!-- Tempat untuk menampilkan hasil pilihan -->
                                                                    <div id="selected-assignees">
                                                                        <p>Selected Assignees:</p>
                                                                        <ul
                                                                            class="d-flex flex-wrap gap-2 list-unstyled">
                                                                            @foreach ($item->users as $user)
                                                                                <li
                                                                                    class="d-flex align-items-center border rounded px-2 py-1">
                                                                                    {{ $user->username }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>


                                                                    <div class="task-row"
                                                                        data-task-id="{{ $item->id }}">
                                                                        <p for="time_count_{{ $item->id }}"
                                                                            class="form-label">Time Count</p>
                                                                        <div
                                                                            id="stopwatch-container-{{ $item->id }}">
                                                                            <span
                                                                                id="time-display-{{ $item->id }}"
                                                                                class="mb-3">
                                                                                {{ old('time_count', $item->time_count) }}
                                                                            </span>
                                                                            <br>
                                                                            <button type="button"
                                                                                id="start-stopwatch-{{ $item->id }}"
                                                                                class="btn btn-success">Start</button>
                                                                            <button type="button"
                                                                                id="stop-stopwatch-{{ $item->id }}"
                                                                                class="btn btn-danger"
                                                                                disabled>Stop</button>
                                                                            <button type="button"
                                                                                id="reset-stopwatch-{{ $item->id }}"
                                                                                class="btn btn-secondary"
                                                                                disabled>Reset</button>
                                                                        </div>
                                                                        <input type="hidden" name="time_count[]"
                                                                            id="time_count_{{ $item->id }}"
                                                                            value="{{ old('time_count', $item->time_count) }}">
                                                                    </div>
                                                                    <label for="due_date" class="form-label">Due
                                                                        Date</label>
                                                                    <input type="date" name="due_date"
                                                                        id="due_date" class="form-control mb-3"
                                                                        value="{{ old('due_date', $item->due_date) }}">


                                                                    <button type="button" class="btn btn-secondary"
                                                                        onclick="document.getElementById('file_name_{{ $item->id }}').click();">
                                                                        Attachment
                                                                    </button>


                                                                    {{-- tombol delete --}}
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="document.getElementById('deleteForm-{{ $item->id }}').submit();">
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
                                                                    value="{{ $item->id }}" hidden>
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
                                                    <button type="submit" class="btn btn-primary w-100"
                                                        onclick="document.getElementById('formUpdate-{{ $item->id }}').submit();">Save
                                                        and Close</button>

                                                    <form action="{{ route('task.destroy', $item->id) }}"
                                                        method="POST" class="d-none"
                                                        id="deleteForm-{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <form action="{{ route('attachments.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" name="task_id"
                                                            value="{{ $item->id }}" hidden>
                                                        <div>
                                                            <input type="file" name="file_name"
                                                                id="file_name_{{ $item->id }}"
                                                                class="form-control @error('file') is-invalid @enderror"
                                                                style="display: none;" onchange="this.form.submit();">
                                                            @error('file')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </form>

                                                    @foreach ($item->attachments as $img)
                                                        <div>
                                                            <form
                                                                action="{{ route('attachments.destroy', ['task_id' => $item->id, 'file_name' => $img->file_name]) }}"
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
                                            <td colspan="6" class="alert alert-danger">
                                                Data Project belum Tersedia.
                                            </td>
                                        </tr>

                                    @endforelse
                                    <div class="modal fade" id="createTask" tabindex="-1"
                                        aria-labelledby="createModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="createModalLabel">Create Data
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('task.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="field_name" class="form-label">
                                                                Task Name</label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" value="{{ old('name') }}"
                                                                placeholder="Enter Project Name">
                                                            @error('name')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="field_name" class="form-label">
                                                                Choose Project</label>
                                                            <select id="project_id" name="project_id"
                                                                class="form-control">
                                                                <option value="" selected>Choose Project:
                                                                </option>
                                                                @foreach ($project as $items)
                                                                    <option value="{{ $items->id }}">
                                                                        {{ $items->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="field_name" class="form-label">
                                                                Choose Board</label>
                                                            <select id="board_id" name="board_id"
                                                                class="form-control">
                                                                <option value="" selected>Choose Board:
                                                                </option>
                                                                @foreach ($board as $items)
                                                                    <option value="{{ $items->id }}">
                                                                        {{ $items->board_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Create
                                                            Task</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </tbody>
                            </table>
                        </div>
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

</x-layout>
