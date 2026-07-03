@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Team</div>

            <div class="ps-3">
                <nav>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Add Team Member
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">

            <div class="card-header px-4 py-3">
                <h5 class="mb-0">Team Member Details</h5>
            </div>

            <div class="card-body p-4">

                <form class="row g-3"
                    method="POST"
                    action="{{ route('backend.team.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="col-md-6">

                        <label class="form-label">
                            Member Type <span class="text-danger">*</span>
                        </label>

                        <select
                            class="form-select"
                            name="member_type">

                            <option value="">Select Member Type</option>

                            <option
                                value="team_member"
                                {{ old('member_type')=='team_member' ? 'selected' : '' }}>

                                Team Member

                            </option>

                            <option
                                value="board_member"
                                {{ old('member_type')=='board_member' ? 'selected' : '' }}>

                                Board Member

                            </option>

                        </select>

                        @error('member_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            value="{{ old('name') }}">

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Designation <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            name="designation"
                            value="{{ old('designation') }}">

                        @error('designation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Photo <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            id="photo"
                            name="photo"
                            accept="image/*">

                        @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-md-12">

                        <img
                            id="preview"
                            src=""
                            style="display:none;width:220px;"
                            class="img-thumbnail">

                    </div>

                    <div class="col-md-12">

                        <button
                            type="submit"
                            class="btn btn-primary px-5">

                            Submit

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

$("#photo").change(function(){

    let input = this;

    if(input.files && input.files[0]){

        let reader = new FileReader();

        reader.onload = function(e){

            $("#preview")
                .attr("src",e.target.result)
                .show();

        }

        reader.readAsDataURL(input.files[0]);

    }

});

</script>

@endsection