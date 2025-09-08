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
                                            <label for="challan_number" class="fw-semibold mb-2">EMPLOYEE NUMBER: </label>
                                            <div class="input-group">
                                                <div class="input-group-text">E_</div>
                                                <input type="text" name="id" placeholder="EMPLOYEE NUMBER" class="form-control"  id="id"  value="{{ old('id', $nextId) }}" readonly>
                                                @error('id')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-6">
                                            <label for="username" class="fw-semibold">NAME: </label>
                                            <input type="text" name="username" placeholder="USER NAME" class="form-control"  id="username"  value="{{ old('username') }}">
                                            @error('username')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="birthdate" class="fw-semibold">BIRTHDATE: </label>
                                            <input type="date" name="birthdate" placeholder="Birthdate" class="form-control" id="birthdate" value="{{ old('birthdate') }}">
                                            @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="contact_number_1" class="fw-semibold">MOBILE NUMBER 1:</label>
                                            <input type="phone" name="contact_number_1" placeholder="CONTACT NUMBER - 1" class="form-control"  id="contact_number_1"  value="{{ old('contact_number_1') }}">
                                            @error('contact_number_1')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                        <div class="col-lg-4">
                                            <label for="contact_number_2" class="fw-semibold">MOBILE NUMBER 2:</label>
                                            <input type="phone" name="contact_number_2" placeholder="CONTACT NUMBER - 2" class="form-control"  id="contact_number_2"  value="{{ old('contact_number_2') }}">
                                            @error('contact_number_2')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                        <div class="col-lg-4">
                                            <label for="joining_date" class="fw-semibold">JOINING DATE:</label>
                                            <input type="date" name="joining_date" class="form-control date" id="date" value="{{ old('joining_date') }}">
                                            @error('joining_date')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>  
                                    </div>
                                    <div class="row mb-4 align-items-center">  
                                        <div class="col-md-4">
                                            <label for="user_photo" class="fw-semibold">UPLOAD IMAGE:</label>
                                            @if(isset($settings->user_photo))
                                            <a href="{{ asset('uploads/users/'.$settings->user_photo) }}" target="_blank">
                                                <img src="{{ asset('uploads/users/'.$settings->user_photo) }}" alt="{{$settings->user_photo}}" width="50">
                                            </a>                    
                                            @endif
                                            <input type="file" name="user_photo" id="user_photo" class="form-control" accept="image/*">
                                            @error('user_photo')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="user_photo_id" class="fw-semibold">UPLOAD PHOTO ID:</label>
                                            @if(isset($settings->user_photo_id))
                                            <a href="{{ asset('uploads/users/'.$settings->user_photo_id) }}" target="_blank">
                                                <img src="{{ asset('uploads/users/'.$settings->user_photo_id) }}" alt="{{$settings->user_photo_id}}" width="50">
                                            </a>                    
                                            @endif
                                            <input type="file" name="user_photo_id" id="user_photo_id" class="form-control" accept="image/*">
                                            @error('user_photo_id')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="user_address_proof" class="fw-semibold">UPLOAD ADDRESS PROOF:</label>
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
                                            <label for="gender" class="fw-semibold mb-2">GENDER:</label><br>
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
                                                <label for="insurance_name" class="fw-semibold">INSURANCE NAME:</label>
                                                <input type="text" name="insurance_name" placeholder="ENTER COMPANY NAME" class="form-control" id="insurance_name" value="{{ old('insurance_name') }}">
                                                @error('insurance_name')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-6">
                                                <label for="insurance_policy_copy" class="fw-semibold">INSURANCE POLICY COPY:</label>
                                                <input type="file" name="insurance_policy_copy" class="form-control" id="insurance_policy_copy">
                                                @error('insurance_policy_copy')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-6">
                                                <label for="insurance_issue_date" class="fw-semibold">ISSUE DATE:</label>
                                                <input type="date" name="insurance_issue_date" placeholder="ENTER COMPANY NAME" class="form-control date" id="insurance_issue_date" value="{{ old('insurance_issue_date') }}">
                                                @error('insurance_issue_date')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-6">
                                                <label for="insurance_valid_date" class="fw-semibold">VALID DATE:</label>
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
                                                    <label for="nominee_name" class="fw-semibold">NOMINEE NAME:</label>
                                                    <input type="text" name="nominee_name" placeholder="NOMINEE NAME" class="form-control" id="nominee_name" value="{{ old('nominee_name') }}">
                                                    @error('nominee_name')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label for="nominee_mobile_number" class="fw-semibold">NOMINEE MOBILE NUMBER:</label>
                                                    <input type="phone" name="nominee_mobile_number" placeholder="NOMINEE MOBILE NUMBER" class="form-control" id="nominee_mobile_number" value="{{ old('nominee_mobile_number') }}">
                                                    @error('nominee_mobile_number')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-6">
                                                    <label for="nominee_photo_id" class="fw-semibold">NOMINEE PHOTO ID:</label>
                                                    <input type="file" name="nominee_photo_id" class="form-control" id="nominee_photo_id" value="{{ old('nominee_photo_id') }}">
                                                    @error('nominee_photo_id')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                                <div class="col-lg-6">
                                                    <label for="nominee_address_proof" class="fw-semibold">NOMINEE ADDRESS PROOF:</label>
                                                    <input type="file" name="nominee_address_proof" class="form-control" id="nominee_address_proof" value="{{ old('nominee_address_proof') }}">
                                                    @error('nominee_address_proof')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-6">
                                                    <label for="gender" class="fw-semibold mb-2">GENDER:</label><br>
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
                                                    <label for="birthdate" class="fw-semibold">NOMINEE BIRTH DATE:</label>
                                                    <input type="date" name="birthdate" class="form-control date" id="birthdate" value="{{ old('birthdate') }}">
                                                    @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-12">
                                                    <label for="insurance_note" class="fw-semibold">INSURANCE NOTE:</label>
                                                    <input type="text" name="insurance_note" placeholder="INSURANCE NOTE" class="form-control" id="insurance_note" value="{{ old('insurance_note') }}">
                                                    @error('insurance_note')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-3">
                                    <h5>USER TYPE</h5>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="driver" value="1" checked>
                                        <label class="form-check-label" for="driver">DRIVER</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="operator" value="2">
                                        <label class="form-check-label" for="operator">OPERATOR</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="computer_operator" value="3">
                                        <label class="form-check-label" for="computer_operator">COMPUTER OPERATOR</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="other" value="4">
                                        <label class="form-check-label" for="other">OTHER</label>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-12 border p-3 m-2 justify-content-center">
                                            <button id="addRow" type="button" class="btn btn-primary mt-2 ms-auto">+ Add Row</button>
                                            <div id="newRow">
                                                <div id="inputFormRow">
                                                    <div class="input-group mb-3 gx-2 row">
                                                        <div class="col-lg-3 mb-2">
                                                            <label for="date_from">DATE FROM</label>
                                                            <input type="date" name="date_from[]" class="form-control date">
                                                        </div>
                                                        <div class="col-lg-3 mb-2">
                                                            <label for="date_to">DATE TO</label>
                                                            <input type="date" name="date_to[]" class="form-control">
                                                        </div>
                                                        <div class="col-lg-4 mb-2">
                                                            <label for="salary">SALARY</label>
                                                            <input type="number" name="salary[]" class="form-control" placeholder="SALARY ( MONTHLY )">
                                                        </div>
                                                        <div class="col-lg-2 input-group-append">
                                                            <label for="button">Action</label><br>
                                                            <button type="button" class="btn btn-danger removeRow">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="showUser" class="mt-3">
                                    </div>
                                    <hr class="mt-3">
                                    <h5>BANK ACOOUNT</h5>
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
                                                <label for="account_number" class="fw-semibold">ACCOUNT NUMBER:</label>
                                                <input type="text" name="account_number" placeholder="ACCOUNT NUMBER" class="form-control" id="account_number" value="{{ old('account_number') }}">
                                                @error('account_number')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-6">
                                                <label for="ifsc_code" class="fw-semibold">IFSC CODE:</label>
                                                <input type="text" name="ifsc_code" placeholder="IFSC CODE" class="form-control" id="ifsc_code">
                                                @error('ifsc_code')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-6">
                                                <label for="account_holder_name" class="fw-semibold">ACCOUNT HOLDER NAME:</label>
                                                <input type="text" name="account_holder_name" placeholder="ACCOUNT HOLDER NAME" class="form-control" id="account_holder_name" value="{{ old('account_holder_name') }}">
                                                @error('account_holder_name')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-6">
                                                <label for="bank_branch_name" class="fw-semibold">BRANCH NAME:</label>
                                                <input type="text" name="bank_branch_name" placeholder="BRANCH NAME" class="form-control" id="bank_branch_name" value="{{ old('bank_branch_name') }}">
                                                @error('bank_branch_name')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                        </div>
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-6">
                                                <label for="bank_name" class="fw-semibold">BANK NAME:</label>
                                                <input type="text" name="bank_name" placeholder="BANK NAME" class="form-control" id="bank_name" value="{{ old('bank_name') }}">
                                                @error('bank_name')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                            <div class="col-lg-6">
                                                <label for="bank_proof" class="fw-semibold">BANK PROOF:</label>
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
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-12">
                                                <label for="court_case" class="fw-semibold">CASE DETAILS:</label>
                                                <input type="text" name="court_case" placeholder="CASE DETAILS" class="form-control" id="court_case" value="{{ old('court_case') }}">
                                                @error('court_case')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>  
                                        </div>
                                    </div>
                                    <hr class="mt-3">
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="roleInput" class="fw-semibold">Role:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-user"></i></div>
                                                <select name="roles[]" class="form-select" multiple="multiple" id="roleInput">
                                                    @foreach ($roles as $value => $label)
                                                        <option value="{{ $value }}">
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-3">
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-12">
                                            <label for="note" class="fw-semibold">NOTE:</label>
                                            <input type="text" name="note" id="note" placeholder="NOTE" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label for="roleInput" class="fw-semibold"></label>
                                        </div>
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
    
