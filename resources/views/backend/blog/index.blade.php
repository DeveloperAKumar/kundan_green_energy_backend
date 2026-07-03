@extends('layouts.backend.main')
@section('main-section') 

<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Blogs</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Blogs</li>
							</ol>
						</nav>
					</div>
					{{-- <div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div> --}}
				</div>
				<!--end breadcrumb--> 
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							{{-- <div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div> --}}
						  <div class="ms-auto"><a href="{{route('backend.blog.create')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Blog</a></div>
						</div>
						<div class="table-responsive">
							<table class="table mb-0" id="example">
								<thead class="table-light">
									<tr>
										<th>#</th>
										<th>Thumbnail</th>
										<th>Title</th>
										<th>Status</th> 
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
                                     @forelse($blogs as $index => $blog)
									<tr>
										<td>{{ $index + 1 }}</td>
										<td><img src="{{asset($blog->thumbnail)}}" width="100px"></td> 
                                        <td>{{$blog->title ?? ""}}</td>
										<td>
                                            @if($blog->status)
                                                <span class="badge rounded-pill bg-success" data-field="status">
                                                    Active
                                                </span>
                                                @else
                                                <span class="badge rounded-pill bg-danger" data-field="status">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
										<td>
											<div class="d-flex order-actions">
												<a href="{{route('backend.blog.edit', [Crypt::encrypt($blog->id)])}}" class=""><i class='bx bxs-edit'></i></a>
												<a href="javascript:;" class="ms-3 delete_btn" data-id="{{$blog->id}}"><i class='bx bxs-trash'></i></a>
											</div>
										</td>
									</tr>
									@empty
                                    <tr>
                                        <td colspan="5" class="text-center">No blog found.</td>
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
        text: "Blog has been created!",
        icon: "success"
    });
</script> 
@endif

<script>
    $(document).on("click", ".delete_btn", function(){
        console.log('clicked');
        let id = $(this).data("id");
        let url = "{{ route('backend.blog.destroy')}}";
        let csrf_token = "{{ csrf_token() }}";
        Swal.fire({
             title: "Are you sure?",
            text: "You want to delete it?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(async function(result){
            if(result.isConfirmed){
                try{
                    const response = await fetch(url, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrf_token
                        },
                        body: JSON.stringify({id: id})
                    });
                    const data = await response.json();
                    if(data.status){
                        Swal.fire(
                            "Deleted!",
                            "Blog has been deleted successfully.",
                            "success"
                        ).then(() => {
                            window.location.reload();
                        });
                    }else{
                        Swal.fire(
                            "Error",
                            data.message || "Something went wrong",
                            "error"
                        );
                    }
                }catch(error){
                    console.log(error);
                    Swal.fire("Error", "Request failed.", "error");
                }
            }
        });
    });
</script>

@endsection
@endsection