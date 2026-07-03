@extends('layouts.backend.main')
@section('main-section')
    <div class="page-wrapper">

        <div class="page-content">

            <form method="POST" action="{{ route('backend.chairman_message.update') }}" enctype="multipart/form-data">

                @csrf

                <div class="card mb-4">

                    <div class="card-header">

                        <h5>Chairman & MD Details</h5>

                    </div>

                    <div class="card-body row g-3">

                        <div class="col-md-12">

                            <label>Chairman Name</label>

                            <input type="text" name="chairman_name" class="form-control"
                                value="{{ old('chairman_name', $message->chairman_name) }}">

                        </div>

                        <div class="col-md-12">

                            <label>About Chairman</label>

                            <textarea rows="8" class="form-control" name="about_chairman">{{ old('about_chairman', $message->about_chairman) }}</textarea>

                        </div>
                        <div class="col-md-6">

                            <label>Chairman Image</label>

                            <input type="file" class="form-control" id="chairman_image" name="chairman_image">

                        </div>

                        <div class="col-md-6">

                            <img id="chairman_preview"
                                src="{{ $message->chairman_image ? asset($message->chairman_image) : '' }}"
                                class="img-thumbnail"
                                style="max-width:220px;{{ $message->chairman_image ? '' : 'display:none;' }}">

                        </div>

                    </div>

                </div>

                <div class="card mb-4">

                    <div class="card-header">

                        <h5>Managing Director</h5>

                    </div>

                    <div class="card-body row g-3">

                        <div class="col-md-12">

                            <label>Managing Director Name</label>

                            <input type="text" name="md_name" class="form-control"
                                value="{{ old('md_name', $message->md_name) }}">

                        </div>

                        <div class="col-md-12">

                            <label>Managing Director Message</label>

                            <textarea rows="8" class="form-control" name="md_message">{{ old('md_message', $message->md_message) }}</textarea>

                        </div>
                        <div class="col-md-6">

                            <label>Managing Director Image</label>

                            <input type="file" class="form-control" id="md_image" name="md_image">

                        </div>

                        <div class="col-md-6">

                            <img id="md_preview" src="{{ $message->md_image ? asset($message->md_image) : '' }}"
                                class="img-thumbnail"
                                style="max-width:220px;{{ $message->md_image ? '' : 'display:none;' }}">

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-body row align-items-center">

                         

                        <div class="col-md-8 text-end">

                            <button class="btn btn-primary px-5">

                                Update

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>
@endsection

@section('javascript-section')
    @if (Session::has('success'))
        <script>
            Swal.fire({

                title: "Success!",

                text: "{{ Session::get('success') }}",

                icon: "success"

            });
        </script>
    @endif

    <script>
        function previewImage(input, preview) {

            if (input.files && input.files[0]) {

                let reader = new FileReader();

                reader.onload = function(e) {

                    $(preview)
                        .attr('src', e.target.result)
                        .show();

                }

                reader.readAsDataURL(input.files[0]);

            }

        }

        $("#chairman_image").change(function() {

            previewImage(this, "#chairman_preview");

        });

        $("#md_image").change(function() {

            previewImage(this, "#md_preview");

        });
    </script>
@endsection
