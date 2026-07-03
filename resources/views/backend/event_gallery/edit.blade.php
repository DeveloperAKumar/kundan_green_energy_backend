@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="breadcrumb-title pe-3">

                Event Gallery

            </div>

            <div class="ps-3">

                <nav>

                    <ol class="breadcrumb mb-0 p-0">

                        <li class="breadcrumb-item">

                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="{{ route('backend.event') }}">

                                Events

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Edit Image

                        </li>

                    </ol>

                </nav>

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <h5>Edit Gallery Image</h5>

            </div>

            <div class="card-body">

                <form
                    class="row g-3"
                    method="POST"
                    action="{{ route('backend.event_image.update',Crypt::encrypt($image->id)) }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">

                            Album Name

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="album_name"
                            value="{{ old('album_name',$image->album_name) }}">

                        @error('album_name')

                        <small class="text-danger">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            class="form-select"
                            name="status">

                            <option
                                value="1"
                                {{ old('status',$image->status)==1 ? 'selected' : '' }}>

                                Active

                            </option>

                            <option
                                value="0"
                                {{ old('status',$image->status)==0 ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

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
                            accept="image/*">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Current Image

                        </label>

                        <br>

                        <img
                            id="preview"
                            src="{{ asset($image->image) }}"
                            width="220"
                            class="img-thumbnail">

                    </div>

                    <div class="col-md-12">

                        <button
                            class="btn btn-primary px-5">

                            Update

                        </button>

                        <a
                            href="{{ route('backend.event_image',$image->event_id) }}"
                            class="btn btn-secondary">

                            Back

                        </a>

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