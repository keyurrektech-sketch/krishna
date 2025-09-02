@extends('layouts.app')

@section('content')

<div class="nxl-container">
    <div class="nxl-content">   
        <div class="main-content">
            <div class="row">
                @php
                    $i = ($roles->currentPage() - 1) * $roles->perPage();
                @endphp
                <!-- [Leads] start -->
                <div class="col-xxl-8">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Roles</h5>
                            <div class="card-header-action">
                                @can('role-create')
                                    <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}">
                                        <i class="fa fa-plus"></i> Create New Role
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td class="d-flex">
                                                    <a class="btn btn-info btn-sm me-2" href="{{ route('roles.show', $role->id) }}">
                                                        <i class="fa-solid fa-list"></i>
                                                    </a>
                                                    @can('role-edit')
                                                        <a class="btn btn-primary btn-sm me-2" href="{{ route('roles.edit', $role->id) }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    @endcan
                                                    @can('role-delete')
                                                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm me-2">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-start">
                                {!! $roles->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [Leads] end -->
            </div>
        </div>
    </div>
</div>
@endsection