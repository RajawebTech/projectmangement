@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="card p-4">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Services</h3>
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
                                <li class="breadcrumb-item">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Services
                                </li>
                            </ol>
                            <a href="/services/create" class="btn btn-primary me-1 mb-1submenu-link"
                                style="margin-left : 40px;">Add New</a>
                        </nav>
                    </div>
                </div>
            </div>
            <br>

            <form action="/services/filter" method="POST">
                @csrf <!-- Add CSRF token if you're using Laravel -->
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
                        <label for="customer-name-select">Customer Name</label>
                        <select class="form-control" id="customer-name-select" name="customer_name">
                            <option value="" disabled selected>Select</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->customer_name }}"
                                    data-amc-frequency="{{ $customer->amc_frequency }}">
                                    {{ $customer->customer_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mt-2">
                        <label for="service-status-select">Service Status</label>
                        <select class="form-control" id="service-status-select" name="service_status">
                            <option value="" disabled selected>Select</option>
                            <option value="planned">Planned</option>
                            <option value="completed">Completed</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                    </div>
                    <div class="col-md-2 mt-4">
                        <button type="submit" class="btn btn-primary"style="margin-top: 7px">Search</button>
                    </div>
                    <div class="col-md-2 mt-4">
                        <a href="/services/list" class="btn btn-danger" style="margin-top: 7px;margin-left: -81px;">Refresh</a>
                    </div>
                </div>

            </form>


            <br>
            <div class="table-wrapper">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th> Auditor Name</th>
                            <th> Customer Name</th>
                            <th>Type of Services</th>
                            <th> Due Date</th>
                            <th>Service Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->planned_auditor }}</a></td>
                                <td>{{ $service->customer_name }}</a></td>
                                <td>{{ strtoupper($service->types_of_services) }}</td>
                                <td>{{ $service->due_date }}</a></td>
                                <td>
                                    @if ($service->service_status == 'scheduled')
                                        <span class="badge bg-success">Scheduled</span>
                                    @elseif ($service->service_status == 'planned')
                                        <span class="badge bg-dark">Planned</span>
                                    @elseif ($service->service_status == 'completed')
                                        <span class="badge bg-danger">Completed</span>
                                    @endif
                                </td>
                                <td style="display: flex">
                                    <a href="{{ route('services.edit', ['services' => $service->id]) }}"
                                        class="btn btn-dark me-1 mb-1 "><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('services.delete', ['services' => $service->id]) }}"
                                        class="btn btn-danger me-1 mb-1 delete-link" onclick="return confirmDelete();">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="{{ route('services.view', ['services' => $service->id]) }}"
                                        class="btn btn-dark me-1 mb-1 "><i class="bi bi-eye"></i></a>
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
        var confirmation = confirm('Are you sure you want to delete this customer?');
        if (confirmation) {
            Toast.fire({
                icon: 'error',
                title: 'Services Deleted Successfully'
            });

        }
        return confirmation;
    }
</script>
