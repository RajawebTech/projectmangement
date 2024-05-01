@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="card p-4">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Tasks</h3>
                        @if (session('message'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Toast.fire({
                                        icon: 'success',
                                        title: '{{ session('message') }}'
                                    });

                                });
                            </script>
                        @endif
                    </div>


           


                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active" aria-current="page">Add Tasks
                                </li>
                            </ol>
                            {{-- <a href="/workitems/create" class="btn btn-primary me-1 mb-1submenu-link"
                                style="margin-left : 40px;">Add New</a> --}}
                        </nav>
                    </div>
                </div>
            </div>
            <br>


            <form action="/workitems/filter" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label for="fromDate" class="form-label">From Date</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate">
                    </div>
                    <div class="col-md-2">
                        <label for="toDate" class="form-label">To Date</label>
                        <input type="date" class="form-control" id="toDate" name="toDate">
                    </div>
                    <div class="col-md-2 mt-2">
                        <label for="service-status-select">Team</label>
                        <select class="choices form-select multiple-remove" name="assign_to">
                            <option value="" selected disabled>select</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->name }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mt-4">
                        <button type="submit" class="btn btn-primary" style="margin-top: 7px">Search</button>
                    </div>
                    <div class="col-md-2 mt-4">
                        <a href="/workitems/list" class="btn btn-danger"
                            style="margin-top: 7px; margin-left: -81px;">Refresh</a>
                    </div>
                </div>
            </form>


            <div class="table-wrapper">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Task Name</th>
                            <th>Assign To</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workitems as $workitemss)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $workitemss->work_item_name }}</a></td>
                                <td>{{ $workitemss->assign_to }}</a></td>
                                <td>{{ $workitemss->start_date }}</a></td>
                                <td>{{ $workitemss->end_date }}</a></td>
                                <td>
                                    @if ($workitemss->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @elseif ($workitemss->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>
                                <td style="display: flex">
                                    <a href="{{ route('workitems.edit', ['workitems' => $workitemss->id]) }}"
                                        class="btn btn-dark me-1 mb-1 "><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('workitems.delete', ['workitems' => $workitemss->id]) }}"
                                        class="btn btn-danger me-1 mb-1 delete-link" onclick="return confirmDelete();">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection


<script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/static/js/pages/sweetalert2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
</script>




<script>
    function confirmDelete() {
        var confirmation = confirm('Are you sure you want to delete this team?');
        if (confirmation) {
            Toast.fire({
                icon: 'error',
                title: 'Teams Deleted Successfully'
            });

        }
        return confirmation;
    }
</script>
