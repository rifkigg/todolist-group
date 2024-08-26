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
                                            <td>
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
                                                    <!-- Ikon view -->
                                                    <a href="{{ route('project.show', $item->id) }}" class="btn">
                                                        <i class="icon-action fa-solid fa-eye"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="createModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <form action="{{ route('task.update', $item->id) }}"
                                                        method="POST" enctype="multipart/form-data">
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
                                                                    <textarea class="form-control mb-3" id="description" name="description">{{ old('description', $item->description) }}</textarea>

                                                                    <label for="checklist"
                                                                        class="form-label">Checklist</label>
                                                                    <textarea class="form-control mb-3" id="checklist" name="checklist">{{ old('checklist', $item->checklist) }}</textarea>

                                                                    <p for="attachments" class="form-label">Attachment
                                                                    </p>
                                                                    <input type="file" class="form-control mb-3"
                                                                        id="attachments" name="attachments[]" multiple
                                                                        onchange="previewImages(event)" hidden>

                                                                    <!-- Menampilkan gambar yang sudah ada -->
                                                                    <div
                                                                        class="overflow-auto d-flex align-items-center gap-2">
                                                                        @if (!empty($item->attachments) && is_array(json_decode($item->attachments)))
                                                                            @foreach (json_decode($item->attachments) as $attachment)
                                                                                <a href="{{ asset('storage/attachments/' . basename($attachment)) }}"
                                                                                    target="_blank" class="me-2">
                                                                                    <img src="{{ asset('storage/attachments/' . basename($attachment)) }}"
                                                                                        alt="attachments"
                                                                                        class="img-fluid"
                                                                                        style="max-width: 150px; height: auto;">
                                                                                </a>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <br>

                                                                    <!-- Menampilkan gambar yang baru diunggah -->
                                                                    <p>Preview Attachment:</p>
                                                                    <div id="preview-container"></div>

                                                                    <label for="activities"
                                                                        class="form-label">Activities</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="activities" name="activities"
                                                                        value="{{ old('activities', $item->activities) }}">
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

                                                                    <p for="assignees" class="form-label">Assignees
                                                                    </p>
                                                                    <p for="time_count" class="form-label">Time Count
                                                                    </p>

                                                                    <label for="due_date" class="form-label">Due
                                                                        Date</label>
                                                                    <input type="date" name="due_date"
                                                                        id="due_date" class="form-control mb-3"
                                                                        value="{{ old('due_date', $item->due_date) }}">

                                                                    {{-- tombol attachment --}}
                                                                    <button type="button" class="btn btn-secondary"
                                                                        onclick="document.getElementById('attachments').click();">Attachment</button>

                                                                    {{-- tombol delete --}}
                                                                    <form
                                                                        action="{{ route('task.destroy', $item->id) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                                        class="d-inline"
                                                                        id="deleteForm-{{ $item->id }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary w-100">Save
                                                                and Close</button>
                                                        </div>
                                                    </form>

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
            function previewImages(event) {
                const files = event.target.files;
                const previewContainer = document.getElementById('preview-container');

                previewContainer.innerHTML = ''; // Clear any existing previews

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.className = 'img-fluid w-50 h-50 mb-2';

                        previewContainer.appendChild(imgElement);
                    }

                    reader.readAsDataURL(file);
                }
            }
        </script>
</x-layout>
