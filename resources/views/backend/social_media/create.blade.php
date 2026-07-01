@extends('layouts.backend.main')
@section('main-section') 

<div class="page-wrapper">
			<div class="page-content">
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Social Media</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New</li>
							</ol>
						</nav>
					</div> 
				</div>
					<div class="card">
							<div class="card-header px-4 py-3">
								<h5 class="mb-0">Enter Detail</h5>
							</div>
							<div class="card-body p-4">
								<form class="row g-3" method="POST" action="{{route('backend.social_media.store')}}" enctype="multipart/form-data">
                                    @csrf
									<div class="col-md-6">
										<label for="name" class="form-label">Name<span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" placeholder="Enter Name" required>
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>   
									<div class="col-md-6">
										<label for="icon" class="form-label">Icon<span class="text-danger">*</span></label>
										<input type="text" name="icon" class="form-control" id="icon" value="{{old('icon')}}" placeholder="Enter Icon Code" required>
                                        @error('icon')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>   
									<div class="col-md-6">
										<label for="url" class="form-label">URL<span class="text-danger">*</span></label>
										<input type="text" name="url" class="form-control" id="url" value="{{old('url')}}" placeholder="Enter URL" required>
                                        @error('url')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
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