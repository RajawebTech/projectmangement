@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">Add Teams</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route('team.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="name" placeholder="Enter your Name" pattern="[A-Za-z\s]+"
                                                    title="Please enter only letters" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email ID <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Enter Your Email Id" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Mobile Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="mobile_number" class="form-control"
                                                    name="mobile_number" placeholder="Enter Your Mobile Number"
                                                    pattern="[0-9]*" inputmode="numeric" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Address <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" placeholder="Enter Address" id="address" name="address" rows="4" required></textarea>
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

    <script>
        FilePond.create(document.querySelector(".basic-filepond"), {
            credits: null,
            allowImagePreview: false,
            allowMultiple: false,
            allowFileEncode: false,
            required: false,
            storeAsFile: true,
        })
    </script>
@endsection
