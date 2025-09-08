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
                                <h5 class="card-title">VEHICLES</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">         
                                        <a class="btn btn-sm btn-primary" href="{{ route('vehicle.index') }}">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <form method="POST" action="{{ isset($vehicle) ? route('vehicle.update', $vehicle) : route('vehicle.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($vehicle))
                                @method('PUT')
                            @endif
                                <div class="card-body general-info">
                                    <div class="row align-items-center d-flex justify-content-between">
                                        <div class="col-lg-12 mb-4">
                                            <label for="name" class="fw-semibold mb-2">VEHICLE NUMBER</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-truck"></i></div>
                                                <input type="text" name="name" placeholder="ENTER VEHICLE NUMBER" class="form-control"  id="name"  value="{{ old('name', $vehicle->name ?? '') }}">
                                            </div>
                                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-12 mb-4">
                                            <label for="vehicle_name" class="fw-semibold mb-2">TRANSPORTER NAME</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-file-text"></i></div>
                                                <input type="text" name="vehicle_name" placeholder="ENTER TRANSPORTER NAME" class="form-control"  id="vehicle_name" value="{{ old('vehicle_name', $vehicle->vehicle_name ?? '') }}">
                                            </div>
                                            @error('vehicle_name')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                    </div>
                                    <div class="row align-items-center">  
                                        <div class="col-lg-12 mb-4">
                                            <label for="vehicle_tare_weight" class="fw-semibold mb-2">TARE WEIGHT </label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-archive"></i></div>
                                                <input type="text" name="vehicle_tare_weight" placeholder="ENTER TARE WEIGHT" class="form-control" id="vehicle_tare_weight"value="{{ old('vehicle_tare_weight', $vehicle->vehicle_tare_weight ?? '') }}">
                                            </div>
                                            @error('vehicle_tare_weight')<div class="text-danger">{{ $message }}</div>@enderror
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
@endsection
