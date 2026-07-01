@extends('layouts.backend.main')
@section('main-section') 

<div class="page-wrapper">
			<div class="page-content">
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Other Page</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add New Page</li>
							</ol>
						</nav>
					</div> 
				</div>
					<div class="card">
							<div class="card-header px-4 py-3">
								<h5 class="mb-0">Page Detail</h5>
							</div>
							<div class="card-body p-4">
								<form class="row g-3" method="POST" action="{{route('backend.other_page.store')}}" enctype="multipart/form-data">
                                    @csrf
									<div class="col-md-6">
										<label for="page_name" class="form-label">Page Name<span class="text-danger">*</span></label>
										<input type="text" name="page_name" class="form-control" id="page_name" value="{{old('page_name')}}" placeholder="Enter Page Name" required>
                                        @error('page_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div>   
                                    <div class="col-md-12">
										<label for="content" class="form-label">Content<span class="text-danger">*</span></label>
										<textarea class="form-control text_editor" id="content" name="content" placeholder="Content ..." rows="3" required>{{old('page_name')}}</textarea> 
                                        @error('content')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 

                                    <div class="card-header px-4 py-3">
                                        <h5 class="mb-0">SEO Detail</h5>
                                    </div>
                                    <div class="col-md-12">
										<label for="title" class="form-label">Meta Title</label>
										<input type="text" class="form-control" id="title" name="meta_title" value="{{old('page_name')}}" placeholder="Enter Meta Title">
                                        @error('meta_title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
                                    <div class="col-md-6">
										<label for="content" class="form-label">Meta Keyword</label>
										<textarea class="form-control" id="content" name="meta_keyword" value="{{old('page_name')}}" placeholder="Enter Meta Keyword" rows="3"></textarea> 
                                        @error('meta_keyword')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
									</div> 
                                    <div class="col-md-6">
										<label for="content" class="form-label">Meta Description</label>
										<textarea class="form-control" id="content" name="meta_description" placeholder="Enter Meta Description" rows="3">{{old('page_name')}}</textarea> 
                                        @error('meta_description')
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