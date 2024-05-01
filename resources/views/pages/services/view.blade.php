@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>View Services</h4>
                    <a href="/services/list" class="btn btn-primary me-1 mb-1submenu-link ml-auto">View List</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Show</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">

                                            <p class="font-bold ms-3 mb-0">Customer Name :-</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class="font-bold ms-3 mb-0 text-blue-500" >
                                            {{ old('customer_name') ? old('customer_name') : $services->customer_name }}
                                        </p>
                                    </td>

                                </tr>

                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="font-bold ms-3 mb-0">Types of Services :-</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class="font-bold ms-3 mb-0 text-blue-500" >
                                            {{ old('types_of_services') ? old('types_of_services') : strtoupper($services->types_of_services) }}

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="font-bold ms-3 mb-0">AMC Frequency :-</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class="font-bold ms-3 mb-0 text-blue-500" >
                                            {{ old('amc_frequency') ? old('amc_frequency') : $services->amc_frequency }}

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="font-bold ms-3 mb-0">Due Date :-</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class="font-bold ms-3 mb-0 text-blue-500" >
                                            {{ old('due_date') ? old('due_date') : $services->due_date }}

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="font-bold ms-3 mb-0">Planned Auditor :-</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class="font-bold ms-3 mb-0 text-blue-500" >
                                            {{ old('planned_auditor') ? old('planned_auditor') : $services->planned_auditor }}

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="font-bold ms-3 mb-0">Work Items :-</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        @foreach ($workitems as $workitem)
                                        <p class="font-bold ms-3 mb-0 text-blue-500">{{ $workitem->work_item_name }}</p>
                                    @endforeach
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="font-bold ms-3 mb-0">Work Logs :-</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class="font-bold ms-3 mb-0 text-blue-500" >
                                            {{ old('work_logs') ? old('work_logs') : $services->work_logs }}

                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        function Submitbtn() {
            var spinner = document.getElementById('spinner');
            spinner.classList.remove('d-none');
            this.disabled = true;
        }
    </script>



@section('scripts')
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection


<script>
    $('select').selectpicker();
</script>

@endsection
