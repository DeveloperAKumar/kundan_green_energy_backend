@extends('layouts.backend.main')
@section('main-section') 

<div class="page-wrapper">
			<div class="page-content">
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Banners</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Banner</li>
							</ol>
						</nav>
					</div> 
				</div>
					<div class="card">
							<div class="card-header px-4 py-3">
								<h5 class="mb-0">Banner Detail</h5>
							</div>
							<div class="card-body p-4">
								<form class="row g-3" method="POST" action="{{route('backend.banner.store')}}" enctype="multipart/form-data">
                                    @csrf
									<div class="col-md-6">
										<label for="heading" class="form-label">Heading<span class="text-danger">*</span></label>
									<input type="text" name="heading" class="form-control" value="{{ old('heading') }}">
                                        @error('heading')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
									<div class="col-md-6">
										<label for="sub_heading" class="form-label">Sub Heading<span class="text-danger">*</span></label>
									<input type="text" name="sub_heading" class="form-control" value="{{ old('sub_heading') }}">
                                        @error('sub_heading')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
									<div class="col-12 col-lg-6">
										<label for="banner_type" class="form-label">Banner Type</label>
									<select class="form-select" id="banner_type" name="banner_type">
										<option value="image" {{ old('banner_type') == 'image' ? 'selected' : '' }}>Image</option>
										<option value="video" {{ old('banner_type') == 'video' ? 'selected' : '' }}>Video</option>
									</select>
									</div>
									<div class="col-md-6">
    <label for="image" class="form-label">Banner File</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
    <small class="text-muted" id="fileHelp">
        Allowed: JPG, JPEG, PNG, WEBP
    </small>

    @error('image')
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>  
                                    {{-- <div class="col-md-6">
										<label for="sort_order" class="form-label">Sort Order</label>
										<input type="text" name="sort_order" class="form-control" id="sort_order" placeholder="Enter Sort Order Number">
                                        @error('sort_order')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> --}}
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
 
<script>
$(document).ready(function () {

    function updateFileInput() {
        let type = $('#banner_type').val();
        let fileInput = $('#image');

        // Clear previously selected file
        fileInput.val('');

        if (type === 'image') {
            fileInput.attr('accept', 'image/jpeg,image/png,image/jpg,image/webp');
            $('#fileHelp').text('Allowed: JPG, JPEG, PNG, WEBP');
        } else {
            fileInput.attr('accept', 'video/mp4,video/webm,video/ogg');
            $('#fileHelp').text('Allowed: MP4, WEBM, OGG');
        }
    }

    // Initial load
    updateFileInput();

    // On change
    $('#banner_type').on('change', function () {
        updateFileInput();
    });

});
</script>
@endsection
 
@endsection