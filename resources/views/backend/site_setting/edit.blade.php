@extends('layouts.backend.main')
@section('main-section') 

<div class="page-wrapper">
			<div class="page-content">
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Site Setting</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Site Setting</li>
							</ol>
						</nav>
					</div> 
				</div>
					<div class="card">
							<div class="card-header px-4 py-3">
								<h5 class="mb-0">Site Detail</h5>
							</div>
							<div class="card-body p-4">
								<form class="row g-3" method="POST" action="{{route('backend.site_setting.update')}}" enctype="multipart/form-data">
                                    @csrf
									<div class="col-md-6">
										<label for="company_name" class="form-label">Company Name</label>
										<input type="text" name="company_name" class="form-control" id="company_name" value="{{ old('company_name') ?? $setting->company_name }}" placeholder="Enter Company Name">
                                        @error('company_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>   
									<div class="col-md-6">
										<label for="primary_phone" class="form-label">Phone Number</label>
										<input type="text" name="primary_phone" class="form-control" id="primary_phone" value="{{old('primary_phone') ?? $setting->primary_phone }}" placeholder="Enter Phone Number">
                                        @error('primary_phone')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>   
									<div class="col-md-6">
										<label for="primary_email" class="form-label">Email</label>
										<input type="text" name="primary_email" class="form-control" id="primary_email" value="{{old('primary_email') ?? $setting->primary_email }}" placeholder="Enter Email">
                                        @error('primary_email')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>   
                                    <div class="col-md-6">
										<label for="copyright_text" class="form-label">Copyright Text</label>
										<input type="text" name="copyright_text" class="form-control" id="copyright_text" value="{{old('copyright_text') ?? $setting->copyright_text }}" placeholder="Enter Copyright Text">
                                        @error('copyright_text')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>  
									<div class="col-md-6">
										<label for="logo_image" class="form-label">Company Logo</label>
										<input type="file" name="logo_image" class="form-control" id="logo_image" value="{{old('logo_image')}}">
                                        @error('logo_image')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <img src="{{asset($setting->logo_image)}}" width="150px" class="mt-3">
									</div>   
									<div class="col-md-6">
										<label for="favicon" class="form-label">Company Favicon</label>
										<input type="file" name="favicon" class="form-control" id="favicon" value="{{old('favicon')}}">
                                        @error('favicon')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <img src="{{asset($setting->favicon)}}" width="50px;" class="mt-3">
									</div>   
                                      <div class="col-md-6">
										<label for="address" class="form-label">Address</label>
										<textarea class="form-control" id="address" name="address" value="{{old('address')}}" placeholder="Enter Address" rows="3">{{ old('address')  ?? $setting->address }}</textarea> 
                                        @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
                                    
                                    <div class="col-md-6">
										<label for="google_map" class="form-label">Google Map</label>
										<textarea class="form-control" id="google_map" name="google_map" value="{{old('google_map')}}" placeholder="Enter Google Map Embed Code" rows="3">{{ old('google_map') ?? $setting->google_map }}</textarea> 
                                        @error('google_map')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>

                                      
                                    <div class="card-header px-4 py-3">
                                        <h5 class="mb-0">SEO Detail</h5>
                                    </div>
                                    <div class="col-md-12">
										<label for="title" class="form-label">Meta Title</label>
										<input type="text" class="form-control" id="title" name="meta_title" value="{{old('meta_title') ?? $setting->meta_title }}" placeholder="Enter Meta Title">
                                        @error('meta_title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
                                    <div class="col-md-6">
										<label for="content" class="form-label">Meta Keyword</label>
										<textarea class="form-control" id="content" name="meta_keyword" placeholder="Enter Meta Keyword" rows="3">{{old('meta_keyword') ?? $setting->meta_keyword }}</textarea> 
                                        @error('meta_keyword')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
                                    <div class="col-md-6">
										<label for="content" class="form-label">Meta Description</label>
										<textarea class="form-control" id="content" name="meta_description" placeholder="Enter Meta Description" rows="3">{{old('meta_description') ?? $setting->meta_description }}</textarea> 
                                        @error('meta_description')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>  
									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-primary px-4">Update</button>
										</div>
									</div>

								</form>
							</div>
						</div> 
			</div>
		</div> 
@section('javascript-section')
    @if(Session::has('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "Setting has been updated!",
                icon: "success"
            });
        </script> 
    @endif

@endsection
@endsection