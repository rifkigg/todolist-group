<x-layout>
    <div id="wrapper" style="overflow: hidden;">
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

        <!-- Content Wrapper -->
        <div id="content-wrapper" style="overflow: hidden;">
            <!-- Main Content -->
            <div id="content" style="overflow: hidden;">
                <x-navbar-topbar></x-navbar-topbar>

                <!-- Begin Page Content -->
                <div class="container text-dark">
                    <!-- Content Row -->
                    <button onclick="history.back()" class="btn btn-primary w-auto mb-3"><i
                            class="fa-solid fa-left-long"></i> Back to Project</button>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Project Detail</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Project Name:</th>
                                        <td>{{ $project->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Project Detail:</th>
                                        <td>
                                            <div id="editor" style="overflow: auto; height: 250px;">
                                                {!! $project->project_detail !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Project Category:</th>
                                        <td>{{ $project->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Project Status:</th>
                                        <td>{{ $project->status->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Project Due Date:</th>
                                        <td>{{ $project->live_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Project Created:</th>
                                        <td>{{ $project->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Assignees:</th>
                                        <td>
                                            <ul>
                                                @foreach ($project->users as $user)
                                                    <li>{{ $user->username }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
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
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>
</x-layout>
