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
                    <i class="fa-solid fa-list-check"></i>
                    <span>Project</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if (auth()->user()->role == 'admin')
                            <a class="collapse-item active" href="{{ route('project.index') }}">Project</a>
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                            <a class="collapse-item " href="{{ route('projectcategories.index') }}">Categories</a>
                            <a class="collapse-item" href="{{ route('project_status.index') }}">Project Status</a>
                        @elseif (auth()->user()->role == 'manajer')
                            <a class="collapse-item active" href="{{ route('project.index') }}">Project</a>
                            <a class="collapse-item" href="{{ route('project.create') }}">Add New</a>
                        @else
                            <a class="collapse-item active" href="{{ route('project.index') }}">Project</a>
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                    aria-bs-expanded="true" aria-bs-controls="collapseThree">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Task</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
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
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-navbar-topbar></x-navbar-topbar>

                <!-- Begin Page Content -->
                <div class="container text-dark">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Projects</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_project }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-list-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Boards</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_board }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-display fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_task }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                People Involved</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_user }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            {{-- <i class="fas fa-comments fa-2x text-gray-300"></i> --}}
                                            <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
                                <form action="{{ route('project.create') }}" method="GET">
                                    <button type="submit" class="btn btn-primary d-flex gap-2 align-items-center"><i
                                            class="fa-solid fa-circle-plus fa-lg"></i> Add New</button>
                                </form>
                            @else
                            @endif
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Live Date</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($project as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->status->name }}</td>
                                            <td>{{ $item->live_date }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="d-flex">
                                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manajer')
                                                    <!-- Form untuk duplikasi -->
                                                    <form id="duplicate-form-{{ $item->id }}"
                                                        action="{{ route('project.duplicate', $item->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <!-- Ikon copy dengan event click -->
                                                    <a href="#" class="btn"
                                                        onclick="event.preventDefault(); document.getElementById('duplicate-form-{{ $item->id }}').submit();">
                                                        <i class="icon-action fa-solid fa-copy"></i>
                                                    </a>

                                                    <!-- Ikon view -->
                                                    <a href="{{ route('project.show', $item->id) }}" class="btn">
                                                        <i class="icon-action fa-solid fa-eye"></i>
                                                    </a>

                                                    <!-- Ikon edit -->
                                                    <a href="{{ route('project.edit', $item->id) }}" class="btn">
                                                        <i class="icon-action fa-solid fa-pencil"></i>
                                                    </a>

                                                    <!-- Form untuk delete -->
                                                    <form action="{{ route('project.destroy', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this item?');"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn">
                                                            <i class="icon-action fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Ikon view -->
                                                    <a href="{{ route('project.show', $item->id) }}" class="btn">
                                                        <i class="icon-action fa-solid fa-eye"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="alert alert-danger">
                                                Data Project belum Tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
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


</x-layout>
