@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Roles</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('roles.create') }}" class="btn btn-primary px-5">Add Roles</a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @foreach($item->permissions as $permission)
                                {{$permission}},
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('roles.edit',$item->id) }}" class="btn btn-warning rounded-pill px-4 mx-1">Edit</a>
                                <a href="{{ route('delete.team',$item->id) }}" class="btn btn-danger rounded-pill px-4 mx-1" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection