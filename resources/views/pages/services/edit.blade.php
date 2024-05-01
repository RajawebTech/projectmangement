@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Services</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST"
                                action="{{ route('services.update', ['services' => $services->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Customer Name</label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="customer_name" placeholder="Enter Customer Name"
                                                    value="{{ old('customer_name') ? old('customer_name') : $services->customer_name }}"
                                                    >
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Types of Services</label>
                                                <select class="form-control" name="types_of_services">
                                                    <option value="select">Select</option>
                                                    <option value="amc"
                                                        {{ $services->types_of_services == 'amc' ? 'selected' : '' }}>AMC
                                                    </option>
                                                    <option value="audit"
                                                        {{ $services->types_of_services == 'audit' ? 'selected' : '' }}>
                                                        Audit</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Amc Frequency</label>
                                                <input type="text" id="contact_name" class="form-control"
                                                    name="amc_frequency" placeholder="Not applicable"
                                                    value="{{ old('amc_frequency') ? old('amc_frequency') : $services->amc_frequency }}"
                                                    >
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Due Date</label>
                                                <input type="date" id="contact_name" class="form-control" name="due_date"
                                                    value="{{ old('due_date') ? old('due_date') : $services->due_date }}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Planned Auditor</label>
                                                <select class="form-control" aria-label="Default select example" name="planned_auditor">
                                                    <option value="">Select</option>
                                                    @foreach ($teamsList as $teams_list)
                                                        <option value="{{ $teams_list->name }}" {{ (old('planned_auditor') == $teams_list->name || $services->planned_auditor == $teams_list->name) ? 'selected' : '' }}>
                                                            {{ $teams_list->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                

                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Status</label>
                                                <select class="form-control" name="service_status">
                                                    <option value="select">Select</option>
                                                    <option value="planned"
                                                        {{ $services->service_status == 'planned' ? 'selected' : '' }}>
                                                        Planned</option>
                                                    <option value="completed"
                                                        {{ $services->service_status == 'completed' ? 'selected' : '' }}>
                                                        Completed</option>
                                                    <option value="scheduled"
                                                        {{ $services->service_status == 'scheduled' ? 'selected' : '' }}>
                                                        Scheduled</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Work Items</label>
                                                <select class="choices form-select multiple-remove" name="work_items[]" multiple="multiple">
                                                    @foreach ($servicedropdown as $service)
                                                        <option value="{{ $service->id }}" {{ in_array($service->id, $serviceselect) ? 'selected' : '' }}>
                                                            {{ $service->work_item_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Work Logs</label>
                                                <textarea class="form-control" placeholder="Work Logs" id="work_logs" name="work_logs"
                                                    value="{{ old('work_logs') ? old('work_logs') : $services->work_logs }}" rows="4">{{ $services->work_logs }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" onclick= "Submitbtn()"
                                                class="btn btn-primary me-1 mb-1 submitBtn enable"> <span id="spinner"
                                                    class="spinner-border spinner-border-sm d-none" role="status"
                                                    aria-hidden="true"></span> Update</button>
                                            <button type="button" onclick="window.history.back();"
                                                class="btn btn-dark me-1 mb-1">Back</button>

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



@endsection
