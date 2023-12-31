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
                                <h4>Users</h4>
                                <a href="" class="btn btn-primary"><i class="bi bi-plus-lg"></i></i><span
                                        class="px-1">User</span></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Fullname</th>
                                        <th>Phone number</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Indentification</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Edga John Zim</td>
                                            <td>0785123098</td>
                                            <td>mymail2390@gmail.com</td>
                                            <td>Morolz inc</td>
                                            <td>Nida</td>
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
                                                        <a href="" type="button" class="btn btn-primary">
                                                            <i class="bi bi-eye"></i></a>
                                                    </div>
                                                    <div>
                                                        <a href="" type="button" class="btn btn-success mx-2">
                                                            <i class="bi bi-pencil-square"></i></a>
                                                    </div>
                                                    <form action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger delete-confirmation"
                                                            data-toggle="tooltip" title='Delete'>
                                                            <i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer d-flex justify-content-center">
                            {{-- {{ $users->links() }} --}} paginate
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
