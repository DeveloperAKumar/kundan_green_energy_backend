@extends('layouts.backend.main')
@section('main-section') 

<div class="page-wrapper">
			<div class="page-content">
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Testimonial</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
							</ol>
						</nav>
					</div> 
				</div>
					<div class="card">
							<div class="card-header px-4 py-3">
								<h5 class="mb-0">Testimonial Detail</h5>
							</div>
							<div class="card-body p-4">
								<form class="row g-3" method="POST" action="{{route('backend.testimonial.update', [$testimonial->id])}}" enctype="multipart/form-data">
                                    @csrf
									<div class="col-md-6">
										<label for="name" class="form-label">Name<span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{$testimonial->name ?? ""}}" required>
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>
									<div class="col-md-6">
										<label for="designation" class="form-label">Designation<span class="text-danger">*</span></label>
										<input type="text" name="designation" class="form-control" id="designation" placeholder="Enter Designation" value="{{$testimonial->designation ?? ""}}" required>
                                        @error('designation')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>
									<div class="col-md-6">
										<label for="review" class="form-label">Review<span class="text-danger">*</span></label>
										<input type="text" name="review" class="form-control" id="review" placeholder="Enter Review" value="{{$testimonial->review ?? ""}}" required>
                                        @error('review')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>
									<div class="col-md-6">
										<label for="rating" class="form-label">Rating<span class="text-danger">*</span></label>
										<input type="text" name="rating" class="form-control" id="rating" placeholder="Enter Rating" value="{{$testimonial->rating ?? ""}}" required>
                                        @error('rating')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
									<div class="col-md-6">
										<label for="photo" class="form-label">Photo</label>
										<input type="file" class="form-control" id="photo" name="photo">
                                        @error('photo')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <img src="{{asset($testimonial->photo)}}" width="100px" class="mt-3">
									</div>      
                                    <div class="col-12 col-lg-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="1" {{$testimonial->status == 1 ? "selected":""}}>Active</option>
                                            <option value="0" {{$testimonial->status == 0 ? "selected":""}}>Inactive</option> 
                                        </select>
                                    </div>

									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-primary px-4">Submit</button>
										</div>
									</div>

								</form>
							</div>
						</div> 
			</div>
		</div> 
@section('javascript-section')
 
@endsection
@endsection