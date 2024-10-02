<x-layout>
    <div id="wrapper" style="overflow: hidden;">
        <x-navbar>
            <x-slot name="dashboard">
                @if (auth()->user()->role && in_array('viewDashboard', auth()->user()->role->permissions->pluck('name')->toArray()))
                    <li class="nav-item ">
                        <a class="nav-link " href="/dashboard">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                @else
                @endif
                @if (auth()->user()->role && in_array('viewOnGoing', auth()->user()->role->permissions->pluck('name')->toArray()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ongoing.index') }}" aria-bs-expanded="true"
                            aria-bs-controls="collapseTwo">
                            <i class="fa-solid fa-hourglass-half"></i>
                            <span>On Going</span>
                        </a>
                    </li>
                @else
                @endif

            </x-slot>
            @if (auth()->user()->role && in_array('viewBoard', auth()->user()->role->permissions->pluck('name')->toArray()))
                <li class="nav-item">
                    <a class="nav-link " href="/boards">
                        <i class="fa-solid fa-chess-board"></i>
                        <span>Boards</span>
                    </a>
                </li>
            @else
            @endif


            @if (auth()->user()->role && in_array('viewProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                        aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Project</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                            @if (auth()->user()->role && in_array('addProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                            @else
                            @endif
                            @if (auth()->user()->role &&
                                    in_array('viewProjectCategories', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item " href="{{ route('projectcategories.index') }}">Categories</a>
                            @else
                            @endif
                            @if (auth()->user()->role && in_array('viewProjectStatus', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item" href="{{ route('project_status.index') }}">Project Status</a>
                            @else
                            @endif
                        </div>
                    </div>
                </li>
            @else
            @endif
            @if (auth()->user()->role && in_array('viewTask', auth()->user()->role->permissions->pluck('name')->toArray()))
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                        <i class="fas fa-clipboard-list "></i>
                        <span>Task</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @if (auth()->user()->role && in_array('viewTask', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item " href="{{ route('task.index') }}">Task</a>
                            @else
                            @endif
                            @if (auth()->user()->role && in_array('viewTaskStatus', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item" href="{{ route('task_status.index') }}">Task Status</a>
                            @else
                            @endif
                            @if (auth()->user()->role && in_array('viewTaskPriorities', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item " href="{{ route('priorities.index') }}">Task Priorities</a>
                            @else
                            @endif
                            @if (auth()->user()->role && in_array('viewTaskLabels', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item" href="{{ route('labels.index') }}">Task Labels/Tags</a>
                            @else
                            @endif
                        </div>
                    </div>
                </li>
            @else
            @endif
            @if (auth()->user()->role && in_array('viewManageUser', auth()->user()->role->permissions->pluck('name')->toArray()))
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseManageUser" aria-bs-expanded="true"
                        aria-bs-controls="collapseManageUser">
                        <i class="fa-solid fa-users-gear"></i>
                        <span>Manage User</span>
                    </a>
                    <div id="collapseManageUser" class="collapse" aria-labelledby="collapseManageUser"
                        data-bs-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @if (auth()->user()->role && in_array('viewManageUser', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item" href="{{ route('manage_user.index') }}">Manage User</a>
                            @else
                            @endif
                            @if (auth()->user()->role && in_array('viewRole', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item" href="{{ route('roles.index') }}">Add Role</a>
                            @else
                            @endif
                            @if (auth()->user()->role && in_array('viewPermission', auth()->user()->role->permissions->pluck('name')->toArray()))
                            <a class="collapse-item" href="{{ route('permissions.index') }}">Permission</a>
                        @else
                        @endif
                        </div>
                    </div>
                </li>
            @else
            @endif
        </x-navbar>

        <!-- Content Wrapper -->
        <div id="content-wrapper" style="overflow: hidden;">
            <!-- Main Content -->
            <div id="content" style="overflow: hidden;">
                <x-navbar-topbar></x-navbar-topbar>

                <!-- Begin Page Content -->
                <div class="container-fluid text-dark">
                    <!-- Content Row -->
                    <button onclick="history.back()" class="btn btn-primary w-auto mb-3"><i
                            class="fa-solid fa-left-long"></i> Back</button>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Task Dari Project {{ $projects->name }}</h6>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Project Name</th>
                                        <th>Task Status</th>
                                        <th>Task Priority</th>
                                        <th>Pogress Status</th>
                                        <th>Due Date</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tasks as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->project->name }}</td>
                                            <td>{{ $item->status->name ?? ' ' }}</td>
                                            <td title="{{ $item->priority->name ?? ' ' }}" style="">{{ $item->priority->icon ?? ' ' }}</td>
                                            <td>
                                                @if ($item->timer_status == 'Paused')
                                                    <p class="badge bg-secondary">Paused</p>
                                                @elseif ($item->timer_status == 'Playing')
                                                    <p class="badge bg-warning">Playing</p>
                                                @else
                                                    <p class="badge bg-success">Finished</p>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->due_date)->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>{{ $item->created_by ?? ' ' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis fa-2xl"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton">

                                                            @if (auth()->user()->role == 'admin' ||
                                                                    auth()->user()->role == 'manajer' ||
                                                                    auth()->user()->username == $item->created_by)
                                                                <!-- Form untuk duplikasi -->
                                                                <form id="duplicate-form-{{ $item->id }}"
                                                                    action="{{ route('task.duplicate', $item->id) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                                <li>

                                                                    <!-- Ikon copy dengan event click -->
                                                                    <a href="#" class="btn dropdown-item"
                                                                    onclick="event.preventDefault(); document.getElementById('duplicate-form-{{ $item->id }}').submit();">
                                                                    <i class="icon-action fa-solid fa-copy"></i> Duplicate Task
                                                                </a>
                                                            </li>
                                                            <li>

                                                                <!-- Ikon view -->
                                                                <button type="button" class="btn dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#view-{{ $item->id }}">
                                                                <i class="fa-solid fa-pen-to-square"></i> Edit Task
                                                                </button>
                                                            </li>
                                                            <li>

                                                                <a href="#" class="btn dropdown-item" onclick="event.preventDefault(); alert('Are you sure you want to delete this task?'); document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                                    <i class="icon-action fa-solid fa-trash-can"></i> Delete Task
                                                                </a>
                                                            </li>
                                                                <!-- Form untuk delete -->
                                                                <form action="{{ route('task.destroy', $item->id) }}"
                                                                    method="POST"
                                                                    id="delete-form-{{ $item->id }}"
                                                                    onsubmit="return confirm('Are you sure you want to delete this task?');"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            @else
                                                                @if (auth()->user()->id == $item->created_by)
                                                                <li>

                                                                    <button type="button" class="btn dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view-{{ $item->id }}">
                                                                    <i class="icon-action fa-solid fa-eye"></i> Show Task
                                                                </button>
                                                            </li>
                                                                @else
                                                                @endif
                                                                <li>

                                                                    <button type="button" class="btn dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#view-{{ $item->id }}">
                                                                    <i class="icon-action fa-solid fa-eye"></i> Show Task
                                                                </button>
                                                            </li>
                                                                @endif
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        @if (auth()->user()->role == 'admin' ||
                                                auth()->user()->role == 'manajer' ||
                                                auth()->user()->username == $item->created_by)
                                            <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="createModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title w-100" id="createModalLabel">
                                                                <input type="text"
                                                                    class="name form-control border-0"
                                                                    id="name-{{ $item->id }}" name="name"
                                                                    value="{{ $item->name }}"
                                                                    onchange="updateHiddenInput(this.value, '{{ $item->id }}')">
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-around">
                                                                <div style="width: 55%">
                                                                    @if ($item->description && count($item->description) > 0)
                                                                        @foreach ($item->description as $desc)
                                                                            <form
                                                                                action="{{ route('description.update', $desc->id) }}"
                                                                                method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <label for="description"
                                                                                    class="form-label">Description</label>
                                                                                <input type="text" name="task_id"
                                                                                    value="{{ $item->id }}"
                                                                                    hidden>
                                                                                <textarea class="form-control mb-3" id="textarea1" name="name">{{ old('name', $desc->name) }}</textarea>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary btn-sm mb-3">Save
                                                                                    Changes</button>
                                                                            </form>
                                                                        @endforeach
                                                                    @else
                                                                        <form
                                                                            action="{{ route('description.store', $item->id) }}"
                                                                            method="post"
                                                                            enctype="multipart/form-data"
                                                                            id="formAddDescription">
                                                                            @csrf
                                                                            <input type="text" name="task_id"
                                                                                value="{{ $item->id }}" hidden>
                                                                            <textarea class="form-control mb-3" id="textarea1" name="name" hidden></textarea>
                                                                            <div
                                                                                class="mb-3 d-flex justify-content-between">
                                                                                <p class="m-0">Description</p>
                                                                                <button type="submit"
                                                                                    class="btn btn-success btn-sm"><i
                                                                                        class="fa-solid fa-plus"></i>
                                                                                    Add
                                                                                    Description</button>
                                                                            </div>
                                                                        </form>
                                                                        <p>No description found.</p>
                                                                    @endif

                                                                    <div class="d-flex justify-content-between">
                                                                        <label for="checklist"
                                                                            class="form-label">Checklist</label>
                                                                        <button class="btn btn-success btn-sm"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseChecklist"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseChecklist">
                                                                            <i class="fa-solid fa-plus"></i> Add
                                                                            Checklist
                                                                        </button>
                                                                    </div>

                                                                    @if ($item->checklist && count($item->checklist) > 0)
                                                                        <div class="my-3 bg-secondary-subtle p-2 overflow-auto rounded"
                                                                            style="max-height: 300px">
                                                                            <form
                                                                                action="{{ route('update.completed') }}"
                                                                                method="POST" id="formChecklist">
                                                                                @foreach ($item->checklist as $gg)
                                                                                    @csrf
                                                                                    <div
                                                                                        class="d-flex align-items-center justify-content-between p-2 rounded bg-light mb-2">
                                                                                        <div class="d-flex gap-1">
                                                                                            <input type="hidden"
                                                                                                name="checklist[{{ $gg->id }}]"
                                                                                                value="0">
                                                                                            <input type="checkbox"
                                                                                                name="checklist[{{ $gg->id }}]]"
                                                                                                value="1"
                                                                                                class="m-0"
                                                                                                id="checkbox-{{ $gg->id }}"
                                                                                                {{ $gg->completed == 1 ? 'checked' : '' }}
                                                                                                onchange="toggleLineThrough({{ $gg->id }})">
                                                                                            <span
                                                                                                id="text-{{ $gg->id }}"
                                                                                                class="{{ $gg->completed == 1 ? 'text-decoration-line-through' : '' }} ">
                                                                                                {{ $gg->name }}
                                                                                            </span>
                                                                                        </div>
                                                                                        <button type="button"
                                                                                            class="btn btn-danger btn-sm"
                                                                                            onclick="event.preventDefault(); alert('Are you sure you want to delete this checklist item?'); document.getElementById('deleteChecklist_{{ $gg->id }}').submit();">
                                                                                            <i
                                                                                                class="fa-solid fa-trash"></i>
                                                                                        </button>

                                                                                    </div>
                                                                                @endforeach
                                                                            </form>
                                                                            @foreach ($item->checklist as $check)
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

                                                                    <div class="collapse my-3" id="collapseChecklist">
                                                                        <form action="{{ route('checklist.store') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="task_id"
                                                                                value="{{ $item->id }}" hidden>
                                                                            <textarea class="form-control mb-3" id="focusedInput" name="name" placeholder="Add Checklist"></textarea>
                                                                            @error('name')
                                                                                <div class="alert alert-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Add
                                                                                Checklist</button>
                                                                        </form>
                                                                    </div>

                                                                    <p for="attachments" class="form-label">Attachment
                                                                    </p>
                                                                    <div class="overflow-auto"
                                                                        style="max-height: 300px">
                                                                        @if ($item->attachments && count($item->attachments) > 0)
                                                                            @foreach ($item->attachments as $img)
                                                                                <div
                                                                                    class="mb-3 d-flex align-items-start justify-content-between">
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $img->file_name))
                                                                                            <a
                                                                                                href="{{ asset('storage/attachments/' . $img->file_name) }}">
                                                                                                <img src="{{ asset('storage/attachments/' . $img->file_name) }}"
                                                                                                    alt="{{ $img->file_name }}"
                                                                                                    width="150">
                                                                                            </a>
                                                                                        @else
                                                                                            <a
                                                                                                href="{{ asset('storage/attachments/' . $img->file_name) }}">
                                                                                                <div class="file-icon d-flex flex-column justify-content-center align-items-center text-dark"
                                                                                                    style="width: 150px ;height: 100px">
                                                                                                    <i
                                                                                                        class="fa-solid fa-file fs-1"></i>
                                                                                                    <p>{{ $img->file_name }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </a>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="ms-auto">
                                                                                        <button
                                                                                            class="btn btn-danger btn-sm"
                                                                                            onclick="if(confirm('Are you sure you want to delete this attachment?')) { document.getElementById('deleteGambar-{{ $img->id }}').submit(); }">
                                                                                            <i
                                                                                                class="fa-solid fa-trash"></i>
                                                                                        </button>
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
                                                                        <button class="btn btn-success btn-sm"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseExample"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseExample">
                                                                            <i class="fa-solid fa-plus"></i> Add
                                                                            Activities
                                                                        </button>

                                                                    </div>
                                                                    @if ($item->activities && count($item->activities) > 0)
                                                                        <div class="bg-secondary-subtle rounded p-2 overflow-auto "
                                                                            style="max-height: 300px">
                                                                            @foreach ($item->activities as $act)
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
                                                                                value="{{ $item->id }}" hidden>
                                                                            <input type="hidden" name="username"
                                                                                value="{{ Auth::user()->username }}"
                                                                                hidden>
                                                                            <textarea class="form-control mb-3" id="focusedInput" name="activity" placeholder="Add Activity"></textarea>
                                                                            @error('activity')
                                                                                <div class="alert alert-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Add
                                                                                Activity</button>
                                                                        </form>

                                                                    </div>
                                                                </div>

                                                                {{-- uhuy --}}

                                                                <div style="width: 35%">
                                                                    <form
                                                                        action="{{ route('task.update', $item->id) }}"
                                                                        method="POST" enctype="multipart/form-data"
                                                                        id="formUpdate-{{ $item->id }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden"
                                                                            id="hiddenName-{{ $item->id }}"
                                                                            name="name"
                                                                            value="{{ $item->name }}">

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

                                                                        <label for="priority_id"
                                                                            class="form-label">Task
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

                                                                        <label for="task_label_id"
                                                                            class="form-label">Task
                                                                            Label</label>
                                                                        <select name="task_label_id"
                                                                            id="task_label_id"
                                                                            class="form-select mb-3">
                                                                            @foreach ($label as $items)
                                                                                <option value="{{ $items->id }}"
                                                                                    {{ old('task_label_id', $item->task_label_id) == $items->id ? 'selected' : '' }}>
                                                                                    {{ $items->name ?? ' ' }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                        <label for="project_id"
                                                                            class="form-label">Task
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
                                                                            class="form-select mb-3">

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


                                                                        @php
                                                                            $taskTime = $tasksWithTime->firstWhere(
                                                                                'id',
                                                                                $item->id,
                                                                            );
                                                                        @endphp
                                                                        <div class="task-row"
                                                                            data-task-id="{{ $item->id }}">
                                                                            <p for="time_count_{{ $item->id }}"
                                                                                class="form-label">Time Count</p>
                                                                            @php
                                                                                $totalSeconds = $taskTime
                                                                                    ? $taskTime->totalTime
                                                                                    : $item->time_count; // Total waktu dalam detik
                                                                                $hours = floor($totalSeconds / 3600); // Hitung jam
                                                                                $minutes = floor(
                                                                                    ($totalSeconds % 3600) / 60,
                                                                                ); // Hitung menit
                                                                                $seconds = $totalSeconds % 60; // Hitung detik
                                                                            @endphp
                                                                            <p>{{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
                                                                            </p>
                                                                        </div>
                                                                        <label for="due_date" class="form-label">Due
                                                                            Date</label>
                                                                        <input type="datetime-local" name="due_date"
                                                                            id="due_date" class="form-control mb-3"
                                                                            value="{{ old('due_date', $item->due_date) }}">


                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            onclick="document.getElementById('file_name_{{ $item->id }}').click();">
                                                                            Attachment
                                                                        </button>


                                                                        {{-- tombol delete --}}
                                                                        <button type="button" class="btn btn-danger"
                                                                            onclick="document.getElementById('deleteForm-{{ $item->id }}').submit();">
                                                                            Delete
                                                                        </button>

                                                                        <button id="editButton-{{ $item->id }}"
                                                                            type="button"
                                                                            onclick="focusInput('{{ $item->id }}')"
                                                                            class="btn btn-success">
                                                                            Edit Task Name
                                                                        </button>
                                                                    </form>
                                                                </div>
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

                                                        <form action="{{ route('attachments.store') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="text" name="task_id"
                                                                value="{{ $item->id }}" hidden>
                                                            <div>
                                                                <input type="file" name="file_name"
                                                                    id="file_name_{{ $item->id }}"
                                                                    class="form-control @error('file') is-invalid @enderror"
                                                                    style="display: none;"
                                                                    onchange="this.form.submit();">
                                                                @error('file')
                                                                    <div class="alert alert-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </form>

                                                        @foreach ($item->attachments as $img)
                                                            <div>
                                                                <form
                                                                    action="{{ route('attachments.destroy', ['task_id' => $item->id, 'file_name' => $img->file_name]) }}"
                                                                    method="POST"
                                                                    id="deleteGambar-{{ $img->id }}"
                                                                    onsubmit="return confirm('Are you sure you want to delete this attachment?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="createModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title w-100" id="createModalLabel">
                                                                <input type="text" class="form-control border-0"
                                                                    id="name" name="name"
                                                                    value="{{ $item->name }}"
                                                                    onchange="updateHiddenInput(this.value)" disabled>
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-around">
                                                                <div style="width: 55%">
                                                                    @if ($item->description && count($item->description) > 0)
                                                                        @foreach ($item->description as $desc)
                                                                            <form
                                                                                action="{{ route('description.update', $desc->id) }}"
                                                                                method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <label for="description"
                                                                                    class="form-label">Description</label>
                                                                                <input type="text" name="task_id"
                                                                                    value="{{ $item->id }}"
                                                                                    hidden>
                                                                                <textarea class="form-control mb-3" id="textarea1" name="name" readonly>{{ old('name', $desc->name) }}</textarea>
                                                                            </form>
                                                                        @endforeach
                                                                    @else
                                                                        <form
                                                                            action="{{ route('description.store', $item->id) }}"
                                                                            method="post"
                                                                            enctype="multipart/form-data"
                                                                            id="formAddDescription">
                                                                            @csrf
                                                                            <input type="text" name="task_id"
                                                                                value="{{ $item->id }}" hidden>
                                                                            <textarea class="form-control mb-3" id="textarea1" name="name" hidden></textarea>
                                                                            <div
                                                                                class="mb-3 d-flex justify-content-between">
                                                                                <p class="m-0">Description</p>
                                                                            </div>
                                                                        </form>
                                                                        <p>No description found.</p>
                                                                    @endif

                                                                    <div class="d-flex justify-content-between">
                                                                        <label for="checklist"
                                                                            class="form-label">Checklist</label>
                                                                    </div>

                                                                    @if ($item->checklist && count($item->checklist) > 0)
                                                                        <div class="my-3 bg-secondary-subtle p-2 overflow-auto rounded"
                                                                            style="max-height: 300px">
                                                                            <form
                                                                                action="{{ route('update.completed') }}"
                                                                                method="POST" id="formChecklist">
                                                                                @foreach ($item->checklist as $gg)
                                                                                    @csrf
                                                                                    <div
                                                                                        class="d-flex align-items-center justify-content-between p-2 rounded bg-light mb-2">
                                                                                        <div class="d-flex gap-1">
                                                                                            <input type="hidden"
                                                                                                name="checklist[{{ $gg->id }}]"
                                                                                                value="0">
                                                                                            <input type="checkbox"
                                                                                                name="checklist[{{ $gg->id }}]]"
                                                                                                value="1"
                                                                                                class="m-0"
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
                                                                            @foreach ($item->checklist as $check)
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
                                                                    <div class="overflow-auto"
                                                                        style="max-height: 300px">
                                                                        @if ($item->attachments && count($item->attachments) > 0)
                                                                            @foreach ($item->attachments as $img)
                                                                                <div
                                                                                    class="mb-3 d-flex align-items-start justify-content-between">
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $img->file_name))
                                                                                            <a
                                                                                                href="{{ asset('storage/attachments/' . $img->file_name) }}">
                                                                                                <img src="{{ asset('storage/attachments/' . $img->file_name) }}"
                                                                                                    alt="{{ $img->file_name }}"
                                                                                                    width="150">
                                                                                            </a>
                                                                                        @else
                                                                                            <a
                                                                                                href="{{ asset('storage/attachments/' . $img->file_name) }}">
                                                                                                <div class="file-icon d-flex flex-column justify-content-center align-items-center text-dark"
                                                                                                    style="width: 150px ;height: 100px">
                                                                                                    <i
                                                                                                        class="fa-solid fa-file fs-1"></i>
                                                                                                    <p>{{ $img->file_name }}
                                                                                                    </p>
                                                                                                </div>
                                                                                            </a>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="ms-auto">
                                                                                        <button
                                                                                            class="btn btn-danger btn-sm"
                                                                                            onclick="if(confirm('Are you sure you want to delete this attachment?')) { document.getElementById('deleteGambar-{{ $img->id }}').submit(); }">
                                                                                            <i
                                                                                                class="fa-solid fa-trash"></i>
                                                                                        </button>
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
                                                                    @if ($item->activities && count($item->activities) > 0)
                                                                        <div class="bg-secondary-subtle rounded p-2 overflow-auto "
                                                                            style="max-height: 300px">
                                                                            @foreach ($item->activities as $act)
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
                                                                                value="{{ $item->id }}" hidden>
                                                                            <input type="hidden" name="username"
                                                                                value="{{ Auth::user()->username }}"
                                                                                hidden>
                                                                            <textarea class="form-control mb-3" id="focusedInput" name="activity" placeholder="Add Activity"></textarea>
                                                                            @error('activity')
                                                                                <div class="alert alert-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Add
                                                                                Activity</button>
                                                                        </form>

                                                                    </div>
                                                                </div>

                                                                {{-- uhuy --}}

                                                                <div style="width: 35%">
                                                                    <form
                                                                        action="{{ route('task.update', $item->id) }}"
                                                                        method="POST" enctype="multipart/form-data"
                                                                        id="formUpdate-{{ $item->id }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="text"
                                                                            class="form-control border-0"
                                                                            id="hiddenName" name="name"
                                                                            value="{{ $item->name }}" hidden>

                                                                        <label for="board_id" class="form-label">Task
                                                                            Board</label>
                                                                        <select name="board_id" id="board_id"
                                                                            class="form-select mb-3" disabled>
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
                                                                            class="form-select mb-3" disabled>
                                                                            @foreach ($status as $items)
                                                                                <option value="{{ $items->id }}"
                                                                                    {{ old('status_id', $item->status_id) == $items->id ? 'selected' : '' }}>
                                                                                    {{ $items->name ?? ' ' }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                        <label for="priority_id"
                                                                            class="form-label">Task
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

                                                                        <label for="task_label_id"
                                                                            class="form-label">Task
                                                                            Label</label>
                                                                        <select name="task_label_id"
                                                                            id="task_label_id"
                                                                            class="form-select mb-3" disabled>
                                                                            @foreach ($label as $items)
                                                                                <option value="{{ $items->id }}"
                                                                                    {{ old('task_label_id', $item->task_label_id) == $items->id ? 'selected' : '' }}>
                                                                                    {{ $items->name ?? ' ' }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                        <label for="project_id"
                                                                            class="form-label">Task
                                                                            Project</label>
                                                                        <select name="project_id" id="project_id"
                                                                            class="form-select mb-3" disabled>
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
                                                                            class="form-select mb-3" disabled>
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

                                                                        @php
                                                                            $taskTime = $tasksWithTime->firstWhere(
                                                                                'id',
                                                                                $item->id,
                                                                            );
                                                                        @endphp
                                                                        <div class="task-row"
                                                                            data-task-id="{{ $item->id }}">
                                                                            <p for="time_count_{{ $item->id }}"
                                                                                class="form-label">Time Count</p>
                                                                            @php
                                                                                $totalSeconds = $taskTime
                                                                                    ? $taskTime->totalTime
                                                                                    : $item->time_count; // Total waktu dalam detik
                                                                                $hours = floor($totalSeconds / 3600); // Hitung jam
                                                                                $minutes = floor(
                                                                                    ($totalSeconds % 3600) / 60,
                                                                                ); // Hitung menit
                                                                                $seconds = $totalSeconds % 60; // Hitung detik
                                                                            @endphp
                                                                            <p>{{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
                                                                            </p>
                                                                        </div>
                                                                        <label for="due_date" class="form-label">Due
                                                                            Date</label>
                                                                        <input type="datetime-local" name="due_date"
                                                                            id="due_date" class="form-control mb-3"
                                                                            value="{{ old('due_date', $item->due_date) }}"
                                                                            disabled>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <form action="{{ route('task.destroy', $item->id) }}"
                                                            method="POST" class="d-none"
                                                            id="deleteForm-{{ $item->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <form action="{{ route('attachments.store') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="text" name="task_id"
                                                                value="{{ $item->id }}" hidden>
                                                            <div>
                                                                <input type="file" name="file_name"
                                                                    id="file_name_{{ $item->id }}"
                                                                    class="form-control @error('file') is-invalid @enderror"
                                                                    style="display: none;"
                                                                    onchange="this.form.submit();">
                                                                @error('file')
                                                                    <div class="alert alert-danger">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </form>

                                                        @foreach ($item->attachments as $img)
                                                            <div>
                                                                <form
                                                                    action="{{ route('attachments.destroy', ['task_id' => $item->id, 'file_name' => $img->file_name]) }}"
                                                                    method="POST"
                                                                    id="deleteGambar-{{ $img->id }}"
                                                                    onsubmit="return confirm('Are you sure you want to delete this attachment?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="8" class="alert alert-danger">No tasks available for this
                                                project.</td>
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
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
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
                                userDiv.classList.add('selected-user', 'mb-2', 'p-2', 'rounded', 'd-flex',
                                    'justify-content-between', 'align-items-center', 'bg-secondary', 'text-white');
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
            @else
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
                                userDiv.classList.add('selected-user', 'mb-2', 'p-2', 'rounded', 'd-flex',
                                    'justify-content-between', 'align-items-center', 'bg-secondary', 'text-white');
                                userDiv.dataset.id = userId;
                                userDiv.innerHTML = `
                    <span class="me-2 fw-bold w-100 ">${userName}</span>
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
            @endif
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>
</x-layout>
