@extends('backend.layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Leases</h4>
                                <a href="{{ route('leases.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i></i><span
                                        class="px-1">Lease</span></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Fullname</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Monthly Rate</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($leases as $key => $lease)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $lease->tenantProperty->tenant->fullname }}</td>
                                            <td>{{ $lease->start_date }}</td>
                                            <td>{{ $lease->end_date }}</td>
                                            <td>{{ number_format($lease->monthly_rate) }} Tsh</td>
                                            <td>
                                                @if ($lease->status_id == 1)
                                                    <a href="" class="btn btn-outline-danger">Not paid</a>
                                                @elseif ($lease->status_id == 2)
                                                    <a href="" class="btn btn-outline-success">Paid</a>
                                                @else
                                                    <a href="" class="btn btn-outline-secondary">Expire</a>
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
                                                    <form action="{{ route('leases.destroy',$lease->id) }}" method="POST">
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
                            {{ $leases->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
