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
                                <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="card-body general-info">
                                        <div class="row align-items-center d-flex justify-content-between">
                                            <div class="col-lg-4 mb-4">
                                                <label for="challan_number" class="fw-semibold mb-2">CHALLAN NUMBER </label>
                                                <div class="input-group">
                                                    <div class="input-group-text">S_</div>
                                                    <input type="text" name="id" placeholder="CHALLAN NUMBER" class="form-control"  id="challan_number"  value="{{ old('id', $sales->id == '' ? 0+1 : $sales->id+1) }}">
                                                    @error('id')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <label for="date" class="fw-semibold mb-2">DATE</label>
                                                <div class="input-group">
                                                    <input type="datetime-local" name="date" class="form-control"  id="date"  value="{{ old('date') }}">
                                                    @error('date')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 mb-4">
                                                <label for="mailInput" class="fw-semibold mb-2 ">VEHICLE NUMBER </label>
                                                <div class="input-group">
                                                    <select class="form-select" aria-label="Default select example" id="vehicle_id" name="vehicle_id"  data-url="{{ route('vehicle.details') }}">
                                                        <option selected disabled value>SELECT VEHICLE</option>
                                                        @foreach($vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id ?? '' }}">{{ $vehicle->name ?? '' }}</option>
                                                        @endforeach
                                                    </select>                                                
                                                </div>
                                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <label for="transporter" class="fw-semibold mb-2">TRANSPORTER</label>
                                                <div class="input-group">   
                                                    <input type="text" name="transporter" placeholder="TRANSPORTER NAME" class="form-control"  id="transporter"  value="{{ old('transporter') }}" readonly>
                                                </div>
                                                @error('contact_number')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-4 mb-4">
                                                <label for="tare_weight" class="fw-semibold mb-2">TARE WEIGHT </label>
                                                <div class="input-group">
                                                    <input type="text" name="tare_weight" placeholder="ENTER VEHICLE TARE WEIGHT" class="form-control" id="tare_weight" value="{{ old('tare_weight') }}">
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
        </div>
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
                                    <label for="name" class="fw-semibold mb-2">VEHICLE NUMBER</label>
                                    <div class="input-group">
                                        <input type="text" name="name" placeholder="ENTER VEHICLE NUMBER" class="form-control"  id="name"  value="{{ old('name') }}">
                                    </div>
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-12 mb-4">
                                    <label for="vehicle_name" class="fw-semibold mb-2">TRANSPORTER NAME</label>
                                    <div class="input-group">
                                        <input type="text" name="vehicle_name" placeholder="ENTER TRANSPORTER NAME" class="form-control"  id="vehicle_name"  value="{{ old('vehicle_name') }}">
                                    </div>
                                    @error('vehicle_name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>  
                            </div>
                            <div class="row align-items-center">  
                                <div class="col-lg-12 mb-4">
                                    <label for="vehicle_tare_weight" class="fw-semibold mb-2">TARE WEIGHT </label>
                                    <div class="input-group">
                                        <input type="text" name="vehicle_tare_weight" placeholder="ENTER TARE WEIGHT" class="form-control" id="vehicle_tare_weight" value="{{ old('vehicle_tare_weight') }}">
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
                        data: { id: selectedValue },
                        dataType: 'json',
                        success: function(data){
                            $('#transporter').val(data.vehicle_name);
                            $('#tare_weight').val(data.vehicle_tare_weight);
                        },
                        error: function(xhr) {
                            console.log("Error:", xhr.responseText);
                        }
                    });
                }
            });
        })
        
        $(document).ready(function(){
            const dateTimeInput = document.getElementById('date');
            const now = new Date();

            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            now.setSeconds(0);
            now.setMilliseconds(0);
            
            dateTimeInput.value = now.toISOString().slice(0, 16);
        })

        $(document).ready(function(){
            let dropdownActive = false;

            document.getElementById('vehicle_id').addEventListener('click', function() {
                dropdownActive = true;
            });

            // listen for shortcuts
            document.addEventListener("keydown", function(event) {
                if (!dropdownActive) return;

                if (event.ctrlKey && event.key.toLowerCase() === "i") {
                    event.preventDefault();
                    new bootstrap.Modal(document.getElementById('shortcutModal')).show();
                }

                if (event.key === "Insert") {
                    event.preventDefault();
                    new bootstrap.Modal(document.getElementById('shortcutModal')).show();
                }
            });            
        })


    </script>
@endpush