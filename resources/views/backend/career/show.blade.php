@extends('layouts.backend.main')
@section('main-section')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="breadcrumb-title pe-3">

                Career Enquiry

            </div>

            <div class="ps-3">

                <nav>

                    <ol class="breadcrumb mb-0 p-0">

                        <li class="breadcrumb-item">

                            <a href="{{ route('backend.dashboard') }}">

                                <i class="bx bx-home-alt"></i>

                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="{{ route('backend.career') }}">

                                Career Enquiries

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            View

                        </li>

                    </ol>

                </nav>

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">

                    Career Enquiry Details

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Name

                        </label>

                        <p>

                            {{ $career->name }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Email

                        </label>

                        <p>

                            {{ $career->email }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Phone

                        </label>

                        <p>

                            {{ $career->phone }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Position

                        </label>

                        <p>

                            {{ $career->position }}

                        </p>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="fw-bold">

                            Message

                        </label>

                        <p>

                            {!! nl2br(e($career->message)) !!}

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Resume

                        </label>

                        <br>

                        @if($career->resume)

                            <a
                                href="{{ asset($career->resume) }}"
                                target="_blank"
                                class="btn btn-primary">

                                <i class="bx bx-download"></i>

                                Download Resume

                            </a>

                        @else

                            <span class="text-muted">

                                No Resume Uploaded

                            </span>

                        @endif

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Submitted On

                        </label>

                        <p>

                            {{ $career->created_at->format('d M Y h:i A') }}

                        </p>

                    </div>

                    <div class="col-md-12 mt-3">

                        <a
                            href="{{ route('backend.career') }}"
                            class="btn btn-secondary">

                            Back

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection