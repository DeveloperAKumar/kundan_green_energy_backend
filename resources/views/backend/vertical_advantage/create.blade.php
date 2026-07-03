@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vertical Advantages</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Add New Advantage
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Advantage Details</h5>
            </div>

            <div class="card-body p-4">

                <form class="row g-3"
                    method="POST"
                    action="{{ route('backend.vertical_advantage.store') }}">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Vertical <span class="text-danger">*</span>
                        </label>

                        <select class="form-select" name="vertical_id">

                            <option value="">Select Vertical</option>

                            @foreach($verticals as $vertical)

                                <option value="{{ $vertical->id }}"
                                    {{ old('vertical_id')==$vertical->id ? 'selected' : '' }}>

                                    {{ $vertical->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('vertical_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            name="sort_order"
                            value="{{ old('sort_order',1) }}">

                        @error('sort_order')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ old('title') }}">

                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Description <span class="text-danger">*</span>
                        </label>

                        <textarea
                            class="form-control"
                            rows="6"
                            name="description">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <button
                            type="submit"
                            class="btn btn-primary px-4">

                            Submit

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection