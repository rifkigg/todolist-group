@if (auth()->user()->role && in_array('addProject', auth()->user()->role->permissions->pluck('name')->toArray()))
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
                                <a class="collapse-item active" href="{{ route('project.create') }}">Add New</a>
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
                                        <input type="datetime-local" id="live_date"
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

                            <div class="wrapper">
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
                            {{--  --}}

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

                            <!-- Assignees (Multi-Select) -->
                            <label for="assignees" class="form-label">Assignees</label>
                            <select name="assignees[]" id="assignees" class="form-select mb-3" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ in_array($user->id, old('assignees', $project->users->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Tempat untuk menampilkan hasil pilihan -->
                            <div id="selected-assignees">
                                <p>Selected Assignees:</p>
                                <ul class="d-flex flex-wrap gap-2 list-unstyled">
                                    @foreach ($project->users as $user)
                                        <li class="d-flex align-items-center border rounded px-2 py-1">
                                            {{ $user->username }}
                                        </li>
                                    @endforeach
                                </ul>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectElements = document.querySelectorAll('[id^="assignees"]');
                const selectedAssigneesContainers = document.querySelectorAll('[id^="selected-assignees"]');

                // Function to update selected assignees display for a specific pair of select and container
                function updateSelectedAssignees(selectElement, selectedAssigneesContainer) {
                    const selectedOptions = Array.from(selectElement.selectedOptions);
                    selectedAssigneesContainer.innerHTML = '';

                    selectedOptions.forEach(option => {
                        const userId = option.value;
                        const userName = option.textContent;

                        const userDiv = document.createElement('div');
                        userDiv.classList.add('selected-user', 'mb-2', 'p-2', 'rounded', 'd-flex',
                            'justify-content-between', 'align-items-center', 'bg-secondary', 'text-white');
                        userDiv.dataset.id = userId;


                        userDiv.innerHTML = `
                        <span class="me-2">${userName}</span>
                        <button type="button" class="btn btn-sm btn-danger ms-2 remove-assignee" aria-label="Remove">x</button>
                    `;
                        selectedAssigneesContainer.appendChild(userDiv);
                    });
                }

                // Iterate over all select elements and attach event listeners
                selectElements.forEach((selectElement, index) => {
                    const selectedAssigneesContainer = selectedAssigneesContainers[index];

                    // Event listener for when the select value changes
                    selectElement.addEventListener('change', function() {
                        updateSelectedAssignees(selectElement, selectedAssigneesContainer);
                    });

                    // Event delegation to handle removal of assignees
                    selectedAssigneesContainer.addEventListener('click', function(event) {
                        if (event.target.classList.contains('remove-assignee')) {
                            const userDiv = event.target.closest('.selected-user');
                            const userId = userDiv.dataset.id;

                            // Remove the user from the select
                            const optionToRemove = Array.from(selectElement.options).find(option =>
                                option.value === userId);
                            if (optionToRemove) {
                                optionToRemove.selected = false;
                            }

                            // Remove the user div from the display
                            userDiv.remove();
                        }
                    });

                    // Initialize display on page load
                    updateSelectedAssignees(selectElement, selectedAssigneesContainer);

                    // Ensure that changes in data after load are reflected in the UI
                    new MutationObserver(() => updateSelectedAssignees(selectElement,
                        selectedAssigneesContainer)).observe(selectElement, {
                        childList: true,
                        subtree: true,
                        attributes: true,
                        characterData: true
                    });
                });
            });
        </script>
</x-layout>
@else
<p>Mo Ngapain Bang</p>
<a href="/">Balek sana bang</a>
@endif