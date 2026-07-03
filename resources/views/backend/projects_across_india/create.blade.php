@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Projects Across India</div>
            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Add New Project</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Project Detail</h5>
            </div>

            <div class="card-body p-4">

                <form class="row g-3"
                    method="POST"
                    action="{{ route('backend.projects_across_india.store') }}">

                    @csrf

                    <div class="col-md-6">
                        <label class="form-label">Project Name <span class="text-danger">*</span></label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               placeholder="Enter Project Name">

                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Allotment <span class="text-danger">*</span></label>

                        <input type="text"
                               name="allotment"
                               class="form-control"
                               value="{{ old('allotment') }}"
                               placeholder="Enter Allotment">

                        @error('allotment')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select" name="type">
                            <option value="">Select Type</option>
                            <option value="Hydro Power Project" {{ old('type')=='Hydro Power Project' ? 'selected' : '' }}>Hydro Power Project</option>
                            <option value="Solar Energy Project" {{ old('type')=='Solar Energy Project' ? 'selected' : '' }}>Solar Energy Project</option>
                            <option value="Waste to Energy Plant" {{ old('type')=='Waste to Energy Plant' ? 'selected' : '' }}>Waste to Energy Plant</option>
                            <option value="BESS Allotted Project" {{ old('type')=='BESS Allotted Project' ? 'selected' : '' }}>BESS Allotted Project</option>
                        </select>
                        @error('type')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-12">

                        <label class="form-label">Detail <span class="text-danger">*</span></label>

                        <textarea
                            name="detail"
                            rows="5"
                            class="form-control"
                            placeholder="Enter Project Detail">{{ old('detail') }}</textarea>

                        @error('detail')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary px-4">
                            Submit
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection