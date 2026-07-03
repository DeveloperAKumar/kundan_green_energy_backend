@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="breadcrumb-title pe-3">

                Career Enquiries

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

                            Career Enquiries

                        </li>

                    </ol>

                </nav>

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">

                    Career Enquiry List

                </h5>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table
                        class="table table-bordered align-middle"
                        id="example">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Position</th>

                                <th>Resume</th>

                                <th>Date</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($careers as $key=>$career)

                            <tr>

                                <td>

                                    {{ $key+1 }}

                                </td>

                                <td>

                                    {{ $career->name }}

                                </td>

                                <td>

                                    {{ $career->email }}

                                </td>

                                <td>

                                    {{ $career->phone }}

                                </td>

                                <td>

                                    {{ $career->position }}

                                </td>

                                <td>

                                    @if($career->resume)

                                    <a
                                        href="{{ asset($career->resume) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-primary">

                                        Download

                                    </a>

                                    @else

                                    -

                                    @endif

                                </td>

                                <td>

                                    {{ $career->created_at->format('d M Y') }}

                                </td>

                                <td>

                                    <div class="d-flex order-actions">

                                        <a
                                            href="{{ route('backend.career.view',Crypt::encrypt($career->id)) }}">

                                            <i class="bx bxs-show"></i>

                                        </a>

                                        <a
                                            href="javascript:;"
                                            class="ms-3 delete_btn"
                                            data-id="{{ $career->id }}">

                                            <i class="bx bxs-trash text-danger"></i>

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

    icon:'success',

    title:'Success',

    text:"{{ Session::get('success') }}"

});

</script>

@endif

<script>

$(document).on("click",".delete_btn",function(){

    let id=$(this).data("id");

    Swal.fire({

        title:"Delete Career Enquiry?",

        text:"This action cannot be undone.",

        icon:"warning",

        showCancelButton:true,

        confirmButtonColor:"#3085d6",

        cancelButtonColor:"#d33",

        confirmButtonText:"Yes, Delete"

    }).then(async(result)=>{

        if(result.isConfirmed){

            const response=await fetch(

                "{{ route('backend.career.destroy') }}",

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