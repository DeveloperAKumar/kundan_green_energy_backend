@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Projects</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Add New Project
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Project Details</h5>
            </div>

            <div class="card-body p-4">

                <form
                    class="row g-3"
                    method="POST"
                    action="{{ route('backend.project.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ old('title') }}">

                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Category <span class="text-danger">*</span>
                        </label>

                        <select
                            class="form-select"
                            name="category">

                            <option value="">Select Category</option>

                            <option value="Hydro Power"
                                {{ old('category')=='Hydro Power' ? 'selected' : '' }}>
                                Hydro Power
                            </option>

                            <option value="Solar Energy"
                                {{ old('category')=='Solar Energy' ? 'selected' : '' }}>
                                Solar Energy
                            </option>

                            <option value="Waste to Energy"
                                {{ old('category')=='Waste to Energy' ? 'selected' : '' }}>
                                Waste to Energy
                            </option>

                            <option value="Energy Storage System"
                                {{ old('category')=='Energy Storage System' ? 'selected' : '' }}>
                                Energy Storage System
                            </option> 
                        </select> 
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Capacity <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="capacity"
                            value="{{ old('capacity') }}">

                        @error('capacity')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Location <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="location"
                            value="{{ old('location') }}">

                        @error('location')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Established <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="established"
                            value="{{ old('established') }}"
                            placeholder="Example : 2018">

                        @error('established')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Description <span class="text-danger">*</span>
                        </label>

                        <textarea
                            class="form-control"
                            rows="5"
                            name="description">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Project Images <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="images"
                            name="images[]"
                            multiple
                            accept="image/jpeg,image/png,image/jpg,image/webp">

                        <small class="text-muted">

                            You can select multiple images.

                        </small>

                        @error('images')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        @error('images.*')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <div class="row" id="preview-container"></div>

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

$("#images").change(function(){

    $("#preview-container").html("");

    let files=this.files;

    for(let i=0;i<files.length;i++){

        let reader=new FileReader();

        reader.onload=function(e){

            $("#preview-container").append(

                `<div class="col-md-2 mb-3">

                    <img
                        src="${e.target.result}"
                        class="img-fluid rounded border"
                        style="height:150px;width:100%;object-fit:cover;">

                </div>`

            );

        }

        reader.readAsDataURL(files[i]);

    }

});

</script>

@endsection