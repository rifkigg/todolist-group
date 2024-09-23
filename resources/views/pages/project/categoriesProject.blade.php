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
                <li class="nav-item">
                    <a class="nav-link active" href="/boards">
                        <i class="fa-solid fa-chess-board"></i>
                        <span>Boards</span>
                    </a>
                </li>
            </x-slot>

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-bs-expanded="true" aria-bs-controls="collapseThree">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Project</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                            <a class="collapse-item active" href="{{ route('projectcategories.index') }}">Categories</a>
                            <a class="collapse-item" href="{{ route('project_status.index') }}">Project Status</a>
                        </div>
                    </div>
                </li>
            @endif
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Task</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
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
                            <h6 class="m-0 font-weight-bold text-primary">Add New Categories</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('projectcategories.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <!-- Input Form -->
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        onkeyup="generateSlug('name', 'slug')" required placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="slug" hidden>Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" readonly
                                        required hidden>
                                </div>
                                <button type="submit" class="btn btn-primary">Add New</button>
                            </form>

                            <!-- Tabel untuk Menampilkan Daftar -->
                            <table id="example" class="table table-striped mt-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        {{-- <th hidden>Slug</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td hidden>{{ $category->slug }}</td>
                                            <td>
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $category->id }}">
                                                    <i class="icon-action fa-solid fa-pencil"></i>
                                                </button>
                                                <form action="{{ route('projectcategories.destroy', $category->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn"
                                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="icon-action fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('projectcategories.update', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="field_name_{{ $category->id }}"
                                                                    class="form-label">Nama</label>
                                                                <input type="text" class="form-control"
                                                                    id="field_name_{{ $category->id }}"
                                                                    name="name"
                                                                    oninput="generateSlug('field_name_{{ $category->id }}', 'field_slug_{{ $category->id }}')"
                                                                    value="{{ $category->name }}" required>
                                                                <label for="field_slug_{{ $category->id }}"
                                                                    class="form-label" hidden>Slug</label>
                                                                <input type="text" class="form-control"
                                                                    id="field_slug_{{ $category->id }}"
                                                                    name="slug" value="{{ $category->slug }}"
                                                                    readonly hidden>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-success">Perbarui</button>
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
        <script>
            function generateSlug(nameFieldId, slugFieldId) {
                let name = document.getElementById(nameFieldId).value;
                console.log('name: ', name);
                let slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                document.getElementById(slugFieldId).value = slug;
            }
        </script>
</x-layout>
