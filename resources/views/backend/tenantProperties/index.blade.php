@extends('backend.layouts.app')

@section('content')
    @php
        $countproperties = $properties->count();
    @endphp
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Tenants Propeties</h4>
                                {{-- <a href="" class="btn btn-primary"><i class="bi bi-plus-lg"></i></i><span
                                        class="px-1">Tenant Propety</span></a> --}}
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
                                        <th>Property</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($tenantProperties as $key=> $tenantProperty )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $tenantProperty->tenant->fullname }}</td>
                                            <td>{{ $tenantProperty->tenant->sex}}</td>
                                            <th>{{ $tenantProperty->tenant->age }}</th>
                                            <td>{{ $tenantProperty->tenant->phone_number }}</td>
                                            <td>{{ $tenantProperty->property->name }}</td>
                                            <td>
                                                @if ($tenantProperty->is_active == 1)
                                                    <a href="{{ route('tenantProperties.status', $tenantProperty->id) }}" class="btn btn-outline-success">Active</a>
                                                @else
                                                    <a href="{{ route('tenantProperties.status', $tenantProperty->id) }}" class="btn btn-outline-danger">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <div>
                                                        <a href="" type="button" class="btn btn-primary">
                                                            <i class="bi bi-eye"></i></a>
                                                    </div>
                                                    <div>
                                                        <a href="" type="button" class="btn btn-success mx-2" data-toggle="modal"
                                                        data-target="#changePropertyModal{{ $tenantProperty->id }}">
                                                            <i class="bi bi-pencil-square"></i></a>
                                                    </div>
                                                    <form action="{{ route('tenantProperties.destroy',$tenantProperty->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger delete-confirmation"
                                                            data-toggle="tooltip" title='Delete'>
                                                            <i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('models.changeProperty')
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            {{-- {{ $tenantProperties->links() }}  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
