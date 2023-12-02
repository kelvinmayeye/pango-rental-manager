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
                                <h4>Properties</h4>
                                <a href="{{ route('properties.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i></i><span
                                        class="px-1">Property</span></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($properties as $key => $property)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $property->name }}</td>
                                            <td>{{ $property->description }}</td>
                                            <td>{{ $property->category->name }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <div>
                                                        <a href="{{ route('properties.show',$property->id) }}" type="button" class="btn btn-primary">
                                                            <i class="bi bi-eye"></i></a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('properties.edit',$property->id) }}" type="button" class="btn btn-success mx-2">
                                                            <i class="bi bi-pencil-square"></i></a>
                                                    </div>
                                                    <form action="{{ route('properties.destroy',$property->id) }}" method="POST">
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
                            {{ $properties->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
