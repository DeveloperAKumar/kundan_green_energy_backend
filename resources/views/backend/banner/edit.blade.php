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
								<li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
							</ol>
						</nav>
					</div> 
				</div>
					<div class="card">
							<div class="card-header px-4 py-3">
								<h5 class="mb-0">Banner Detail</h5>
							</div>
							<div class="card-body p-4">
								<form class="row g-3" method="POST" action="{{route('backend.banner.update', [$banner->id])}}" enctype="multipart/form-data">
                                    @csrf
									<div class="col-md-6">
										<label for="name" class="form-label">Banner Name<span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control" id="name" placeholder="Enter Banner Name" value="{{$banner->name ?? ""}}" required>
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
									<div class="col-md-6">
										<label for="image" class="form-label">Banner Image</label>
										<input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <img src="{{asset($banner->image)}}" width="100px;" class="mt-3">
									</div>  
                                    <div class="col-md-6">
										<label for="sort_order" class="form-label">Sort Order</label>
										<input type="text" name="sort_order" class="form-control" id="sort_order" value="{{$banner->sort_order ?? ""}}" placeholder="Enter Sort Order Number">
                                        @error('sort_order')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>
                                    <div class="col-12 col-lg-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" {{$banner->status == 1 ? "selected":""}}>Active</option>
                            <option value="0" {{$banner->status == 0 ? "selected":""}}>Inactive</option> 
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
<script>
     // TinyMCE
    initTinyMCE();
    function initTinyMCE() {
        tinymce.init({
            selector: '.text_editor',
            height: 400,
            plugins: 'advlist autolink lists link image charmap print preview anchor table',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat | link table',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    }
</script>
@endsection
@endsection