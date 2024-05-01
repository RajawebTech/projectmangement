@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">Add Roles</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route('register.custom') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Select Team member <span
                                                        class="text-danger">*</span></label>
                                                <select class="choices form-select multiple-remove" name="name" required>
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
                                                <label for="password">Create Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" id="password" class="form-control" name="password"
                                                    placeholder="Enter Password" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" id="confirm_password" class="form-control"
                                                    name="confirm_password" placeholder="Enter Confirm Password" required>
                                                <div id="password_error" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="confirm_password">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" id="email" class="form-control"
                                                    name="email" placeholder="Enter Email Id" required>
                                                    @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="password-vertical">Assign Role <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="role_id" required>
                                                    <option value="select" disabled selected>select</option>
                                                    <option value="1">Super Admin</option>
                                                    <option value="2">Member</option>
                                                    <option value="3">Project Manager</option>
                                                </select>
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


    <script>
        document.getElementById('confirm_password').addEventListener('input', function() {
            var password = document.getElementById('password').value;
            var confirm_password = document.getElementById('confirm_password').value;
            var password_error = document.getElementById('password_error');

            if (password === confirm_password) {
                password_error.innerHTML = '';
            } else {
                password_error.innerHTML = 'Passwords do not match';
            }
        });
    </script>
@endsection
