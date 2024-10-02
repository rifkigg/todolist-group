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
                    <a class="nav-link" href="/boards">
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
                <li class="nav-item active">
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
                                <a class="collapse-item active" href="{{ route('task_status.index') }}">Task Status</a>
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
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Task Status</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Task Status</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('task_status.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <!-- Input Form -->
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}" placeholder="Enter status name">
                                </div>
                                <div class="form-group">
                                    <label for="status_group">Status Group</label>
                                    <select name="status_group" id="status_group" class="form-control">
                                        <option value="" selected disabled>Choose Status</option>
                                        <option value="open">Open</option>
                                        <option value="done">Done</option>
                                        <option value="close">Close</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add New Status</button>
                            </form>

                            <!-- Tabel untuk Menampilkan Daftar -->
                            <table id="example" class="table table-striped mt-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Group Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($status as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->status_group }}</td>
                                            <td>
                                                <button type="button" class="btn " data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="icon-action fa-solid fa-pencil"></i>
                                                </button>
                                                <form action="{{ route('task_status.destroy', $item->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn"
                                                        onclick="return confirm('Are you sure you want to delete this status?');">
                                                        <i class="icon-action fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('task_status.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="field_name" class="form-label">Field
                                                                    Name:</label>
                                                                <input type="text" class="form-control"
                                                                    id="name" name="name"
                                                                    value="{{ old('name', $item->name) }}">
                                                                <label for="field_status_group"
                                                                    class="form-label">Field
                                                                    Status:</label>
                                                                <select name="status_group" id="status_group"
                                                                    class="form-control">
                                                                    <option value="open">Open</option>
                                                                    <option value="done">Done</option>
                                                                    <option value="close">Close</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-success">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
</x-layout>
