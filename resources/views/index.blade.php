@extends('backend.layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>
                            <p>Properties</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('properties.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>
                            <p>Leases</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('leases.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3></h3>
                            <p>Tenants</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('tenants.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3></h3>
                            <p>Payments</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('payments.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Leases <small>(mikataba ya wapangaji)</small></h4>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Tenant Name</th>
                                        <th>Property</th>
                                        <th>Monthly rate</th>
                                        <th>Amount paid</th>
                                        <th>Balance</th>
                                        <th>Days Remaining</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leases as $key => $lease)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $lease->tenantProperty->tenant->fullname }}</td>
                                            <td>{{ $lease->tenantProperty->property->name }}</td>
                                            <th>{{ number_format($lease->monthly_rate) }} Tsh</th>
                                            <th>{{ number_format(calculateTotalLeasePaid($lease->id)) }}</th>
                                            <td>{{ number_format(leaseBalance($lease->id)) }}</td>
                                            <td>{{ daysRemaining($lease->id) }} day {{ $lease->status_id }}</td>
                                            <td>
                                                @if ($lease->status_id == 1)
                                                    <a href="" class="btn btn-outline-danger btn-sm">Not paid</a>
                                                @elseif ($lease->status_id == 2)
                                                    <a href="" class="btn btn-outline-success btn-sm">Paid</a>
                                                @elseif ($lease->status_id == 3)
                                                    <a href="" class="btn btn-outline-success btn-sm">Expire</a>
                                                @else
                                                    <a href="" class="btn btn-outline-secondary btn-sm">Incomplete</a>
                                                @endif
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
