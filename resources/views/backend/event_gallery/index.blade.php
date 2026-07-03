@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->

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

                            {{ $event->title }}

                        </li>

                    </ol>

                </nav>

            </div>

        </div>

        <!-- Upload Card -->

        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0">

                    Upload Gallery Images

                </h5>

            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('backend.event_image.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <input
                        type="hidden"
                        name="event_id"
                        value="{{ $event->id }}">

                    <div class="row">

                        <div class="col-md-4">

                            <label>

                                Album Name

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="album_name"
                                placeholder="Example : Day 1">

                            @error('album_name')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                            @enderror

                        </div>

                        <div class="col-md-5">

                            <label>

                                Select Images

                            </label>

                            <input
                                type="file"
                                class="form-control"
                                name="images[]"
                                id="images"
                                multiple>

                            @error('images')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                            @enderror

                        </div>

                        <div class="col-md-3 d-flex align-items-end">

                            <button
                                class="btn btn-primary w-100">

                                Upload Images

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <!-- Gallery -->

        <div class="card">

            <div class="card-header">

                <h5>

                    Uploaded Images

                </h5>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table
                        class="table"
                        id="example">

                        <thead>

                        <tr>

                            <th>#</th>

                            <th>Preview</th>

                            <th>Album</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($images as $key=>$image)

                        <tr>

                            <td>

                                {{ $key+1 }}

                            </td>

                            <td>

                                <img
                                    src="{{ asset($image->image) }}"
                                    width="90"
                                    class="rounded">

                            </td>

                            <td>

                                {{ $image->album_name }}

                            </td>

                            <td>

                                @if($image->status)

                                <span class="badge bg-success">

                                    Active

                                </span>

                                @else

                                <span class="badge bg-danger">

                                    Inactive

                                </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex order-actions">

                                    <a href="{{ route('backend.event_image.edit',Crypt::encrypt($image->id)) }}">

                                        <i class="bx bxs-edit"></i>

                                    </a>

                                    <a
                                        href="javascript:;"
                                        class="ms-3 delete_btn"
                                        data-id="{{ $image->id }}">

                                        <i class="bx bxs-trash"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('javascript-section')

@if(Session::has('success'))

<script>

Swal.fire({

    title:"Success!",

    text:"{{ Session::get('success') }}",

    icon:"success"

});

</script>

@endif

<script>

$(document).on("click",".delete_btn",function(){

    let id=$(this).data("id");

    Swal.fire({

        title:"Delete Image?",

        icon:"warning",

        showCancelButton:true

    }).then(async(result)=>{

        if(result.isConfirmed){

            const response=await fetch(

                "{{ route('backend.event_image.destroy') }}",

            {

                method:"DELETE",

                headers:{

                    "Content-Type":"application/json",

                    "X-CSRF-TOKEN":"{{ csrf_token() }}"

                },

                body:JSON.stringify({

                    id:id

                })

            });

            const data=await response.json();

            if(data.status){

                location.reload();

            }

        }

    });

});

</script>

@endsection