@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">My Profile Details</h4>

                        @if (session('message'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        title: "Success!",
                                        text: "{{ session('message') }}",
                                        icon: "success",
                                        timer: 2000
                                    });
                                });
                            </script>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @foreach ($user as $userss)
                            <form class="form form-horizontal" method="POST" action="{{ route('user.update', ['user' => $userss->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> First Name</label>
                                                <input type="text" id="first_name" class="form-control"
                                                    name="first_name" placeholder={{ $userss->first_name }}  value="{{ old('first_name') ? old('first_name') : $userss->first_name }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Last Name</label>
                                                <input type="last_name" id="last_name" class="form-control" name="last_name"
                                                    placeholder={{ $userss->last_name }} value="{{ old('last_name') ? old('last_name') : $userss->last_name }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Mobile Number</label>
                                                <input type="number" id="mobile_number" class="form-control"
                                                    name="mobile_number" placeholder={{ $userss->mobile_number }} value="{{ old('mobile_number') ? old('mobile_number') : $userss->mobile_number }}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Email ID</label>
                                                <input type="text" id="email" class="form-control"
                                                    name="email" placeholder={{ $userss->email }} value="{{ old('email') ? old('email') : $userss->email }}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">UserName</label>
                                                <input type="text" id="username" class="form-control" name="username" placeholder="{{ $userss->username }}" value="{{ old('username') ? old('username') : $userss->username }}" style="background-color: #636161;" readonly>

                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" onclick= "Submitbtn()"
                                                class="btn btn-primary me-1 mb-1 submitBtn enable"> <span id="spinner"
                                                    class="spinner-border spinner-border-sm d-none" role="status"
                                                    aria-hidden="true"></span>
                                                Update</button>
                                            <button type="button" id="sbtbtn" onclick="window.history.back();"
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
