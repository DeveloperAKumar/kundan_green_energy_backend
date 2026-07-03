@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="breadcrumb-title pe-3">

                Events

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

                            All Events

                        </li>

                    </ol>

                </nav>

            </div>

        </div>

        <div class="card">

            <div class="card-body">

                <div class="d-lg-flex align-items-center mb-4 gap-3">

                    <div class="ms-auto">

                        <a href="{{ route('backend.event.create') }}"
                            class="btn btn-primary radius-30">

                            <i class="bx bxs-plus-square"></i>

                            Add Event

                        </a>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table mb-0" id="example">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Thumbnail</th>

                                <th>Title</th>

                                <th>Date</th>

                                <th>Gallery</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($events as $index=>$event)

                            <tr>

                                <td>{{ $index+1 }}</td>

                                <td>

                                    <img
                                        src="{{ asset($event->thumbnail) }}"
                                        width="90"
                                        class="rounded">

                                </td>

                                <td>

                                    {{ $event->title }}

                                </td>

                                <td>

                                    {{ date('d M Y',strtotime($event->date)) }}

                                </td>

                                <td>

                                    <a href="{{ route('backend.event_image',$event->id) }}"
                                        class="btn btn-sm btn-info">

                                        Manage Gallery
                                        ({{ $event->images->count() }})

                                    </a>

                                </td>

                                <td>

                                    @if($event->status)

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

                                        <a href="{{ route('backend.event.edit',Crypt::encrypt($event->id)) }}">

                                            <i class="bx bxs-edit"></i>

                                        </a>

                                        <a href="javascript:;"
                                            class="ms-3 delete_btn"
                                            data-id="{{ $event->id }}">

                                            <i class="bx bxs-trash"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="7" class="text-center">

                                    No Event Found.

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

        title:"Are you sure?",

        text:"You want to delete this event?",

        icon:"warning",

        showCancelButton:true,

        confirmButtonColor:"#3085d6",

        cancelButtonColor:"#d33",

        confirmButtonText:"Yes"

    }).then(async(result)=>{

        if(result.isConfirmed){

            const response=await fetch(
                "{{ route('backend.event.destroy') }}",
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

                Swal.fire(
                    "Deleted!",
                    "Event deleted successfully.",
                    "success"
                ).then(()=>{

                    location.reload();

                });

            }

        }

    });

});

</script>

@endsection