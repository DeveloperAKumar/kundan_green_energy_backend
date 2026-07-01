@extends('layouts.backend.main')
@section('main-section') 
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">User Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Profilep</li>
							</ol>
						</nav>
					</div>
					 
				</div>
				<!--end breadcrumb-->
			
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="{{asset(Auth::user()->profile_image ?? 'assets/frontend/images/default/default_user.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
												<h4>{{Auth::user()->name}}</h4>
												<p class="text-secondary mb-1">Admin</p>
												<p class="text-muted font-size-sm">{{Auth::user()->email }}</p>

												<p class="text-muted font-size-sm">{{Auth::user()->phone }}</p>
												{{-- <button class="btn btn-primary">Follow</button>
												<button class="btn btn-outline-primary">Message</button> --}}
											</div>
										</div>
										<hr class="my-4" />
										 
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
                                        <form action="{{route('admin.admin_profile_update')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Full Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{Auth::user()->name ?? ""}}"/>
                                                @error('name')
                                                     <p class="text-danger">{{$message}}</p>
                                                @enderror
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{Auth::user()->email ?? ""}}"/>
                                                @error('email')
                                                     <p class="text-danger">{{$message}}</p>
                                                @enderror
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Phone</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" value="{{Auth::user()->phone ?? ""}}"/>
                                                @error('phone')
                                                     <p class="text-danger">{{$message}}</p>
                                                @enderror
											</div>
										</div> 
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Profile</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="file" class="form-control" name="profile_image"/>
                                                @error('profile_image')
                                                     <p class="text-danger">{{$message}}</p>
                                                @enderror
											</div>
										</div>
										 
										<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9 text-secondary">
												<input type="submit" class="btn btn-primary px-4" value="Save Changes" />
											</div>
										</div>
                                    </form>
									</div>
								</div>
								 
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
                text: "Profile has been updated!",
                icon: "success"
            });
        </script> 
    @endif

@endsection
@endsection