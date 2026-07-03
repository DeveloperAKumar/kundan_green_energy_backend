@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Main Gallery</div>
            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Add Gallery Images
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                <h5 class="mb-0">Upload Gallery Images</h5>
            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('backend.main_gallery.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Select Images
                            <span class="text-danger">*</span>
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

                            <p class="text-danger">

                                {{ $message }}

                            </p>

                        @enderror

                        @error('images.*')

                            <p class="text-danger">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>

                    <div class="row" id="preview-container"></div>

                    <button class="btn btn-primary">

                        Upload Images

                    </button>

                </form>

            </div>

        </div>

    </div>
</div>

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

@endsection