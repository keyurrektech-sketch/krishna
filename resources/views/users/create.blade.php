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
                        <div class="card stretch stretch-full">
                            <div class="card-header">
                                <h5 class="card-title">New User:</h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">         
                                        <a class="btn btn-sm btn-primary" href="{{ route('users.index') }}">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="card-body general-info">
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="challan_number" class="fw-semibold mb-2">EMPLOYEE NUMBER </label>
                                            <div class="input-group">
                                                <div class="input-group-text">KME_</div>
                                                <input type="text" name="id" placeholder="EMPLOYEE NUMBER" class="form-control"  id="id"  value="{{ old('id', $user->id ?? $nextEmployeeNumber) }}">
                                                @error('id')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-6">
                                            <label for="username" class="fw-semibold">NAME </label>
                                            <input type="text" name="username" placeholder="USER NAME" class="form-control"  id="username"  value="{{ old('username') }}">
                                            @error('username')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="birthdate" class="fw-semibold">BIRTHDATE </label>
                                            <input type="date" name="birthdate" placeholder="Birthdate" class="form-control" id="birthdate" value="{{ old('birthdate') }}">
                                            @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="contact_number_1" class="fw-semibold">MOBILE NUMBER 1</label>
                                            <input type="phone" name="contact_number_1" placeholder="CONTACT NUMBER - 1" class="form-control"  id="contact_number_1"  value="{{ old('contact_number_1') }}">
                                            @error('contact_number_1')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                        <div class="col-lg-4">
                                            <label for="contact_number_2" class="fw-semibold">MOBILE NUMBER 2</label>
                                            <input type="phone" name="contact_number_2" placeholder="CONTACT NUMBER - 2" class="form-control"  id="contact_number_2"  value="{{ old('contact_number_2') }}">
                                            @error('contact_number_2')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                        <div class="col-lg-4">
                                            <label for="joining_date" class="fw-semibold">JOINING DATE</label>
                                            <input type="date" name="joining_date" class="form-control date" id="date" value="{{ old('joining_date') }}" readonly>
                                            @error('joining_date')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                    </div>
                                    <div class="row mb-4 align-items-center">  
                                        <div class="col-md-4">
                                            <label for="user_photo" class="fw-semibold">UPLOAD IMAGE</label>
                                            @if(isset($settings->user_photo))
                                            <a href="{{ asset('uploads/users/'.$settings->user_photo) }}" target="_blank">
                                                <img src="{{ asset('uploads/users/'.$settings->user_photo) }}" alt="{{$settings->user_photo}}" width="50">
                                            </a>                    
                                            @endif
                                            <input type="file" name="user_photo" id="user_photo" class="form-control" accept="image/*">
                                            @error('user_photo')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="user_photo_id" class="fw-semibold">UPLOAD PHOTO ID</label>
                                            @if(isset($settings->user_photo_id))
                                            <a href="{{ asset('uploads/users/'.$settings->user_photo_id) }}" target="_blank">
                                                <img src="{{ asset('uploads/users/'.$settings->user_photo_id) }}" alt="{{$settings->user_photo_id}}" width="50">
                                            </a>                    
                                            @endif
                                            <input type="file" name="user_photo_id" id="user_photo_id" class="form-control" accept="image/*">
                                            @error('user_photo_id')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="user_address_proof" class="fw-semibold">UPLOAD ADDRESS PROOF</label>
                                            @if(isset($settings->user_address_proof))
                                            <a href="{{ asset('uploads/users/'.$settings->user_address_proof) }}" target="_blank">
                                                <img src="{{ asset('uploads/users/'.$settings->user_address_proof) }}" alt="{{$settings->user_address_proof}}" width="50">
                                            </a>                    
                                            @endif
                                            <input type="file" name="user_address_proof" id="user_address_proof" class="form-control" accept="image/*">
                                            @error('user_address_proof')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4 align-items-center">  
                                        <div class="col-md-4">
                                            <label for="gender" class="fw-semibold mb-2">GENDER</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="employee_gender" id="male" value="1" checked>
                                                <label class="form-check-label" for="male">MALE</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="employee_gender" id="female" value="2">
                                                <label class="form-check-label" for="female">FEMALE</label>
                                            </div>
                                            @error('user_photo')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <h5>INSURANCE DETAIL</h5>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="insurance" id="insurance_no" value="1" checked>
                                        <label class="form-check-label" for="insurance_no">NO</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="insurance" id="insurance_yes" value="2">
                                        <label class="form-check-label" for="insurance_yes">YES</label>
                                    </div>
                                    <div id="showInsurance" class="d-none mt-3">
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-6">
                                                <label for="insurance_name" class="fw-semibold">INSURANCE NAME</label>
                                                <input type="text" name="insurance_name" placeholder="ENTER COMPANY NAME" class="form-control" id="insurance_name" value="{{ old('insurance_name') }}">
                                                @error('insurance_name')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-6">
                                                <label for="insurance_policy_copy" class="fw-semibold">INSURANCE POLICY COPY</label>
                                                <input type="file" name="insurance_policy_copy" class="form-control" id="insurance_policy_copy">
                                                @error('insurance_policy_copy')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-6">
                                                <label for="insurance_issue_date" class="fw-semibold">ISSUE DATE</label>
                                                <input type="date" name="insurance_issue_date" placeholder="ENTER COMPANY NAME" class="form-control date" id="insurance_issue_date" value="{{ old('insurance_issue_date') }}">
                                                @error('insurance_issue_date')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-6">
                                                <label for="insurance_valid_date" class="fw-semibold">VALID DATE</label>
                                                <input type="date" name="insurance_valid_date" placeholder="ENTER COMPANY NAME" class="form-control date" id="insurance_valid_date" value="{{ old('insurance_valid_date') }}">
                                                @error('insurance_valid_date')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                        </div>
                                        <hr class="mt-0">
                                        <h5>NOMINEE DETAIL</h5>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nominee" id="nominee_no" value="1" checked>
                                            <label class="form-check-label" for="nominee_no">NO</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="nominee" id="nominee_yes" value="2">
                                            <label class="form-check-label" for="nominee_yes">YES</label>
                                        </div>
                                        <div id="showNominee" class="d-none mt-3">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-6">
                                                    <label for="nominee_name" class="fw-semibold">NOMINEE NAME</label>
                                                    <input type="text" name="nominee_name" placeholder="NOMINEE NAME" class="form-control" id="nominee_name" value="{{ old('nominee_name') }}">
                                                    @error('nominee_name')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label for="nominee_mobile_number" class="fw-semibold">NOMINEE MOBILE NUMBER</label>
                                                    <input type="phone" name="nominee_mobile_number" placeholder="NOMINEE MOBILE NUMBER" class="form-control" id="nominee_mobile_number" value="{{ old('nominee_mobile_number') }}">
                                                    @error('nominee_mobile_number')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-6">
                                                    <label for="nominee_photo_id" class="fw-semibold">NOMINEE PHOTO ID</label>
                                                    <input type="file" name="nominee_photo_id" class="form-control" id="nominee_photo_id" value="{{ old('nominee_photo_id') }}">
                                                    @error('nominee_photo_id')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label for="nominee_address_proof" class="fw-semibold">NOMINEE ADDRESS PROOF</label>
                                                    <input type="file" name="nominee_address_proof" class="form-control" id="nominee_address_proof" value="{{ old('nominee_address_proof') }}">
                                                    @error('nominee_address_proof')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-6">
                                                    <label for="gender" class="fw-semibold mb-2">GENDER</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="nominee_gender" id="nominee_male" value="1" checked>
                                                        <label class="form-check-label" for="nominee_male">MALE</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="nominee_gender" id="nominee_female" value="2">
                                                        <label class="form-check-label" for="nominee_female">FEMALE</label>
                                                    </div>
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label for="nominee_birthdate" class="fw-semibold">NOMINEE BIRTH DATE</label>
                                                    <input type="date" name="nominee_birthdate" class="form-control date" id="nominee_birthdate" value="{{ old('nominee_birthdate') }}">
                                                    @error('nominee_birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-12">
                                                    <label for="insurance_note" class="fw-semibold">INSURANCE NOTE</label>
                                                    <input type="text" name="insurance_note" placeholder="INSURANCE NOTE" class="form-control" id="insurance_note" value="{{ old('insurance_note') }}">
                                                    @error('insurance_note')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-3">
                                    <h5>USER TYPE</h5>
                                    <div class="row mb-4 align-items-center justify-content-between">
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#addUserTypeModal">
                                            Add User Type
                                            </button>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="user_type" id="user_type" class="form-select">
                                                <option value="">Select User Type</option>
                                                @foreach ($roles as $value => $label)
                                                    <option value="{{ $value }}">
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-6 align-items-center">
                                            <label for="salary">SALARY</label>
                                            <input type="number" name="salary" class="form-control" placeholder="SALARY ( MONTHLY )">
                                        </div>
                                        <div class="col-lg-6 licence d-none" id="showDriverLicence">
                                            <label for="licence" class="fw-semibold">LICENCE</label>
                                            <input type="file" name="licence" placeholder="LICENCE" class="form-control" id="licence">
                                            @error('licence')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <hr class="mt-3">
                                    <h5>BANK ACCOUNT</h5>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bank" id="bank_no" value="1" checked>
                                        <label class="form-check-label" for="bank_no">NO</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bank" id="bank_yes" value="2">
                                        <label class="form-check-label" for="bank_yes">YES</label>
                                    </div>
                                    <div id="showBank" class="d-none mt-3">
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-6">
                                                <label for="bank_proof" class="fw-semibold">BANK PROOF</label>
                                                <input type="file" name="bank_proof" class="form-control" id="bank_proof" value="{{ old('bank_proof') }}">
                                                @error('bank_proof')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                        </div>
                                    </div>
                                    <hr class="mt-3">
                                    <h5>COURT CASE</h5>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="court" id="court_no" value="1" checked>
                                        <label class="form-check-label" for="court_no">NO</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="court" id="court_yes" value="2">
                                        <label class="form-check-label" for="court_yes">YES</label>
                                    </div>
                                    <div id="showCourt" class="d-none mt-3">
                                        <div id="case-files-wrapper">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-5">
                                                    <label for="court_case_file" class="fw-semibold">CASE DETAILS FILE</label>
                                                    <input type="file" name="court_case_file[]" class="form-control">
                                                </div>  
                                                <div class="col-lg-5">
                                                    <label for="court_case_close_file" class="fw-semibold">CASE CLOSE FILE</label>
                                                    <input type="file" name="court_case_close_file[]" class="form-control">
                                                </div>  
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary mt-3" id="add-fields">Add More Files</button>
                                    </div>
                                    <hr class="mt-3">
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-12">
                                            <label for="note" class="fw-semibold">NOTE</label>
                                            <input type="text" name="note" id="note" placeholder="NOTE" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-primary mt-2 mb-3">
                                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                                    Submit
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
<div class="modal fade" id="addUserTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addUserTypeForm" action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add User Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                    <label for="user_type_name" class="col-form-label">User Type Name:</label>
                    <input type="text" class="form-control" name="name" id="user_type_name" placeholder="Enter user type">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            // -------------------- Set today's date for all date fields --------------------
            const today = new Date().toISOString().split('T')[0];
            $('.date').each(function () {
                if (!$(this).val()) { // Only set if empty
                    $(this).val(today);
                }
            });

            // -------------------- Toggle Sections --------------------
            function toggleSection(triggerId, sectionId, extraClasses = 'border border-2 shadow-md rounded p-3') {
                if ($(triggerId).is(':checked')) {
                    $(sectionId).removeClass('d-none').addClass('d-block ' + extraClasses);
                } else {
                    $(sectionId).removeClass('d-block').addClass('d-none');
                }
            }

            // Insurance
            $('input[name="insurance"]').on('change', function () {
                toggleSection('#insurance_yes', '#showInsurance');
            });
            toggleSection('#insurance_yes', '#showInsurance');

            // Nominee
            $('input[name="nominee"]').on('change', function () {
                toggleSection('#nominee_yes', '#showNominee');
            });
            toggleSection('#nominee_yes', '#showNominee');

            // Bank
            $('input[name="bank"]').on('change', function () {
                toggleSection('#bank_yes', '#showBank');
            });
            toggleSection('#bank_yes', '#showBank');

            // Court
            $('input[name="court"]').on('change', function () {
                toggleSection('#court_yes', '#showCourt');
            });
            toggleSection('#court_yes', '#showCourt');

            // -------------------- Driver Licence based on User Type --------------------

            const roleMap = @json($roles);
            function toggleDriverLicence() {
                const val = $('#user_type').val();
                let label = roleMap[val] || '';
                label = String(label).trim().toLowerCase();
                if (label === 'driver' || label === 'operator') {
                    $('#showDriverLicence').removeClass('d-none').addClass('d-block');
                } else {
                    $('#showDriverLicence').removeClass('d-block').addClass('d-none');
                }
            }
            $('#user_type').on('change', toggleDriverLicence);
            toggleDriverLicence();

            // -------------------- Add/Remove Court Case Fields --------------------

            $('#add-fields').click(function () {
                const newFields = `
                    <div class="row mb-3 align-items-center">
                        <div class="col-lg-5">
                            <input type="file" name="court_case_file[]" class="form-control">
                        </div>
                        <div class="col-lg-5">
                            <input type="file" name="court_case_close_file[]" class="form-control">
                        </div>
                        <div class="col-lg-2 text-end mt-2">
                            <button type="button" class="btn btn-danger btn-sm remove-fields"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>`;
                $('#case-files-wrapper').append(newFields);
            });

            $(document).on('click', '.remove-fields', function () {
                $(this).closest('.row').remove();
            });

        });

        $(document).ready(function() {
            $(document).on('submit', '#addUserTypeForm', function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');
                const formData = new FormData(this);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.id && response.name){
                            $('#user_type').append(`<option value="${response.id}" selected>${response.name}</option>`);
                            $('#user_type').val(response.id);

                            const modalEl = document.getElementById('addUserTypeModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if(modal){
                                modal.hide();
                            }

                            form[0].reset();

                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        }
                    },
                    error: function(xhr){
                        alert('Something went wrong!');
                    }
                });
                $('#addUserTypeModal').on('hidden.bs.modal', function () {
                    $('body').removeClass('modal-open');
                    $('body').css('overflow', 'auto');
                    $('.modal-backdrop').remove();
                });
            });

        });

    </script>
@endpush
