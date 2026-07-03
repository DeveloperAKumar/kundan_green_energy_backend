@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Banners</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit Banner
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                <h5>Edit Banner</h5>
            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('backend.banner.update', Crypt::encrypt($banner->id)) }}"
                      enctype="multipart/form-data">

                    @csrf 

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Heading</label>

                            <input
                                type="text"
                                class="form-control"
                                name="heading"
                                value="{{ old('heading',$banner->heading) }}">

                            @error('heading')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Sub Heading</label>

                            <input
                                type="text"
                                class="form-control"
                                name="sub_heading"
                                value="{{ old('sub_heading',$banner->sub_heading) }}">

                            @error('sub_heading')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Banner Type</label>

                            <select
                                class="form-select"
                                name="banner_type"
                                id="banner_type">

                                <option value="image"
                                    {{ old('banner_type',$banner->type)=='image' ? 'selected' : '' }}>
                                    Image
                                </option>

                                <option value="video"
                                    {{ old('banner_type',$banner->type)=='video' ? 'selected' : '' }}>
                                    Video
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Banner File</label>

                            <input
                                type="file"
                                class="form-control"
                                id="image"
                                name="image">

                            <small class="text-muted" id="fileHelp"></small>

                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-4">

                            <label>Current File</label>

                            <br>

                            @if($banner->type=='image')

                                <img src="{{ asset($banner->file) }}"
                                     width="220"
                                     class="img-thumbnail">

                            @else

                                <video width="220" controls>
                                    <source src="{{ asset($banner->file) }}">
                                </video>

                            @endif

                        </div>

                        <div class="col-md-12">

                            <button class="btn btn-primary">
                                Update Banner
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@section('javascript-section')

<script>

$(function(){

    function updateFileInput(){

        let type=$("#banner_type").val();

        if(type=="image"){

            $("#image").attr("accept","image/jpeg,image/png,image/jpg,image/webp");

            $("#fileHelp").text("Allowed : JPG, JPEG, PNG, WEBP");

        }else{

            $("#image").attr("accept","video/mp4,video/webm,video/ogg");

            $("#fileHelp").text("Allowed : MP4, WEBM, OGG");

        }

    }

    updateFileInput();

    $("#banner_type").change(function(){

        updateFileInput();

    });

});

</script>

@endsection
@endsection