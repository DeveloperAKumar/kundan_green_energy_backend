@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                Projects
            </div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit Project
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                <h5>Project Details</h5>
            </div>

            <div class="card-body">

                <form
                    class="row g-3"
                    method="POST"
                    action="{{ route('backend.project.update', Crypt::encrypt($project->id)) }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">
                        <label>Title</label>

                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ old('title',$project->title) }}">
                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Category
                        </label>

                        <select
                            class="form-select"
                            name="category">

                            <option value="">Select Category</option>

                            <option value="Hydro Power"
                                {{ old('category',$project->category)=='Hydro Power' ? 'selected' : '' }}>
                                Hydro Power
                            </option>

                            <option value="Solar Energy"
                                {{ old('category',$project->category)=='Solar Energy' ? 'selected' : '' }}>
                                Solar Energy
                            </option>

                            <option value="Waste to Energy"
                                {{ old('category',$project->category)=='Waste to Energy' ? 'selected' : '' }}>
                                Waste to Energy
                            </option>

                            <option value="Energy Storage System"
                                {{ old('category',$project->category)=='Energy Storage System' ? 'selected' : '' }}>
                                Energy Storage System
                            </option> 
                        </select>

                    </div>

                    <div class="col-md-6">
                        <label>Capacity</label>

                        <input
                            type="text"
                            class="form-control"
                            name="capacity"
                            value="{{ old('capacity',$project->capacity) }}">
                    </div>

                    <div class="col-md-6">
                        <label>Location</label>

                        <input
                            type="text"
                            class="form-control"
                            name="location"
                            value="{{ old('location',$project->location) }}">
                    </div>

                    <div class="col-md-6">
                        <label>Established</label>

                        <input
                            type="text"
                            class="form-control"
                            name="established"
                            value="{{ old('established',$project->established) }}">
                    </div>

                    <div class="col-md-6">

                        <label>Status</label>

                        <select
                            class="form-select"
                            name="status">

                            <option
                                value="1"
                                {{ $project->status ? 'selected' : '' }}>

                                Active

                            </option>

                            <option
                                value="0"
                                {{ !$project->status ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                    <div class="col-md-12">

                        <label>Description</label>

                        <textarea
                            rows="5"
                            class="form-control"
                            name="description">{{ old('description',$project->description) }}</textarea>

                    </div>

                    <div class="col-md-12">

                        <label>

                            Existing Images

                        </label>

                        <div class="row">

                            @foreach($project->images as $image)

                            <div
                                class="col-md-2 mb-3 image-box">

                                <img
                                    src="{{ asset($image->image) }}"
                                    class="img-fluid rounded border">

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm mt-2 delete-image"
                                    data-id="{{ $image->id }}">

                                    Delete

                                </button>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="col-md-12">

                        <label>

                            Upload More Images

                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="images"
                            multiple
                            name="images[]">

                    </div>

                    <div
                        class="col-md-12">

                        <div
                            class="row"
                            id="preview-container">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <button
                            class="btn btn-primary">

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
                        class="img-fluid rounded border">

                </div>`

            );

        }

        reader.readAsDataURL(files[i]);

    }

});

$(document).on("click",".delete-image",function(){

    let button=$(this);

    Swal.fire({

        title:"Delete Image?",

        icon:"warning",

        showCancelButton:true,

    }).then(async(result)=>{

        if(result.isConfirmed){

            const response=await fetch(
                "{{ route('backend.project.image.destroy') }}",
            {

                method:"DELETE",

                headers:{

                    "Content-Type":"application/json",

                    "X-CSRF-TOKEN":"{{ csrf_token() }}"

                },

                body:JSON.stringify({

                    id:button.data("id")

                })

            });

            const data=await response.json();

            if(data.status){

                button.closest(".image-box").remove();

            }

        }

    });

});

</script>

@endsection