@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">About Page</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit About Page
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <form method="POST"
              action="{{ route('backend.about_page.update') }}"
              enctype="multipart/form-data">

            @csrf

            <!-- ================= WHO WE ARE ================= -->

            <div class="card mb-4">

                <div class="card-header">
                    <h5 class="mb-0">Who We Are</h5>
                </div>

                <div class="card-body row g-3">

                    <div class="col-md-6">

                        <label>Small Heading</label>

                        <input
                            type="text"
                            name="who_we_are_small_heading"
                            class="form-control"
                            value="{{ old('who_we_are_small_heading',$about->who_we_are_small_heading) }}">

                    </div>

                    <div class="col-md-6">

                        <label>Heading</label>

                        <input
                            type="text"
                            name="who_we_are_heading"
                            class="form-control"
                            value="{{ old('who_we_are_heading',$about->who_we_are_heading) }}">

                    </div>

                    <div class="col-md-12">

                        <label>Description</label>

                        <textarea
                            name="who_we_are_description"
                            rows="6"
                            class="form-control">{{ old('who_we_are_description',$about->who_we_are_description) }}</textarea>

                    </div>

                    <div class="col-md-6">

                        <label>Image</label>

                        <input
                            type="file"
                            id="who_image"
                            name="who_we_are_image"
                            class="form-control">

                    </div>

                    <div class="col-md-6">

                        <img
                            id="who_preview"
                            src="{{ $about->who_we_are_image ? asset($about->who_we_are_image) : '' }}"
                            style="max-width:220px;{{ $about->who_we_are_image ? '' : 'display:none;' }}"
                            class="img-thumbnail">

                    </div>

                </div>

            </div>

            <!-- ================= VISION ================= -->

            <div class="card mb-4">

                <div class="card-header">
                    <h5 class="mb-0">Vision</h5>
                </div>

                <div class="card-body row g-3">

                    <div class="col-md-6">

                        <label>Small Heading</label>

                        <input
                            type="text"
                            name="vision_small_heading"
                            class="form-control"
                            value="{{ old('vision_small_heading',$about->vision_small_heading) }}">

                    </div>

                    <div class="col-md-6">

                        <label>Heading</label>

                        <input
                            type="text"
                            name="vision_heading"
                            class="form-control"
                            value="{{ old('vision_heading',$about->vision_heading) }}">

                    </div>

                    <div class="col-md-12">

                        <label>Description</label>

                        <textarea
                            rows="6"
                            name="vision_description"
                            class="form-control">{{ old('vision_description',$about->vision_description) }}</textarea>

                    </div>

                    <div class="col-md-6">

                        <label>Image</label>

                        <input
                            type="file"
                            id="vision_image"
                            name="vision_image"
                            class="form-control">

                    </div>

                    <div class="col-md-6">

                        <img
                            id="vision_preview"
                            src="{{ $about->vision_image ? asset($about->vision_image) : '' }}"
                            style="max-width:220px;{{ $about->vision_image ? '' : 'display:none;' }}"
                            class="img-thumbnail">

                    </div>

                </div>

            </div>

            <!-- ================= MISSION ================= -->

            <div class="card mb-4">

                <div class="card-header">
                    <h5 class="mb-0">Mission</h5>
                </div>

                <div class="card-body row g-3">

                    <div class="col-md-6">

                        <label>Small Heading</label>

                        <input
                            type="text"
                            name="mission_small_heading"
                            class="form-control"
                            value="{{ old('mission_small_heading',$about->mission_small_heading) }}">

                    </div>

                    <div class="col-md-6">

                        <label>Heading</label>

                        <input
                            type="text"
                            name="mission_heading"
                            class="form-control"
                            value="{{ old('mission_heading',$about->mission_heading) }}">

                    </div>

                    <div class="col-md-12">

                        <label>Description</label>

                        <textarea
                            rows="6"
                            name="mission_description"
                            class="form-control">{{ old('mission_description',$about->mission_description) }}</textarea>

                    </div>

                    <div class="col-md-6">

                        <label>Image</label>

                        <input
                            type="file"
                            id="mission_image"
                            name="mission_image"
                            class="form-control">

                    </div>

                    <div class="col-md-6">

                        <img
                            id="mission_preview"
                            src="{{ $about->mission_image ? asset($about->mission_image) : '' }}"
                            style="max-width:220px;{{ $about->mission_image ? '' : 'display:none;' }}"
                            class="img-thumbnail">

                    </div>

                </div>

            </div>

            <!-- ================= STATUS ================= -->

            <div class="card">

                <div class="card-body row align-items-center"> 

                    <div class="col-md-8 text-end">

                        <button
                            class="btn btn-primary px-5">

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

<script>

function preview(input, preview){

    if(input.files && input.files[0]){

        let reader = new FileReader();

        reader.onload = function(e){

            $(preview)
                .attr("src",e.target.result)
                .show();

        }

        reader.readAsDataURL(input.files[0]);

    }

}

$("#who_image").change(function(){

    preview(this,"#who_preview");

});

$("#vision_image").change(function(){

    preview(this,"#vision_preview");

});

$("#mission_image").change(function(){

    preview(this,"#mission_preview");

});

</script>

@if(Session::has('success'))

<script>

Swal.fire({

    title:"Success!",

    text:"{{ Session::get('success') }}",

    icon:"success"

});

</script>

@endif

@endsection