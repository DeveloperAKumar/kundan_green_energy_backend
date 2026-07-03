@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">News</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            All News
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Card -->
        <div class="card">

            <div class="card-body">

                <div class="d-lg-flex align-items-center mb-4 gap-3">

                    <div class="ms-auto">
                        <a href="{{ route('backend.news.create') }}"
                           class="btn btn-primary radius-30 mt-2 mt-lg-0">
                            <i class="bx bxs-plus-square"></i>
                            Add News
                        </a>
                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table mb-0" id="example">

                        <thead class="table-light">

                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($news as $index => $item)

                            <tr>

                                <td>{{ $index + 1 }}</td>

                                <td>

                                    <img
                                        src="{{ asset($item->image) }}"
                                        width="100"
                                        height="60"
                                        style="object-fit:cover;border-radius:5px;">

                                </td>

                                <td>{{ $item->title }}</td>

                                <td>

                                    {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}

                                </td>

                                <td>

                                    @if($item->status)

                                        <span class="badge rounded-pill bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge rounded-pill bg-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex order-actions">

                                        <a href="{{ route('backend.news.edit', Crypt::encrypt($item->id)) }}">
                                            <i class="bx bxs-edit"></i>
                                        </a>

                                        <a href="javascript:;"
                                           class="ms-3 delete_btn"
                                           data-id="{{ $item->id }}">
                                            <i class="bx bxs-trash"></i>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">
                                    No News Found.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

@section('javascript-section')

@if(Session::has('success'))

<script>

Swal.fire({
    title: "Success!",
    text: "{{ Session::get('success') }}",
    icon: "success"
});

</script>

@endif

<script>

$(document).on("click",".delete_btn",function(){

    let id=$(this).data("id");

    Swal.fire({

        title:"Are you sure?",

        text:"You want to delete this news?",

        icon:"warning",

        showCancelButton:true,

        confirmButtonColor:"#3085d6",

        cancelButtonColor:"#d33",

        confirmButtonText:"Yes, Delete"

    }).then(async(result)=>{

        if(result.isConfirmed){

            try{

                const response=await fetch("{{ route('backend.news.destroy') }}",{

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

                    Swal.fire(

                        "Deleted!",

                        "News deleted successfully.",

                        "success"

                    ).then(()=>{

                        location.reload();

                    });

                }else{

                    Swal.fire(

                        "Error",

                        data.message,

                        "error"

                    );

                }

            }catch(error){

                Swal.fire(

                    "Error",

                    "Something went wrong.",

                    "error"

                );

            }

        }

    });

});

</script>

@endsection
@endsection