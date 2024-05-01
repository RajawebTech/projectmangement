@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Teams</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST"
                                action="{{ route('team.update', ['teams' => $teams->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical"> Name  <span
                                                    class="text-danger">*</span></label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="name" placeholder="Enter your Name"
                                                    value="{{ old('name') ? old('name') : $teams->name }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email ID  <span
                                                    class="text-danger">*</span></label>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Enter Your Email Id"
                                                    value="{{ old('email') ? old('email') : $teams->email }}" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="contact-info-vertical">Mobile Number <span
                                                    class="text-danger">*</span></label>
                                                <input type="number" id="mobile_number" class="form-control"
                                                    name="mobile_number" placeholder="Enter Your Mobile Number"
                                                    value="{{ old('mobile_number') ? old('mobile_number') : $teams->mobile_number }}" required>
                                            </div>
                                        </div>

                                        {{-- <div class="col-6">
                                            <span style="color:red;">*</span>Image</label>

                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="image" name="image">
                                        </div> --}}


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Address <span
                                                    class="text-danger">*</span></label>
                                                <textarea class="form-control" placeholder="Enter Address" id="address" name="address" rows="4"
                                                    value="{{ $teams->address }}">{{ $teams->address }}

                                                </textarea>
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
