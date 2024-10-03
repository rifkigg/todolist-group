{{-- @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer') --}}
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
                    <li class="nav-item active">
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
                                <a class="collapse-item active" href="{{ route('permissions.index') }}">Permission</a>
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
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Permissions</h6>
                            </div>
                            <div class="card-body">

                            
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPermissionModal">Add Permission</button>
                            
                            <div class="modal fade" id="addPermissionModal" tabindex="-1" role="dialog" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPermissionModalLabel">Add Permission</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('permissions.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Permission Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter permission name" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Add Permission</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Permission Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm"> <i class="fa-solid fa-pen-to-square"></i></a>

                                                <div class="modal fade" id="addPermissionModal" tabindex="-1" role="dialog" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addPermissionModalLabel">Add Permission</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('permissions.store') }}" method="POST">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="name">Permission Name</label>
                                                                        <input type="text" name="name" class="form-control" placeholder="Enter permission name" required>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary w-100">Add Permission</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus permission ini?')"><i
                                                        class="icon-action fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
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
    </x-layout>
{{-- @else
    <p>Mo Ngapain Bang</p>
    <a href="/">Balek sana bang</a>
@endif --}}
