@extends('layouts.backend.main')

@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Blogs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Edit Blog</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Blog Detail</h5>
            </div>

            <div class="card-body p-4">

                <form class="row g-3"
                    method="POST"
                    action="{{ route('backend.blog.update', $blog->id) }}"
                    enctype="multipart/form-data">

                    @csrf 

                    <input type="hidden" name="id" value="{{ $blog->id }}">

                    <div class="col-md-6">
                        <label class="form-label">
                            Blog Title
                            <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                            class="form-control"
                            name="blog_title"
                            value="{{ old('blog_title',$blog->title) }}"
                            placeholder="Enter Blog Title">

                        @error('blog_title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Thumbnail</label>

                        <input type="file"
                            class="form-control"
                            name="thumbnail">

                        @if($blog->thumbnail)
                            <div class="mt-2">
                                <img src="{{ asset($blog->thumbnail) }}"
                                    width="120"
                                    class="img-thumbnail">
                            </div>
                        @endif

                        @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" {{$blog->status == 1 ? "selected":""}}>Active</option>
                            <option value="0" {{$blog->status == 0 ? "selected":""}}>Inactive</option> 
                        </select>
				    </div>
 
                    <div class="col-md-12">
                        <label class="form-label">
                            Content
                            <span class="text-danger">*</span>
                        </label>

                        <textarea
                            class="form-control text_editor"
                            name="content"
                            rows="8">{{ old('content',$blog->content) }}</textarea>

                        @error('content')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="card-header mt-3">
                        <h5>SEO Detail</h5>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Meta Title</label>

                        <input type="text"
                            class="form-control"
                            name="meta_title"
                            value="{{ old('meta_title',$blog->meta_title) }}"
                            placeholder="Meta Title">

                        @error('meta_title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Meta Keyword</label>
                        <textarea class="form-control" rows="4" name="meta_keyword">{{ old('meta_keyword',$blog->meta_keyword) }}</textarea>
                        @error('meta_keyword')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control" rows="4" name="meta_description">{{ old('meta_description',$blog->meta_description) }}</textarea>
                        @error('meta_description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary">
                            Update Blog
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection


@section('javascript-section')

<script>
initTinyMCE();
function initTinyMCE() {
    tinymce.init({
        selector: '.text_editor',
        height: 400,
        plugins: 'advlist autolink lists link image charmap preview table code',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image table | code',
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });
}
</script>

@endsection