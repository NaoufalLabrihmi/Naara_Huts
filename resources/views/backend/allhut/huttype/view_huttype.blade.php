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
                    <li class="breadcrumb-item active" aria-current="page">Hut Type List</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.hut.type') }}" class="btn btn-primary px-5"> Add Hut Type </a>

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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><img src="{{ (!empty($item->hut->image)) ? url('upload/hutimg/'.$item->hut->image) : url('upload/no_img.jpg') }}" alt="" style="width: 50px; height:30px;" </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @php
                                $huts = App\Models\Hut::where('huttype_id', $item->id)->get();
                                @endphp

                                @foreach ($huts as $hut)

                                <a href="{{ route('edit.hut', $hut->id) }}" class="btn btn-warning rounded-pill px-4 mx-1">Edit</a>
                                <a href="{{ route('delete.hut', $hut->id) }}" class="btn btn-danger rounded-pill px-4 mx-1" id="delete">Delete</a>
                                @endforeach
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