@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Home Video</div>
        </div>

        <div class="card">

            <div class="card-header">
                <h5>Home Video</h5>
            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('backend.home_video.update') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        @if($homeVideo && $homeVideo->video)

                        <div class="col-md-6 mb-4">

                            <label>Current Video</label>

                            <video width="250" controls>
                                <source src="{{ asset($homeVideo->video) }}">
                            </video>

                        </div>

                        @endif

                        <div class="col-md-6 mb-4">

                            <label>Upload Video</label>

                            <input
                                type="file"
                                class="form-control"
                                name="video"
                                accept="video/mp4,video/webm,video/ogg">

                            <small class="text-muted">
                                Allowed : MP4, WEBM, OGG
                            </small>

                            @error('video')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Status</label>

                            <select class="form-select" name="status">

                                <option value="1"
                                    {{ optional($homeVideo)->status ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ optional($homeVideo)->status == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="col-md-12">

                            <button class="btn btn-primary">
                                Update
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@section('javascript-section')

@if(session('success'))

<script>

Swal.fire({
    title: "Success!",
    text: "{{ session('success') }}",
    icon: "success"
});

</script>

@endif

@endsection
@endsection