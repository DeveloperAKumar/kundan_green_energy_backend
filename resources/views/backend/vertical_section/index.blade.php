@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vertical Sections</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            All Vertical Sections
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-body">

                <div class="d-lg-flex align-items-center mb-4 gap-3">

                    <div class="ms-auto">

                        <a href="{{ route('backend.vertical_section.create') }}"
                            class="btn btn-primary radius-30">

                            <i class="bx bxs-plus-square"></i>

                            Add Section

                        </a>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table mb-0" id="example">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>Vertical</th>

                                <th>Image</th>

                                <th>Heading</th>

                                <th>Image Position</th>

                                <th>Sort Order</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($sections as $index => $section)

                            <tr>

                                <td>{{ $index + 1 }}</td>

                                <td>

                                    {{ $section->vertical->name ?? '-' }}

                                </td>

                                <td>

                                    <img
                                        src="{{ asset($section->image) }}"
                                        width="120"
                                        height="70"
                                        style="object-fit:cover;border-radius:6px;">

                                </td>

                                <td>

                                    {{ $section->heading }}

                                </td>

                                <td>

                                    @if($section->image_position=='left')

                                    <span class="badge bg-primary">

                                        Left

                                    </span>

                                    @else

                                    <span class="badge bg-warning text-dark">

                                        Right

                                    </span>

                                    @endif

                                </td>

                                <td>

                                    {{ $section->sort_order }}

                                </td>

                                <td>

                                    @if($section->status)

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

                                        <a href="{{ route('backend.vertical_section.edit', Crypt::encrypt($section->id)) }}">

                                            <i class='bx bxs-edit'></i>

                                        </a>

                                        <a href="javascript:;"
                                            class="ms-3 delete_btn"
                                            data-id="{{ $section->id }}">

                                            <i class='bx bxs-trash'></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="8" class="text-center">

                                    No Section Found.

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
$(document).on("click", ".delete_btn", function() {

    let id = $(this).data("id");

    Swal.fire({

        title: "Are you sure?",

        text: "You want to delete this section?",

        icon: "warning",

        showCancelButton: true,

        confirmButtonColor: "#3085d6",

        cancelButtonColor: "#d33",

        confirmButtonText: "Yes, Delete"

    }).then(async (result) => {

        if (result.isConfirmed) {

            try {

                const response = await fetch(
                    "{{ route('backend.vertical_section.destroy') }}", {

                        method: "DELETE",

                        headers: {

                            "Content-Type": "application/json",

                            "X-CSRF-TOKEN": "{{ csrf_token() }}"

                        },

                        body: JSON.stringify({

                            id: id

                        })

                    });

                const data = await response.json();

                if (data.status) {

                    Swal.fire(

                        "Deleted!",

                        "Section deleted successfully.",

                        "success"

                    ).then(() => {

                        location.reload();

                    });

                } else {

                    Swal.fire(

                        "Error",

                        data.message,

                        "error"

                    );

                }

            } catch (error) {

                Swal.fire(

                    "Error",

                    "Request failed.",

                    "error"

                );

            }

        }

    });

});
</script>

@endsection
@endsection