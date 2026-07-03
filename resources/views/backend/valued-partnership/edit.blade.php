@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Valued Partnerships</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit Partnership
                        </li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="card">

            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Partnership Detail</h5>
            </div>

            <div class="card-body p-4">

                <form class="row g-3"
                    method="POST"
                    action="{{ route('backend.valued_partnership.update', Crypt::encrypt($partnership->id)) }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Current Image
                        </label>

                        <br>

                        <img
                            src="{{ asset($partnership->image) }}"
                            width="200"
                            class="img-thumbnail">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Change Image
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp">

                        <small class="text-muted">
                            Leave empty if you don't want to change the image.
                        </small>

                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>
<div class="col-md-6">

    <label class="form-label">
        Status
    </label>

    <select class="form-select" name="status">

        <option value="1" {{ $partnership->status == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0" {{ $partnership->status == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

    @error('status')
        <p class="text-danger">{{ $message }}</p>
    @enderror

</div>
                    <div class="col-md-12">

                        <button class="btn btn-primary px-4">
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection