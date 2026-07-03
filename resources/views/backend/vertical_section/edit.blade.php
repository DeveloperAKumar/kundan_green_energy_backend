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
                            Edit Section
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
                    action="{{ route('backend.vertical_section.update', Crypt::encrypt($section->id)) }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">Vertical</label>

                        <select class="form-select" name="vertical_id">

                            @foreach($verticals as $vertical)

                                <option
                                    value="{{ $vertical->id }}"
                                    {{ old('vertical_id',$section->vertical_id)==$vertical->id ? 'selected' : '' }}>

                                    {{ $vertical->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Status</label>

                        <select class="form-select" name="status">

                            <option value="1"
                                {{ old('status',$section->status)==1?'selected':'' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status',$section->status)==0?'selected':'' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Sort Order</label>

                        <input
                            type="number"
                            class="form-control"
                            name="sort_order"
                            value="{{ old('sort_order',$section->sort_order) }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Image Position</label>

                        <select class="form-select" name="image_position">

                            <option value="left"
                                {{ old('image_position',$section->image_position)=='left' ? 'selected' : '' }}>
                                Left
                            </option>

                            <option value="right"
                                {{ old('image_position',$section->image_position)=='right' ? 'selected' : '' }}>
                                Right
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Sub Heading</label>

                        <input
                            type="text"
                            class="form-control"
                            name="sub_heading"
                            value="{{ old('sub_heading',$section->sub_heading) }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Heading</label>

                        <input
                            type="text"
                            class="form-control"
                            name="heading"
                            value="{{ old('heading',$section->heading) }}">

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">Description</label>

                        <textarea
                            rows="6"
                            class="form-control"
                            name="description">{{ old('description',$section->description) }}</textarea>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Current Image

                        </label>

                        <br>

                        <img
                            src="{{ asset($section->image) }}"
                            id="preview"
                            class="img-thumbnail"
                            width="250">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Change Image

                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp">

                        <small class="text-muted">

                            Leave empty if you don't want to change the image.

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

$("#image").change(function(){

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