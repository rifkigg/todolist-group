<x-layout>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-navbar>
            <x-slot name="dashboard">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>

                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="/boards">
                        <i class="fa-solid fa-chess-board"></i>
                        <span>Boards</span>
                    </a>
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
                            <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                        @else
                            <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                    aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                    <i class="fas fa-clipboard-list "></i>
                    <span>Task</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if (auth()->user()->role == 'admin')
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
        </x-navbar>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-navbar-topbar></x-navbar-topbar>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form method="GET" action="{{ route('boards.index') }}">
                        <div class="form-group">
                            <label for="projectSelect">Select Project:</label>
                            <select id="projectSelect" name="project_id" class="form-control"
                                onchange="this.form.submit()">
                                <option value="" disabled selected>Choose Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>


                    <div style="height: 100vh;">
                        <div class="board-container overflow-auto d-flex flex-nowrap align-items-start"
                            style="max-width: 100%; padding: 10px;">
                            @forelse ($boards as $board)
                                <div class="board-item"
                                    style="min-width: 300px; height: auto;  margin-right: 10px; border: 1px solid #ccc; border-radius: 5px; padding: 10px; background-color: #f9f9f9;">
                                    <h5 style="margin: 0;">{{ $board->board_name }}</h5>
                                    <br>

                                    @forelse ($board->tasks as $task)
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#view-{{ $task->id }}">
                                            <div class="text-white bg-secondary rounded p-2">
                                                <p class="mb-0">{{ $task->name }}</p>
                                            </div>
                                        </a>
                                        <br>
                                    @empty
                                        <p>No tasks found for this board.</p>
                                    @endforelse
                                    <div class="d-flex gap-2 card-footer">
                                    <button type="button" class="btn btn-primary create-task-btn btn-sm w-100 d-flex align-items-center gap-2"
                                        data-board-id="{{ $board->id }}" data-bs-toggle="modal"
                                        data-bs-target="#createTaskModal">
                                        <i class="fa-solid fa-circle-plus fa-sm"></i> Add task
                                    </button>
                                    <form action="{{ route('boards.destroy', $board->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"
                                            onclick="return confirm('Are you sure you want to delete this board?')"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                                </div>
                            @empty
                                <p>Tidak ada board yang ditemukan untuk proyek ini.</p>
                            @endforelse

                            <!-- Form untuk membuat Board baru -->
                            <div class="board-item"
                                style="margin-right: 10px; border-radius: 5px; padding: 10px; background-color: #f9f9f9; ">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample" style="min-width: 200px">
                                    Create Board
                                </button>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body" style="min-width: 300px">
                                        <form action="{{ route('boards.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="boardName"
                                                    name="board_name" value="{{ old('board_name') }}"
                                                    placeholder="Enter board name" required>
                                                <input type="hidden" id="projectIdInput" name="project_id"
                                                    value="{{ request('project_id') }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create Board</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Modal for Creating Task -->
                        <div class="modal fade" id="createTaskModal" tabindex="-1"
                            aria-labelledby="createModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModalLabel">Create Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('taskboards.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="taskName" class="form-label">Task Name</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}"
                                                    placeholder="Enter Task Name">
                                                @error('name')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" id="projectIdInput" name="project_id"
                                                    value="{{ request('project_id') }}">
                                            </div>
                                            <div class="">
                                                <input type="hidden" id="board_id" name="board_id"
                                                    class="form-control" readonly>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create Task</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

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
            <script>
                document.querySelectorAll('.create-task-btn').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var boardId = this.getAttribute('data-board-id');
                        document.getElementById('board_id').value = boardId;
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const projectSelect = document.getElementById('projectSelect');
                    const projectIdInput = document.getElementById('projectIdInput');

                    projectSelect.addEventListener('change', function() {
                        projectIdInput.value = this.value;
                    });
                });
            </script>

</x-layout>
