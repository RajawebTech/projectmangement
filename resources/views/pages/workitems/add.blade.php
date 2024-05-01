@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">Add Tasks</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route('workitems.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Task Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="work_item_name" placeholder="Enter Task Name" pattern="[A-Za-z\s]+"
                                                    title="Please enter only letters" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Assign To <span
                                                        class="text-danger">*</span></label>
                                                <select class="choices form-select multiple-remove" name="assign_to" required>
                                                    <option value=""selected disabled>select</option>
                                                    @foreach ($teams as $team)
                                                        <option value="{{ $team->name }}">
                                                            {{ $team->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Start Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" id="start_date" class="form-control" name="start_date" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="contact-info-vertical">End Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" id="end_date" class="form-control"
                                                                    name="end_date"
                                                                      required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Description <span
                                                        class="text-danger">*</span></label>
                                                <textarea id="description" class="form-control" name="description" required></textarea>

                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" onclick="Submitbtn()"
                                                class="btn btn-primary me-1 mb-1 submitBtn enable">
                                                <span id="spinner" class="spinner-border spinner-border-sm d-none"
                                                    role="status" aria-hidden="true"></span>
                                                Submit
                                            </button>
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
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">


    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>

    <script>
        function Submitbtn() {
            var spinner = document.getElementById('spinner');
            spinner.classList.remove('d-none');
            this.disabled = true;
        }
    </script>
@endsection
