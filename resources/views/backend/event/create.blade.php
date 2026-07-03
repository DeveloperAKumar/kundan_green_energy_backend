@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Events</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Add Event
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                <h5 class="mb-0">Event Details</h5>
            </div>

            <div class="card-body">

                <form class="row g-3"
                    method="POST"
                    action="{{ route('backend.event.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Event Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ old('title') }}">

                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Event Date <span class="text-danger">*</span>
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="date"
                            value="{{ old('date') }}">

                        @error('date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Description <span class="text-danger">*</span>
                        </label>

                        <textarea
                            rows="6"
                            class="form-control"
                            name="description">{{ old('description') }}</textarea>

                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Thumbnail <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="thumbnail"
                            name="thumbnail"
                            accept="image/*">

                        @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <img
                            id="preview"
                            src=""
                            class="img-thumbnail"
                            style="width:250px;display:none;">

                    </div>

                    <div class="card-header mt-4">
    <h5 class="mb-0">SEO Details</h5>
</div>

<div class="col-md-12">

    <label class="form-label">
        Meta Title
    </label>

    <input
        type="text"
        class="form-control"
        name="meta_title"
        value="{{ old('meta_title') }}"
        placeholder="Enter Meta Title">

    @error('meta_title')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="col-md-6">

    <label class="form-label">
        Meta Keyword
    </label>

    <textarea
        class="form-control"
        rows="4"
        name="meta_keyword"
        placeholder="Enter Meta Keyword">{{ old('meta_keyword') }}</textarea>

    @error('meta_keyword')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="col-md-6">

    <label class="form-label">
        Meta Description
    </label>

    <textarea
        class="form-control"
        rows="4"
        name="meta_description"
        placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>

    @error('meta_description')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

                    <div class="col-md-12">

                        <button
                            class="btn btn-primary px-5">

                            Submit

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection

@section('javascript-section')

<script>

$("#thumbnail").change(function(){

    let input=this;

    if(input.files && input.files[0]){

        let reader=new FileReader();

        reader.onload=function(e){

            $("#preview")
                .attr("src",e.target.result)
                .show();

        }

        reader.readAsDataURL(input.files[0]);

    }

});

</script>

@endsection