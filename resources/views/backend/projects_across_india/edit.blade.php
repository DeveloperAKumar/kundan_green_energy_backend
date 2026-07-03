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
                        <li class="breadcrumb-item active">Edit Project</li>
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
                    action="{{ route('backend.projects_across_india.update', Crypt::encrypt($project->id)) }}">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">Project Name</label>

                        <input type="text"
                               class="form-control"
                               name="name"
                               value="{{ old('name',$project->name) }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Allotment</label>

                        <input type="text"
                               class="form-control"
                               name="allotment"
                               value="{{ old('allotment',$project->allotment) }}">

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Type</label>

                        <select class="form-select" name="type">

                            @foreach([
                                'Residential',
                                'Commercial',
                                'Industrial',
                                'Mixed Use',
                                'Township',
                                'Affordable Housing',
                                'Luxury Housing'
                            ] as $type)

                                <option value="{{ $type }}"
                                    {{ old('type',$project->type)==$type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">Status</label>

                        <select class="form-select" name="status">

                            <option value="1"
                                {{ $project->status ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ !$project->status ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="col-md-12">

                        <label class="form-label">Detail</label>

                        <textarea
                            rows="5"
                            class="form-control"
                            name="detail">{{ old('detail',$project->detail) }}</textarea>

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