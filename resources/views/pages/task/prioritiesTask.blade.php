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
                            <a class="collapse-item active" href="{{ route('priorities.index') }}">Task Priorities</a>
                            <a class="collapse-item " href="{{ route('labels.index') }}">Task Labels/Tags</a>
                        @else
                            <a class="collapse-item " href="{{ route('task.index') }}">Task</a>
                        @endif
                    </div>
                </div>
            </li>
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('manage_user.index') }}" aria-bs-expanded="true"
                        aria-bs-controls="collapseTwo">
                        <i class="fa-solid fa-users-gear"></i>
                        <span>Manage User</span>
                    </a>
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Priority</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('priorities.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}" placeholder="Enter Name of Priority">
                                </div>
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <div class="icon-selection">
                                        <div class="icon-options">
                                            <button type="button" class="btn btn-outline-primary mb-1" name="icon" value="{{ asset('assets/img/lowmeter.png') }}" onclick="selectIcon('{{ asset('assets/img/lowmeter.png') }}')">
                                                <img src="{{ asset('assets/img/lowmeter.png') }}" alt="Low Meter Icon" class="icon-size" />
                                            </button>
                                            <button type="button" class="btn btn-outline-primary mb-1" name="icon" value="{{ asset('assets/img/normalmeter.png') }}" onclick="selectIcon('{{ asset('assets/img/normalmeter.png') }}')">
                                                <img src="{{ asset('assets/img/normalmeter.png') }}" alt="Profile Icon 1" class="icon-size" />
                                            </button>
                                            <button type="button" class="btn btn-outline-primary mb-1" name="icon" value="{{ asset('assets/img/mediummeter.png') }}" onclick="selectIcon('{{ asset('assets/img/mediummeter.png') }}')">
                                                <img src="{{ asset('assets/img/mediummeter.png') }}" alt="Profile Icon 2" class="icon-size" />
                                            </button>
                                            <button type="button" class="btn btn-outline-primary mb-1" name="icon" value="{{ asset('assets/img/highmeter.png') }}" onclick="selectIcon('{{ asset('assets/img/highmeter.png') }}')">
                                                <img src="{{ asset('assets/img/highmeter.png') }}" alt="Profile Icon 2" class="icon-size" />
                                            </button>
                                            <!-- Add more buttons with images as needed -->
                                        </div>
                                        <input type="hidden" id="selectedIcon" name="icon" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                            <script>
                                function selectIcon(value, id) {
                                    var iconInput = document.getElementById('selectedIcon' + (id ? id : ''));
                                    if (iconInput) {
                                        iconInput.value = value; // Set the hidden input value
                                    }
                                }
                            </script>
                            <!-- Tabel untuk Menampilkan Daftar -->
                            <table id="example" class="table table-striped mt-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($priorities as $priority)
                                        <tr>
                                            <td>{{ $priority->name }}</td>
                                            <td>
                                                <span class="icon-display">
                                                    <img src="{{ $priority->icon }}" alt="{{ $priority->icon }} Icon" class="icon-size" />
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $priority->id }}">
                                                    <i class="icon-action fa-solid fa-pencil"></i>
                                                </button>
                                                <form action="{{ route('priorities.destroy', $priority->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn"
                                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="icon-action fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModal{{ $priority->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $priority->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('priorities.update', $priority->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="field_name" class="form-label">Field
                                                                    Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="name{{ $priority->id }}" name="name"
                                                                    value="{{ old('name', $priority->name) }}">
                                                                <label for="field_icon" class="form-label">Field
                                                                    Icon</label>
                                                                <div class="icon-selection">
                                                                    <div class="icon-options">
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary mb-1"
                                                                            name="icon" value="{{ asset('assets/img/lowmeter.png') }}"
                                                                            onclick="selectIcon('{{ asset('assets/img/lowmeter.png') }}', '{{ $priority->id }}')">
                                                                            <img src="{{ asset('assets/img/lowmeter.png') }}" alt="Low Meter Icon" class="icon-size" />
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary mb-1"
                                                                            name="icon" value="{{ asset('assets/img/normalmeter.png') }}"
                                                                            onclick="selectIcon('{{ asset('assets/img/normalmeter.png') }}', '{{ $priority->id }}')">
                                                                            <img src="{{ asset('assets/img/normalmeter.png') }}" alt="Normal Meter Icon" class="icon-size" />
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary mb-1"
                                                                            name="icon" value="{{ asset('assets/img/mediummeter.png') }}"
                                                                            onclick="selectIcon('{{ asset('assets/img/mediummeter.png') }}', '{{ $priority->id }}')">
                                                                            <img src="{{ asset('assets/img/mediummeter.png') }}" alt="Medium Meter Icon" class="icon-size" />
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary mb-1"
                                                                            name="icon" value="{{ asset('assets/img/highmeter.png') }}"
                                                                            onclick="selectIcon('{{ asset('assets/img/highmeter.png') }}', '{{ $priority->id }}')">
                                                                            <img src="{{ asset('assets/img/highmeter.png') }}" alt="High Meter Icon" class="icon-size" />
                                                                        </button>
                                                                        <!-- Add more buttons with images as needed -->
                                                                    </div>
                                                                    <input type="hidden"
                                                                        id="selectedIcon{{ $priority->id }}"
                                                                        name="icon" required
                                                                        value="{{ old('icon', $priority->icon) }}">
                                                                </div>
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