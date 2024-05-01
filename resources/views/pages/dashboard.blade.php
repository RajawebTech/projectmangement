@extends('layouts.app')
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row match-height">

            <div class="card">
                <div class="col-md-7 col-12">
                    <div class="card-header">
                        <h4 class="card-title">My Profile Details</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action=""
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                    <h4 class="card-title">Welcome to Project Management Services</h4>

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
