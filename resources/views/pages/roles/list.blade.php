@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="card p-4">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Assign Roles to Users</h3>
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
                                <li class="breadcrumb-item active" aria-current="page">Roles
                                </li>
                            </ol>
                            <a href="/roles/create" class="btn btn-primary me-1 mb-1submenu-link"
                                style="margin-left : 40px;">Add New</a>
                        </nav>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-wrapper">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersList as $usersLists)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usersLists->name }}</a></td>
                                <td>{{ $usersLists->email }}</td>
                                <td>{{ ucfirst($usersLists->rolename) }}</td>
                                <td>
                                    @if ($usersLists->status == 1)
                                        <span class="badge bg-danger">Inactive</span>
                                    @elseif ($usersLists->status == 0)
                                        <span class="badge bg-success">Active</span>
                                    @endif
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
