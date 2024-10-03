<x-layout>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-navbar>
            <x-slot name="dashboard">
                @if (auth()->user()->role && in_array('viewDashboard', auth()->user()->role->permissions->pluck('name')->toArray()))
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                @else
                @endif
                @if (auth()->user()->role && in_array('viewOnGoing', auth()->user()->role->permissions->pluck('name')->toArray()))
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-bs-expanded="true" aria-bs-controls="collapseOne">
                        <i class="fa-solid fa-hourglass-half"></i>
                        <span>On Going</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item " href="{{ route('ongoing.index') }}">On Going</a>
                            @if (auth()->user()->role && in_array('viewDeadline', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <a class="collapse-item" href="{{ route('ongoingdeadline.index') }}">Deadline</a>
                            @else
                            @endif
                        </div>
                    </div>
                    </li>
                @else
                @endif

            </x-slot>
            @if (auth()->user()->role && in_array('viewBoard', auth()->user()->role->permissions->pluck('name')->toArray()))
                <li class="nav-item">
                    <a class="nav-link" href="/boards">
                        <i class="fa-solid fa-chess-board"></i>
                        <span>Boards</span>
                    </a>
                </li>
            @else
            @endif


            @if (auth()->user()->role && in_array('viewProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                        aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Project</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item active" href="{{ route('project.index') }}">Project</a>
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
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-navbar-topbar></x-navbar-topbar>

                <!-- Begin Page Content -->
                <div class="container-fluid text-dark">
                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
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
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $total_project }}
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
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Tasks
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
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ $total_user }}
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
                    @else
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->role && in_array('addProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                                <form action="{{ route('project.create') }}" method="GET">
                                    <button type="submit" class="btn btn-primary d-flex gap-2 align-items-center"><i
                                            class="fa-solid fa-circle-plus fa-lg"></i> Add New</button>
                                </form>
                            @else
                            @endif
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Live Date</th>
                                        <th>Progress</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($projects as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ route('projects.tasks', $item->id) }}"
                                                    class="fw-bold">{{ $item->name }}</a>
                                                <!-- Tambahkan link untuk redirect ke TaskInProject -->
                                            </td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->status->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->due_date)->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>
                                                @if ($item->progress == 100)
                                                    <h5><span class="badge bg-success">{{ $item->progress }} %</span>
                                                    </h5>
                                                @elseif ($item->progress >= 60)
                                                    <h5><span class="badge bg-warning">{{ $item->progress }} %</span>
                                                    </h5>
                                                @else
                                                    <h5><span class="badge bg-danger">{{ $item->progress }} %</span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis fa-2xl"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                        @if (auth()->user()->role &&
                                                                in_array('duplicateProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                                                            <!-- Form untuk duplikasi -->
                                                            <form id="duplicate-form-{{ $item->id }}"
                                                                action="{{ route('project.duplicate', $item->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                            <li>
                                                                <!-- Ikon copy dengan event click -->
                                                                <a href="#" class="btn dropdown-item"
                                                                    onclick="event.preventDefault(); document.getElementById('duplicate-form-{{ $item->id }}').submit();">
                                                                    <i class="icon-action fa-solid fa-copy"></i>
                                                                    Duplicate
                                                                </a>
                                                            </li>
                                                        @else
                                                        @endif
                                                        @if (auth()->user()->role &&
                                                                in_array('showProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                                                        <li>
                                                            <!-- Ikon view -->
                                                            <a href="{{ route('project.show', $item->id) }}"
                                                                class="btn dropdown-item">
                                                                <i class="icon-action fa-solid fa-eye"></i> Show
                                                                Project
                                                            </a>
                                                        </li>
                                                        @else
                                                        @endif
                                                        @if (auth()->user()->role &&
                                                                in_array('editProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                                                        <li>
                                                            <!-- Ikon edit -->
                                                            <a href="{{ route('project.edit', $item->id) }}"
                                                                class="btn dropdown-item">
                                                                <i class="icon-action fa-solid fa-pencil"></i> Edit
                                                                Project
                                                            </a>
                                                        </li>
                                                        @else
                                                        @endif
                                                        @if (auth()->user()->role &&
                                                                in_array('deleteProject', auth()->user()->role->permissions->pluck('name')->toArray()))
                                                        <!-- Form untuk delete -->
                                                        <li>
                                                            <a href="#" class="btn dropdown-item"
                                                                onclick="event.preventDefault(); alert('Are you sure you want to delete this item?'); document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                                <i class="icon-action fa-solid fa-trash-can"></i>
                                                                Delete Project
                                                            </a>
                                                        </li>
                                                        <form action="{{ route('project.destroy', $item->id) }}"
                                                            method="POST" id="delete-form-{{ $item->id }}"
                                                            onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                            class="d-inline dropdown-item">
                                                            @csrf
                                                            @method('DELETE')

                                                        </form>
                                                        @else
                                                        @endif
                                                    </ul>
                                                </div>

                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="alert alert-danger">
                                                Data Project belum Tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
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
