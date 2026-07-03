@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vertical Sections</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Add New Section
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Section Details</h5>
            </div>

            <div class="card-body p-4">

                <form class="row g-3"
                      method="POST"
                      action="{{ route('backend.vertical_section.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Vertical
                        </label>

                        <select class="form-select" name="vertical_id">

                            <option value="">Select Vertical</option>

                            @foreach($verticals as $vertical)

                                <option
                                    value="{{ $vertical->id }}"
                                    {{ old('vertical_id')==$vertical->id?'selected':'' }}>

                                    {{ $vertical->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('vertical_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Sort Order

                        </label>

                        <input
                            type="number"
                            class="form-control"
                            name="sort_order"
                            value="{{ old('sort_order',1) }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Sub Heading

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="sub_heading"
                            value="{{ old('sub_heading') }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Heading

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="heading"
                            value="{{ old('heading') }}">

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">

                            Description

                        </label>

                        <textarea
                            rows="6"
                            class="form-control"
                            name="description">{{ old('description') }}</textarea>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Image Position

                        </label>

                        <select
                            class="form-select"
                            name="image_position">

                            <option value="left">

                                Left

                            </option>

                            <option
                                value="right"
                                selected>

                                Right

                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Section Image

                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp">

                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <img
                            id="preview"
                            src=""
                            style="display:none;width:250px;border-radius:8px;">

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

$("#image").change(function(){

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