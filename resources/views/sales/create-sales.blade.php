    @extends('layouts.app')

    @section('content')

        <div class="wrapper">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="page-content">
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
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Sales</h5>
                                    <div class="card-header-action">
                                        <div class="card-header-btn">         
                                            <a class="btn btn-sm btn-primary" href="{{ route('sales.index') }}">
                                                <i class="bx bx-arrow-to-left"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-0">
                                <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="card-body general-info">
                                        <div class="row align-items-center d-flex justify-content-between">
                                            <div class="col-lg-4 mb-4">
                                                <label for="challan_number" class="form-label mb-2">Challan Number </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">S_</div>
                                                    <input type="text" name="id" placeholder="Challan Number" class="form-control"  id="challan_number"  value="{{ old('id', $sales->id == '' ? 0+1 : $sales->id+1) }}" readonly>
                                                    @error('id')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <label for="date" class="form-label mb-2">Date</label>
                                                <div class="input-group">
                                                    <input type="datetime-local" name="date" class="form-control"  id="date"  value="{{ old('date') }}" readonly>
                                                    @error('date')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 mb-4">
                                                <label for="mailInput" class="form-label mb-2">Vehicle Number </label>
                                                <div class="input-group">
                                                    <select class="form-select" aria-label="Default select example" id="vehicle_id" name="vehicle_id"  data-url="{{ route('vehicle.details') }}">
                                                        <option selected disabled value>Select Vehicle</option>
                                                        @foreach($vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id ?? '' }}">{{ $vehicle->name ?? '' }}</option>
                                                        @endforeach
                                                    </select>                                                
                                                </div>
                                                @error('vehicle_id')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <label for="transporter" class="form-label mb-2">Transporter Name</label>
                                                <div class="input-group">   
                                                    <input type="text" name="transporter" placeholder="Transporter Name" class="form-control"  id="transporter"  value="{{ old('transporter') }}" readonly>
                                                </div>
                                                @error('transporter')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-4 mb-4">
                                                <label for="contact_number" class="form-label mb-2">Contact Number</label>
                                                <div class="input-group">
                                                    <input type="number" name="contact_number" maxlength="10" minlength="10"  placeholder="Enter Transporter Contact Number" class="form-control" id="contact_number" value="{{ old('contact_number') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                                    @error('contact_number')<div class="text-danger">{{ $message }}</div>@enderror
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
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shortcutModalLabel">Vehicle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('vehicle.store') }}" method="POST">
                        @csrf
                            <div class="row align-items-center d-flex justify-content-between">
                                <div class="col-lg-12 mb-4">
                                    <label for="name" class="form-label mb-2">Vehicle Number</label>
                                    <div class="input-group">
                                        <input type="text" name="name" placeholder="Enter Vehicle Number" class="form-control"  id="name"  value="{{ old('name') }}">
                                    </div>
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-12 mb-4">
                                    <label for="vehicle_name" class="form-label mb-2">Transporter Name</label>
                                    <div class="input-group">
                                        <input type="text" name="vehicle_name" placeholder="Enter Transporter Name" class="form-control"  id="vehicle_name"  value="{{ old('vehicle_name') }}">
                                    </div>
                                    @error('vehicle_name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>  
                            </div>
                            <div class="row align-items-center">  
                                <div class="col-lg-12 mb-4">
                                    <label for="transporter_contact_number" class="form-label mb-2">Transporter Contact Number </label>
                                    <div class="input-group">
                                        <input type="number" name="contact_number" placeholder="Enter Transporter Contact Number" class="form-control" id="transporter_contact_number" value="{{ old('transporter_contact_number') }}">
                                    </div>
                                    @error('contact_number')<div class="text-danger">{{ $message }}</div>@enderror
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
                                        <button type="button" class="btn btn-secondary mt-2 mb-3" data-bs-dismiss="modal">
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
    @endsection

    
@push('scripts')
    <script>        
        $(document).ready(function(){            
            const input = document.getElementById('name');
            input.addEventListener('input', formatVehicleNumber);

            function formatVehicleNumber(event) {
                let value = event.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                let formattedValue = '';
                
                if (value.length > 0) {
                formattedValue += value.substring(0, 2);
                }
                if (value.length > 2) {
                formattedValue += '-' + value.substring(2, 4);
                }
                if (value.length > 4) {
                formattedValue += '-' + value.substring(4, 6);
                }
                if (value.length > 6) {
                formattedValue += '-' + value.substring(6, 10);
                }
                
                event.target.value = formattedValue.trim();
            }
        });

        
        $(document).ready(function(){
            $('#vehicle_id').change(function() {
                const selectedValue = $(this).val();
                const url = $(this).data('url');

                if (selectedValue) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: { id: selectedValue }, // no need to add _token manually
                        dataType: 'json',
                        success: function(data){
                            $('#transporter').val(data.vehicle_name);
                            $('#contact_number').val(data.contact_number);
                        },
                        error: function(xhr) {
                            console.log("Error:", xhr.responseText);
                        }
                    });
                }
            });
        });
        
        $(document).ready(function(){
            const dateTimeInput = document.getElementById('date');
            const now = new Date();

            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            now.setSeconds(0);
            now.setMilliseconds(0);
            
            dateTimeInput.value = now.toISOString().slice(0, 16);
        })
        
        $(document).ready(function(){
            const dropdown = document.getElementById('vehicle_id');
            const myModal = new bootstrap.Modal(document.getElementById('myModal'));
            
            dropdown.addEventListener('keyup', function(e) {
            if (e.key === 'Insert' || (e.key.toLowerCase() === 'i' && e.ctrlKey)) {
                e.preventDefault();
                setTimeout(() => myModal.show(), 10);
            }
            });
        })
    </script>
    
@endpush