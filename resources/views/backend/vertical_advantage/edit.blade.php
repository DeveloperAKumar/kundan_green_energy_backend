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
                            Edit Advantage
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
                    action="{{ route('backend.vertical_advantage.update', Crypt::encrypt($advantage->id)) }}">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Vertical
                        </label>

                        <select class="form-select" name="vertical_id">

                            @foreach($verticals as $vertical)

                                <option
                                    value="{{ $vertical->id }}"
                                    {{ old('vertical_id',$advantage->vertical_id)==$vertical->id ? 'selected' : '' }}>

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
                            Status
                        </label>

                        <select class="form-select" name="status">

                            <option
                                value="1"
                                {{ old('status',$advantage->status)==1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option
                                value="0"
                                {{ old('status',$advantage->status)==0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            name="sort_order"
                            value="{{ old('sort_order',$advantage->sort_order) }}">

                        @error('sort_order')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ old('title',$advantage->title) }}">

                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            rows="6"
                            class="form-control"
                            name="description">{{ old('description',$advantage->description) }}</textarea>

                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <button
                            type="submit"
                            class="btn btn-primary px-4">

                            Update

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection