@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Verticals</div>
            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Add New Vertical
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Vertical Details</h5>
            </div>

            <div class="card-body p-4">

                <form class="row g-3"
                      method="POST"
                      action="{{ route('backend.vertical.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">
                        <label class="form-label">
                            Vertical Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Solar Power">

                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Banner Sub Heading
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="banner_sub_heading"
                            value="{{ old('banner_sub_heading') }}">

                        @error('banner_sub_heading')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">
                            Banner Heading
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="banner_heading"
                            value="{{ old('banner_heading') }}">

                        @error('banner_heading')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">
                            Banner Description
                        </label>

                        <textarea
                            class="form-control"
                            rows="5"
                            name="banner_description">{{ old('banner_description') }}</textarea>

                        @error('banner_description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Banner Image
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="banner_image"
                            name="banner_image"
                            accept="image/jpeg,image/png,image/jpg,image/webp">

                        @error('banner_image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <img
                            id="preview"
                            src=""
                            style="display:none;max-width:300px;border-radius:10px;">

                    </div>

                    <div class="col-md-12">

                        <button
                            class="btn btn-primary px-4">

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

$("#banner_image").change(function(){

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