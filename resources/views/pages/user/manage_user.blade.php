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
                                    <a class="collapse-item active" href="{{ route('manage_user.index') }}">Manage User</a>
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

            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <x-navbar-topbar></x-navbar-topbar>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">


                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Manage User</h6>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createTask">
                                    Create User
                                </button>

                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->role->name ?? ' ' }}</td>
                                                <td class="d-flex">
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#updateUser_{{ $user->id }}">
                                                        <i class="icon-action fa-solid fa-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('manage_user.destroy', $user->id) }}"
                                                        method="POST" enctype="multipart/form-data" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn">
                                                            <i class="icon-action fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="updateUser_{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="UpdateModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="createModalLabel">Edit User
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('manage_user.update', $user->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="field_name" class="form-label">
                                                                        Username</label>
                                                                    <input type="text"
                                                                        class="form-control @error('username') is-invalid @enderror"
                                                                        name="username"
                                                                        value="{{ old('username', $user->username) }}"
                                                                        required placeholder="Enter Username">
                                                                    @error('username')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="field_name" class="form-label">
                                                                        Email</label>
                                                                    <input type="email"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        name="email"
                                                                        value="{{ old('email', $user->email) }}"
                                                                        placeholder="Enter email" required>
                                                                    @error('email')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="field_name" class="form-label">
                                                                        Choose Role</label>
                                                                    <select id="role_id" name="role_id"
                                                                        class="form-control"
                                                                        required>
                                                                        <option value="" selected disabled>Choose
                                                                            Role:</option>
                                                                            @foreach ($roles as $role) {{-- Menggunakan $roles untuk menampilkan semua role --}}
                                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="field_name" class="form-label">
                                                                        Password</label>
                                                                    <input type="password"
                                                                        class="form-control @error('password') is-invalid @enderror"
                                                                        name="password" placeholder="Enter Password">
                                                                    @error('password')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    User</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="modal fade" id="createTask" tabindex="-1"
                                    aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Create User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('manage_user.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="field_name" class="form-label">
                                                            Username</label>
                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            name="username" value="{{ old('username') }}"
                                                            placeholder="Enter Username" required>
                                                        @error('username')
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="field_name" class="form-label">
                                                            Email</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}"
                                                            placeholder="Enter email" required>
                                                        @error('email')
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="field_name" class="form-label">
                                                            Choose Role</label>
                                                        <select id="role_id" name="role_id" class="form-control" required>
                                                            <option value="" selected disabled>Choose Role:</option>
                                                            @foreach ($roles as $role) {{-- Menggunakan $roles untuk menampilkan semua role --}}
                                                                <option value="{{ $role->id }}">{{ $role->name }}</option> {{-- Pastikan value di sini benar --}}
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="field_name" class="form-label">
                                                            Password</label>
                                                        <input type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" value="{{ old('password') }}"
                                                            placeholder="Enter password">
                                                        @error('password')
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Create
                                                        User</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

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
