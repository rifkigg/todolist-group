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
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
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
            <li class="nav-item">
                <a class="nav-link active" href="/boards">
                    <i class="fa-solid fa-chess-board"></i>
                    <span>Boards</span>
                </a>
            </li>


            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
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
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                            <a class="collapse-item " href="{{ route('projectcategories.index') }}">Categories</a>
                            <a class="collapse-item" href="{{ route('project_status.index') }}">Project Status</a>
                        </div>
                    </div>
                </li>
            @endif
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                    aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Task</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
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
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
            <li class="nav-item active">
                <a class="nav-link active" href="{{ route('manage_user.index') }}" aria-bs-expanded="true"
                    aria-bs-controls="collapseManageUser">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Manage User</span>
                </a>
                <div id="collapseManageUser" class="collapse show" aria-labelledby="headingManageUser"
                    data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('roles.create') }}">Add Role</a>
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
                    <h1 class="h3 mb-4 text-gray-800">Role</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Role</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <role for="statusName">Name</role>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Enter role name" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add New Role</button>
                            </form>
                            <hr>
                            <h6 class="m-0 font-weight-bold text-primary">Current Role</h6>
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

                                                <form action="{{ route('roles.destroy', $item->id) }}" method="POST">
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
                                                        <h5 class="modal-title" id="editModalrole">Edit Data</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('roles.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="field_name" class="form-role">Field
                                                                    Name</role>
                                                                <input type="text" class="form-control"
                                                                    id="name" name="name"
                                                                    value="{{ old('name', $item->name) }}">
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
                            <p class="mt-3"><strong>Note:</strong> These roles will appear on tasks, deleting a
                                label can affect the manage_user</p>
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
