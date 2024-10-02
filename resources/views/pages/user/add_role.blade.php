<x-layout>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-navbar>
            <x-slot name="dashboard">
                @if (auth()->user()->role && in_array('viewDashboard', auth()->user()->role->permissions->pluck('name')->toArray()))
                    <li class="nav-item active">
                        <a class="nav-link active" href="/dashboard">
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
                    <a class="nav-link active" href="/boards">
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
                        </div>
                    </div>
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
                    {{-- <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Create Role</h6>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createModal">Create Role</button>
                            <table id="example" class="table table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td class='d-flex'>
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="icon-action fa-solid fa-pencil"></i>
                                                </button>

                                                <form action="{{ route('roles.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn "
                                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="icon-action fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-roleledby="editModalrole{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalrole">Edit Role</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('roles.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name">
                                                                    Role Name :</label>
                                                                <input type="text" class="form-control"
                                                                    id="name" name="name"
                                                                    value="{{ old('name', $item->name) }}">
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary w-100">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="createModal" tabindex="-1"
                                            aria-roleledby="createModalrole" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalrole">Create Role</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('roles.store') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <role for="statusName">Name</role>
                                                                <input type="text" class="form-control"
                                                                    id="name" name="name"
                                                                    value="{{ old('name') }}"
                                                                    placeholder="Enter role name" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary w-100">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <div class="container">
                        <h2>Manajemen Role & Permission</h2>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Tambah Role Baru</h4>
                                <form action="{{ route('roles.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Role</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambah Role</button>
                                </form>
                            </div>
                    
                            <div class="col-md-6">
                                <h4>Berikan Permission ke Role</h4>
                                <form action="{{ route('roles.assign-permission') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="role_id">Role</label>
                                        <select name="role_id" class="form-control" required>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="form-group">
                                        <label for="permission_id">Permission</label>
                                        <select name="permission_id" class="form-control" required>
                                            @foreach($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <button type="submit" class="btn btn-success">Assign Permission</button>
                                </form>
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h4>Tambah Permission Baru</h4>
                                <form action="{{ route('permissions.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Permission</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tambah Permission</button>
                                </form>
                            </div>
                    
                            <div class="col-md-6">
                                <h4>Daftar Role dan Permissions</h4>
                                <ul class="list-group">
                                    @foreach($roles as $role)
                                        <li class="list-group-item">
                                            <strong>{{ $role->name }}</strong>
                                            <ul>
                                                @foreach($role->permissions as $permission)
                                                    <li>{{ $permission->name }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <a href="{{ route('roles.permissions.edit', $role->id) }}" class="btn btn-warning">Edit Permissions</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="{{ route('permissions.index') }}" class="btn btn-primary">Permission</a>
                        <a href="{{ route('users.index') }}" class="btn btn-primary">users</a>
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-roleledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-role="Close">
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
