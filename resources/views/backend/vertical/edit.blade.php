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
                            Edit Vertical
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
                      action="{{ route('backend.vertical.update', Crypt::encrypt($vertical->id)) }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Vertical Name
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{ old('name',$vertical->name) }}">

                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            class="form-select"
                            name="status">

                            <option value="1"
                                {{ old('status',$vertical->status)==1?'selected':'' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status',$vertical->status)==0?'selected':'' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Banner Sub Heading
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="banner_sub_heading"
                            value="{{ old('banner_sub_heading',$vertical->banner_sub_heading) }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Banner Heading
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="banner_heading"
                            value="{{ old('banner_heading',$vertical->banner_heading) }}">

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Banner Description
                        </label>

                        <textarea
                            class="form-control"
                            rows="5"
                            name="banner_description">{{ old('banner_description',$vertical->banner_description) }}</textarea>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Current Banner
                        </label>

                        <br>

                        <img
                            id="preview"
                            src="{{ asset($vertical->banner_image) }}"
                            class="img-thumbnail"
                            width="250">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Change Banner
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="banner_image"
                            name="banner_image"
                            accept="image/jpeg,image/png,image/jpg,image/webp">

                        <small class="text-muted">
                            Leave empty if you don't want to change the banner.
                        </small>

                    </div>

                    <div class="col-md-12">

                        <button
                            class="btn btn-primary px-4">

                            Update

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

            $("#preview").attr("src",e.target.result);

        }

        reader.readAsDataURL(input.files[0]);

    }

});

</script>

@endsection