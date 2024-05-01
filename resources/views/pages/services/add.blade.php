@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">Add Services</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route('services.store') }}">
                                @csrf
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Customer Name <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="customer-name-select" name="customer_name"
                                                    required>
                                                    <option value="select" disabled selected>Select</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->customer_name }}"
                                                            data-amc-frequency="{{ $customer->amc_frequency }}">
                                                            {{ $customer->customer_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Types of Services <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="amc-frequency-input" class="form-control"
                                                    name="types_of_services" placeholder="Selected Service" required>
                                            </div>

                                        </div>

                                        {{-- <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Standard <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="standard" required>
                                                    <option value="select" disabled selected>select</option>
                                                    @foreach ($certificates as $certificatess)
                                                        <option value="{{ $certificatess->standard }}">
                                                            {{ $certificatess->standard }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-6" id="amc">
                                            <div class="form-group">
                                                <label for="first-name-vertical">AMC Frequency <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="amc_frequency"required>
                                                    <option value="select" disabled selected>Select</option>
                                                    @foreach ($amc as $amc_frequency)
                                                        <option value="{{ $amc_frequency->name }}">
                                                            {{ $amc_frequency->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Due Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" name="due_date" id="due_date" class="form-control"
                                                    min="YYYY-MM-DD" required>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="address">Planned Auditor <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="planned_auditor" required>
                                                    <option value="select" disabled selected>Select</option>
                                                    @foreach ($teams as $team)
                                                        <option value="{{ $team->name }}">{{ $team->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="service_status" required>
                                                    <option value="select" disabled selected>select</option>
                                                    <option value="planned">Planned</option>
                                                    {{-- <option value="completed">Completed</option> --}}
                                                    <option value="scheduled">Scheduled</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Work Items <span
                                                        class="text-danger">*</span></label>
                                                <select class="choices form-select multiple-remove" name="work_items[]"
                                                    multiple="multiple" required>
                                                    @foreach ($workitems as $workitem)
                                                        <option value="{{ $workitem->id }}">
                                                            {{ $workitem->work_item_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Work Logs <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" placeholder="Work Logs" id="work_logs" name="work_logs" rows="4" required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" onclick= "Submitbtn()"
                                                class="btn btn-primary me-1 mb-1 submitBtn enable"> <span id="spinner"
                                                    class="spinner-border spinner-border-sm d-none" role="status"
                                                    aria-hidden="true"></span>
                                                Submit</button>
                                            <button type="button" onclick="window.history.back();"
                                                class="btn btn-secondary me-1 mb-1">Back</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"> --}}


    {{-- <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script> --}}

    <script src="assets/static/js/components/dark.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/extensions/choices.js"></script>
    <script src="assets/static/js/pages/form-element-select.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="{{ url('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <script src="{{ url('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ url('assets/static/js/pages/form-element-select.js') }}"></script>


    <script>
        function Submitbtn() {
            var spinner = document.getElementById('spinner');
            spinner.classList.remove('d-none');
            this.disabled = true;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('due_date').min = today;
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#customer-name-select').change(function() {

                var selectedCustomer = $(this).find('option:selected');
                var amcFrequency = selectedCustomer.data('amc-frequency');
                $('#amc-frequency-input').val(amcFrequency);
                if (amcFrequency == 'amc') {
                    $('#amc').hide();
                } else {
                    $('#amc').show();
                }


            });
        });
    </script>
@endsection
