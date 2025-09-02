@extends('layouts.app')

@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                    <div class="card card-body lead-info">
                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0">
                                <span class="d-block mb-2">Show User :</span>
                            </h5>
                            <div class="card-header-action">
                                <div class="card-header-btn">         
                                    <a class="btn btn-sm btn-primary" href="{{ route('users.index') }}">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-0">
                        <div class="row mb-4">
                            <div class="col-lg-2 fw-medium">Name</div>
                            <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->name }}</a></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-2 fw-medium">Email</div>
                            <div class="col-lg-10"><a href="javascript:void(0);">{{ $user->email }}</a></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-2 fw-medium">Roles</div>
                            <div class="col-lg-10">                                    
                                    @if($user->getRoleNames()->isNotEmpty())
                                        @foreach ($user->getRoleNames() as $role)
                                            <label class="badge bg-success">{{ $role }}</label>
                                        @endforeach
                                    @else
                                        <p>No Roles Assigned</p>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>

@endsection