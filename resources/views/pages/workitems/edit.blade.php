@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">Edit Workitems</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST"
                                action="{{ route('workitems.update', ['workitems' => $workitems->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="work-item">Task Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="work_item_name" placeholder="Enter your Name"
                                                    value="{{ old('work_item_name') ? old('work_item_name') : $workitems->work_item_name }}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="work-item">Assign To<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="assign_to" placeholder="Enter your Name"
                                                    value="{{ old('assign_to') ? old('assign_to') : $workitems->assign_to }}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="work-item">Start Date<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="start_date" placeholder="Enter your Name"
                                                    value="{{ old('start_date') ? old('start_date') : $workitems->start_date }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="work-item">End Date<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="first-name-vertical" class="form-control"
                                                    name="end_date" placeholder="Enter your Name"
                                                    value="{{ old('end_date') ? old('end_date') : $workitems->end_date }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="work-item">Description<span class="text-danger">*</span></label>
                                                <textarea id="first-name-vertical" class="form-control" name="description" placeholder="Enter your Name">{{ old('description') ? old('description') : $workitems->description }}</textarea>
                                            </div>
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
