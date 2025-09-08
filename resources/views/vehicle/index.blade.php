@extends('layouts.app')

@section('content')

<div class="nxl-container">
    <div class="nxl-content">   
        <div class="main-content">
            <div class="row">
                <div class="row mb-3">
                    @php
                    $i = ($vehicles->currentPage() - 1) * $vehicles->perPage();
                    @endphp
                    <!-- [Leads] start -->
                    <div class="col-xxl-8">
                        @session('success')
                            <div class="alert alert-success" role="alert"> 
                                {{ $value }}
                            </div>
                        @endsession
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">Vehicles</h5>
                                <div class="card-header-action">                      
                                    @can('role-create')
                                        <a class="btn btn-success btn-sm" href="{{ route('vehicle.create') }}">
                                            <i class="fa fa-plus"></i> Add New Vehicle
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr class="border-b">
                                                <th>NUMBER</th>
                                                <th>NAME</th>
                                                <th>TARE WEIGHT</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vehicles as $vehicle)
                                                <tr>
                                                    <td>{{ $vehicle->name }}</td>
                                                    <td>{{ $vehicle->vehicle_name }}</td>
                                                    <td>{{ $vehicle->vehicle_tare_weight }}</td>
                                                    <td class="d-flex">
                                                        <a class="btn btn-primary btn-sm me-2" href="{{ route('vehicle.edit',$vehicle->id) }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <form method="POST" action="{{ route('vehicle.destroy', $vehicle->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm me-2">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-start">
                                {!! $vehicles->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- [Leads] end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection