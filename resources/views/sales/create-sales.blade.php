@extends('layouts.app')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </div>
                        @endif
                        @session('success')
                            <div class="alert alert-success" role="alert"> 
                                {{ $value }}
                            </div>
                        @endsession
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">SALES</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">         
                                        <a class="btn btn-sm btn-primary" href="{{ route('sales.index') }}">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="card-body general-info">
                                    <div class="row align-items-center d-flex justify-content-between">
                                        <div class="col-lg-4 mb-4">
                                            <label for="challan_number" class="fw-semibold mb-2">CHALLAN NUMBER </label>
                                            <div class="input-group">
                                                <div class="input-group-text">S_</div>
                                                <input type="text" name="id" placeholder="CHALLAN NUMBER" class="form-control"  id="challan_number"  value="{{ old('id') }}">
                                                @error('id')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <label for="date" class="fw-semibold mb-2">DATE</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                <input type="datetime-local" name="date" class="form-control"  id="username"  value="{{ old('date') }}">
                                                @error('date')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 mb-4">
                                            <label for="mailInput" class="fw-semibold mb-2 ">VEHICLE NUMBER </label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-truck"></i></div>
                                                <select class="form-select" aria-label="Default select example" id="select_vehical">
                                                    <option selected disabled value>SELECT VEHICLE</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>                                                
                                            </div>
                                            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <label for="contact_number" class="fw-semibold mb-2">TRANSPORTER NUMBER</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-file-text"></i></div>
                                                <input type="text" name="contact_number" placeholder="ENTER VEHICLE NUMBER" class="form-control"  id="contact_number"  value="{{ old('contact_number') }}" disabled>
                                            </div>
                                            @error('contact_number')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                        <div class="col-lg-4 mb-4">
                                            <label for="passwordInput" class="fw-semibold mb-2">TARE WEIGHT </label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-archive"></i></div>
                                                <input type="text" name="tare_weight" placeholder="ENTER VEHICLE TARE WEIGHT" class="form-control" id="passwordInput">
                                                @error('tare_weight')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-primary mt-2 mb-3">
                                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
    <div class="modal fade" id="shortcutModal" tabindex="-1" aria-labelledby="shortcutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shortcutModalLabel">VEHICLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('vehicle.store') }}" method="POST">
                    @csrf
                        <div class="row align-items-center d-flex justify-content-between">
                            <div class="col-lg-12 mb-4">
                                <label for="challan_number" class="fw-semibold mb-2">VEHICLE NUMBER</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="feather-truck"></i></div>
                                    <input type="text" name="name" placeholder="ENTER VEHICLE NUMBER" class="form-control"  id="challan_number"  value="{{ old('id') }}">
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-12 mb-4">
                                <label for="contact_number" class="fw-semibold mb-2">TRANSPORTER NAME</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="feather-file-text"></i></div>
                                    <input type="text" name="vehicle_name" placeholder="ENTER TRANSPORTER NAME" class="form-control"  id="contact_number"  value="{{ old('contact_number') }}">
                                </div>
                                @error('vehicle_name')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>  
                        </div>
                        <div class="row align-items-center">  
                            <div class="col-lg-12 mb-4">
                                <label for="passwordInput" class="fw-semibold mb-2">TARE WEIGHT </label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="feather-archive"></i></div>
                                    <input type="text" name="vehicle_tare_weight" placeholder="ENTER TARE WEIGHT" class="form-control" id="passwordInput">
                                    @error('vehicle_tare_weight')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary mt-2 mb-3">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-secondary mt-2 mb-3" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-close me-2"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let dropdownActive = false; // track if dropdown was clicked

        // when dropdown is clicked → activate shortcut mode
        document.getElementById('select_vehical').addEventListener('click', function() {
            dropdownActive = true;
        });

        // listen for shortcuts
        document.addEventListener("keydown", function(event) {
            if (!dropdownActive) return; // only work if dropdown was clicked first

            if (event.ctrlKey && event.key.toLowerCase() === "i") {
                event.preventDefault();
                new bootstrap.Modal(document.getElementById('shortcutModal')).show();
            }

            if (event.key === "Insert") {
                event.preventDefault();
                new bootstrap.Modal(document.getElementById('shortcutModal')).show();
            }
        });
    </script>
@endsection