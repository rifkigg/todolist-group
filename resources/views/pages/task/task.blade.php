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
                                            <td>{{ $item->project->name ?? 'No Project' }}</td>
                                            <td>{{ $item->status->name ?? 'No Status' }}</td>
                                            <td>{{ $item->priority->name ?? 'No Priority' }}</td>
                                            <td>{{ $item->due_date ?? 'No Due Date' }}</td>
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
                                                    <a href="{{ route('project.show', $item->id) }}" class="btn">
                                                        <i class="icon-action fa-solid fa-eye"></i>
                                                    </a>

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



</x-layout>