@endsection

@push('scripts')
    <script>              
        $(document).ready(function () {
            const now = new Date();
            const today = now.toISOString().split('T')[0];

            document.querySelectorAll('.date').forEach(input => {
                input.value = today;
            });
        });

        $(document).ready(function (){
            function toggleInsuranceSection() {
                if ($('#insurance_yes').is(':checked')) {
                    $('#showInsurance').removeClass('d-none').addClass('d-block border border-2 shadow-md rounded p-3');
                } else {
                    $('#showInsurance').removeClass('d-block').addClass('d-none');
                }
            }

            toggleInsuranceSection();

            $('input[name="insurance"]').on('change', function(){
                toggleInsuranceSection();
            });
        });

        $(document).ready(function (){
            function toggleInsuranceSection() {
                if ($('#nominee_yes').is(':checked')) {
                    $('#showNominee').removeClass('d-none').addClass('d-block border border-2 shadow-md rounded p-3');
                } else {
                    $('#showNominee').removeClass('d-block').addClass('d-none');
                }
            }

            toggleInsuranceSection();

            $('input[name="nominee"]').on('change', function(){
                toggleInsuranceSection();
            });
        });

        $(document).ready(function (){
            function toggleInsuranceSection() {
                if ($('#bank_yes').is(':checked')) {
                    $('#showBank').removeClass('d-none').addClass('d-block border border-2 rounded shadow-md p-3');
                } else {
                    $('#showBank').removeClass('d-block').addClass('d-none');
                }
            }

            toggleInsuranceSection();

            $('input[name="bank"]').on('change', function(){
                toggleInsuranceSection();
            });
        });

        $(document).ready(function (){
            function toggleInsuranceSection() {
                if ($('#court_yes').is(':checked')) {
                    $('#showCourt').removeClass('d-none').addClass('d-block border border-2 rounded shadow-md p-3');
                } else {
                    $('#showCourt').removeClass('d-block').addClass('d-none');
                }
            }

            toggleInsuranceSection();

            $('input[name="court"]').on('change', function(){
                toggleInsuranceSection();
            });
        });

        $(document).ready(function () {
            $("#addRow").click(function () {
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group mb-3 gx-2 row">';
                html += '<hr class="mt-0">';
                html += '<div class="col-lg-3 mb-2"><label>DATE FROM</label><input type="date" name="date_from[]" class="form-control"></div>';
                html += '<div class="col-lg-3 mb-2"><label>DATE TO</label><input type="date" name="date_to[]" class="form-control"></div>';
                html += '<div class="col-lg-4 mb-2"><label>SALARY</label><input type="number" name="salary[]" class="form-control" placeholder="SALARY ( MONTHLY )"></div>';
                html += '<div class="col-lg-2 input-group-append"><label>Action</label><br><button type="button" class="btn btn-danger removeRow"><i class="fa fa-trash"></i></button></div>';
                html += '</div></div>';

                $('#newRow').append(html);
            });

            // Remove row
            $(document).on('click', '.removeRow', function () {
                $(this).closest('#inputFormRow').remove();
            });
        });

    </script>
@endpush