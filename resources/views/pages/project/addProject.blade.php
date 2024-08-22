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
            </x-slot>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-bs-expanded="true" aria-bs-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Project</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                        <a class="collapse-item active" href="{{ route('project.create') }}">Add New</a>
                        <a class="collapse-item " href="{{ route('projectcategories.index') }}">Categories</a>
                        <a class="collapse-item" href="{{ route('project_status.index') }}">Project Status</a>
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
                <div class="container-fluid text-dark">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Projects</h6>
                        </div>
                        <div class="card-body">
                            <div class="wp-content">
                                <form action="{{ route('project.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="wrapper">

                                        <div class="form-input">
                                            <label for="name">Project Name:</label>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" placeholder="Enter Project Name">
                                            @error('name')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <p>The name of the project - where you can define your project.</p>
                                        </div>
                                    </div>
                                    <div class="date mb-3">
                                        <label for="live_date">Project Live Date: </label>
                                        <input type="date" id="live_date"
                                            class="form-control @error('live_date') is-invalid @enderror"
                                            name="live_date" value="{{ old('live_date') }}"
                                            placeholder="Masukkan Judul Product">
                                        @error('live_date')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="mb-3">
                                        <div class="form-select">

                                            <label for="category_id">Project Category: </label>
                                            <select id="category_id" name="category_id"
                                                class=" form-control @error('category_id') is-invalid @enderror"
                                                value="{{ old('category_id') }}">
                                                <option disabled>Pilih Category:</option>
                                                @foreach ($categories as $items)
                                                    <option value="{{ $items->id }}">{{ $items->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <p>The type of project you are creating.</p>
                                        </div>
                                    </div>
                            </div>

                            <div class="wrapper">
                                <div class="">
                                    <div class="form-select">
                                        <label for="status_id">Project Status</label>
                                        <select id="status_id" name="status_id"
                                            class="form-control @error('status_id') is-invalid @enderror"
                                            value="{{ old('status_id') }}">
                                            <option disabled>Pilih Status:</option>
                                            @foreach ($status as $items)
                                                <option value="{{ $items->id }}">{{ $items->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <p>The project status - current status of project.</p>
                                    </div>
                                </div>
                                {{--  --}}

                                {{-- project details start --}}
                                <div class="wrapper mb-3">
                                    <div class="textarea">
                                        <label for="project_detail">Project Details: </label>
                                        <textarea id="project_detail" class="form-control @error('project_detail') is-invalid @enderror" name="project_detail"
                                            value="{{ old('project_detail') }}" placeholder="Masukkan Judul Product">
                                            </textarea>
                                        @error('project_detail')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="submit">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-100">Create Project</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- End of Main Content -->
                    </div>
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
