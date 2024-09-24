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
                        <li class="nav-item active">
                            <a class="nav-link active" href="{{ route('ongoing.index') }}" aria-bs-expanded="true"
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
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-bs-expanded="true" aria-bs-controls="collapseTwo">
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
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                        <i class="fas fa-clipboard-list "></i>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manage_user.index') }}" aria-bs-expanded="true"
                            aria-bs-controls="collapseTwo">
                            <i class="fa-solid fa-users-gear"></i>
                            <span>Manage User</span>
                        </a>
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
                                <h6 class="m-0 font-weight-bold text-primary">On Going</h6>
                            </div>
                            <div class="card-body">
                                @if (count($activeTasks) > 0)
                                    <table id="example" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Task</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Task Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activeTasks as $activeTask)
                                                <tr>
                                                    <td>{{ $activeTask['user'] }}</td>
                                                    <td>{{ $activeTask['task'] }}</td>
                                                    <td>
                                                        @if (!$activeTask['status'] == null)
                                                            @if ($activeTask['status'] == 'Paused')
                                                                <p class="badge bg-secondary">Paused</p>
                                                            @elseif ($activeTask['status'] == 'Playing')
                                                                <p class="badge bg-warning">Playing</p>
                                                            @else
                                                                <p class="badge bg-success">Finished</p>
                                                            @endif
                                                        @else
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!$activeTask['time'] == null)
                                                            {{ \Carbon\Carbon::parse($activeTask['time'])->format('H:i:s') }}
                                                        @elseif ($activeTask['time'] == '0')
                                                            <p>00:00:00</p>
                                                        @else
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($activeTask['created_at'])->format('d m Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Tidak ada tugas yang sedang dimainkan.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End of Main Content -->


                    <!-- End of Content Wrapper -->

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
    </x-layout>
