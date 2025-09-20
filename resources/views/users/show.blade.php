@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
             @php
                function renderFile($file) {
                    if (!$file) {
                        return '<label class="badge bg-danger text-white">No File</label>';
                    }

                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                    if (in_array($extension, ['jpg','jpeg','png'])) {
                        return '<a href="javascript:void(0);" 
                                    class="view-file" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#imageDownload" 
                                    data-file="' . asset($file) . '">
                                    <img src="' . asset($file) . '" class="img-thumbnail" style="max-width:100px;">
                                </a>';
                    } elseif ($extension === 'pdf') {
                        return '<a href="javascript:void(0);" 
                                    class="view-file" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#imageDownload" 
                                    data-file="' . asset($file) . '"><img src="' . asset('uploads/PDF_file_icon.jpg') . '" class="img-thumbnail" style="max-width:50px;"></a>';
                    } else {
                        return '<label class="badge bg-warning text-dark">Unsupported File</label>';
                    }
                }
            @endphp

            <div class="page-content">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                        <div class="card card-body lead-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0">
                                    <span class="d-block mb-2">Show Employee :</span>
                                </h5>
                                <div class="card-header-action">
                                    <div class="card-header-btn">         
                                        <a class="btn btn-sm btn-primary" href="{{ route('users.index') }}">
                                            <i class="bx bx-arrow-to-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">UserName</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->name ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Email</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->email ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Employee DOB</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->birthdate ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Employee Contact Number</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->contact_number_1 ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Employee Alternate Contact Number</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->contact_number_2 ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Employee Joining Date</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->joining_date ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4 d-flex align-items-center">
                                <div class="col-lg-4 fw-medium">Employee Image</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->user_photo) !!}
                                </div>
                            </div>
                            <div class="row mb-4 d-flex align-items-center">
                                <div class="col-lg-4 fw-medium">Employee Photo ID</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->user_photo_id) !!}
                                </div>
                            </div>
                            <div class="row mb-4 d-flex align-items-center">
                                <div class="col-lg-4 fw-medium">Employee Address Proof</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->user_address_proof) !!}
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Employee Gender</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->employee_gender == '1' ? 'Male' : 'Female' }}</a></div>
                            </div>
                            <hr class="mt-0">
                            <h5 class="mb-3">Employee Insurance Details</h5>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Employee Insurance Name</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->insurance_name ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4 d-flex align-items-center">
                                <div class="col-lg-4 fw-medium">Employee Insurance Policy Copy</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->insurance_policy_copy) !!}
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Insurance Issue Date</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->insurance_issue_date ?? '-' }}</a></div>
                            </div>  
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Insurance Valid Date</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->insurance_valid_date ?? '-' }}</a></div>
                            </div>  
                            <hr class="mt-0">
                            <h5 class="mb-3">Nominee Details</h5>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Nominee Name</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->nominee_name ?? '-' }}</a></div>
                            </div>  
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Nominee Mobile Number</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->nominee_mobile_number ?? '-' }}</a></div>
                            </div>  
                            <div class="row mb-4 d-flex align-items-center">
                                <div class="col-lg-4 fw-medium">Nominee Photo ID</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->nominee_photo_id) !!}
                                </div>
                            </div>
                            <div class="row mb-4 d-flex align-items-center">
                                <div class="col-lg-4 fw-medium">Nominee Address Proof</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->nominee_address_proof) !!}
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Nominee Gender</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->nominee_gender == '1' ? 'Male' : 'Female' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Nominee DOB</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->nominee_birthdate ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Insurance Note</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->insurance_note ?? '-' }}</a></div>
                            </div>
                            <hr class="mt-0">
                            <h5 class="mb-3">Employee Work Profile</h5>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Department</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->department ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Salary</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->salary ?? '-' }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Licence</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->licence) !!}
                                </div>
                            </div>
                            <hr class="mt-0">
                            <h5 class="mb-3">Employee Bank Account</h5>
                            <div class="row mb-4 d-flex align-items-center">
                                <div class="col-lg-4 fw-medium">Employee Bank Proof</div>
                                <div class="col-lg-8">
                                    {!! renderFile($user->bank_proof) !!}
                                </div>
                            </div>
                            <hr class="mt-0">
                            <h5 class="mb-3">Employee Court Cases</h5>
                            @php
                                $courtCases = json_decode($user->court_case_files, true);
                                if (!is_array($courtCases)) {
                                    $courtCases = [];
                                }
                            @endphp

                            @if(!empty($courtCases))
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 50%;">Case Details Files</th>
                                                <th style="width: 50%;">Case Close Files</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($courtCases as $case)
                                                <tr>
                                                    <!-- Case Details Files Column -->
                                                    <td>
                                                        @if(!empty($case['case_files']) && is_array($case['case_files']))
                                                            @foreach($case['case_files'] as $file)
                                                                <div class="mb-1">{!! renderFile(asset($file)) !!}</div>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">No files uploaded</span>
                                                        @endif
                                                    </td>

                                                    <!-- Case Close Files Column -->
                                                    <td>
                                                        @if(!empty($case['case_close_files']) && is_array($case['case_close_files']))
                                                            @foreach($case['case_close_files'] as $file)
                                                                <div class="mb-1">{!! renderFile(asset($file)) !!}</div>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">No files uploaded</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <hr class="mt-0">
                            <h5 class="mb-3">Note</h5>
                            <div class="row mb-4">
                                <div class="col-lg-4 fw-medium">Note</div>
                                <div class="col-lg-8"><a href="javascript:void(0);">{{ $user->note ?? '-' }}</a></div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <div class="modal fade" id="imageDownload" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="file-preview">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" download id="downloadFile" class="btn btn-success">Download</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.view-file').forEach(function (el) {
                el.addEventListener('click', function () {
                    let fileUrl = this.dataset.file;
                    let filePreview = document.getElementById('file-preview');
                    let downloadBtn = document.getElementById('downloadFile');

                    // Clear previous content
                    filePreview.innerHTML = '';

                    // Set download link
                    downloadBtn.href = fileUrl;

                    // Detect file extension
                    let ext = fileUrl.split('.').pop().toLowerCase();

                    if (ext === 'pdf') {
                        filePreview.innerHTML = `<iframe src="${fileUrl}" class="w-100" style="height: 100vh;" frameborder="0"></iframe>`;
                    } else {
                        filePreview.innerHTML = `<img src="${fileUrl}" alt="File" class="img-fluid w-100 h-100 object-fit-contain">`;
                    }
                });
            });
        });
    </script>

@endpush