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
                            Edit Event
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
                      action="{{ route('backend.event.update',Crypt::encrypt($event->id)) }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Event Title
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ old('title',$event->title) }}">

                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Event Date
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="date"
                            value="{{ old('date',$event->date) }}">

                        @error('date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            rows="6"
                            class="form-control"
                            name="description">{{ old('description',$event->description) }}</textarea>

                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
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
                                {{ old('status',$event->status)==1 ? 'selected' : '' }}>

                                Active

                            </option>

                            <option value="0"
                                {{ old('status',$event->status)==0 ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Change Thumbnail
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

                    <div class="col-md-12">

                        <label class="form-label">
                            Current Thumbnail
                        </label>

                        <br>

                        <img
                            id="preview"
                            src="{{ asset($event->thumbnail) }}"
                            class="img-thumbnail"
                            style="width:250px;">

                    </div>

                    <div class="col-md-12">

                        <button
                            type="submit"
                            class="btn btn-primary px-5">

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

$("#thumbnail").change(function(){

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