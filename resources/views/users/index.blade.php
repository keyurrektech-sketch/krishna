@extends('layouts.app')

@section('content')

<div class="nxl-container">
    <div class="nxl-content">   
        <div class="main-content">
            <div class="row">
                <div class="row mb-3">
                    @php
                    $i = ($data->currentPage() - 1) * $data->perPage();
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
                                <h5 class="card-title">Users</h5>
                                <div class="card-header-action">                      
                                    @can('role-create')
                                        <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                                            <i class="fa fa-plus"></i> Create New User
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr class="border-b">
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Emails</th>
                                                <th>Roles</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $user)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                    @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $v)
                                                        <label class="badge bg-success">{{ $v }}</label>
                                                        @endforeach
                                                    @endif
                                                    </td>
                                                    <td class="d-flex">
                                                        <a class="btn btn-info btn-sm me-2" href="{{ route('users.show',$user->id) }}">
                                                            <i class="fa-solid fa-list"></i>
                                                        </a>
                                                        <a class="btn btn-primary btn-sm me-2" href="{{ route('users.edit',$user->id) }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        @if(Auth::id() !== $user->id)
                                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-danger btn-sm me-2">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button type="submit" class="btn btn-danger btn-sm me-2" disabled>
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        @endif
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
                                {!! $data->links() !!}
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