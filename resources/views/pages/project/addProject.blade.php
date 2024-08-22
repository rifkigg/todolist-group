<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">TODO-LIST <sup>GROUP</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Project</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item " href="{{ route('project.index') }}">Project</a>
                        <a class="collapse-item active" href="{{ route('project.create') }}">Add New</a>
                        <a class="collapse-item " href="{{ route('projectcategories.index') }}">Categories</a>
                        <a class="collapse-item" href="{{ route('project_status.index') }}">Project Status</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('/assets/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

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
                                                class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}"
                                                placeholder="Enter Project Name">
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
                            </div>

                            {{-- project details start --}}
                            <div class="wrapper mb-3">
                                <div class="textarea">
                                    <label for="project_detail">Project Details: </label>
                                    <textarea id="project_detail" class="form-control @error('project_detail') is-invalid @enderror"
                                        name="project_detail" value="{{ old('project_detail') }}" placeholder="Masukkan Judul Product">
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

        <script src="https://cdn.ckeditor.com/4.22.0/full/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('project_detail');
        </script>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('/assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
