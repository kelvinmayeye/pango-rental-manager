@extends('backend.layouts.app')

@section('content')
    @php
        $activeFlag = 0;
    @endphp
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Tenants <small>(wapangaji)</small></h4>
                                <a href="{{ route('tenants.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i></i><span
                                        class="px-1">Tenant</span></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Fullname</th>
                                        <th>sex</th>
                                        <th>Age</th>
                                        <th>Phone number</th>
                                        <th>Occupation</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($tenants as $key=>$tenant)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $tenant->fullname }}</td>
                                            <td>{{ $tenant->sex }}</td>
                                            <th>{{ $tenant->age }} yrs</th>
                                            <td>{{ $tenant->phone_number }}</td>
                                            <td>{{ $tenant->occupation }}</td></td>
                                            <td>
                                                @if ($activeFlag == 1)
                                                    <a href="" class="btn btn-outline-success">Active</a>
                                                @else
                                                    <a href="" class="btn btn-outline-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <div>
                                                        <a href="{{ route('tenants.show',$tenant->id) }}" type="button" class="btn btn-primary">
                                                            <i class="bi bi-eye"></i></a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('tenants.edit',$tenant->id) }}" type="button" class="btn btn-success mx-2">
                                                            <i class="bi bi-pencil-square"></i></a>
                                                    </div>
                                                    <form action="{{ route('tenants.destroy',$tenant->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger delete-confirmation"
                                                            data-toggle="tooltip" title='Delete'>
                                                            <i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            {{ $tenants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
