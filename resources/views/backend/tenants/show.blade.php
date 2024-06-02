@extends('backend.layouts.app')
@section('content')
    @php
        $activeFlag = 0;
        $countProperties = $properties->count();
    @endphp
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- general form elements -->
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <div class="image">
                                <img src="{{ asset('backend/dist/img/user2-160x160.png') }}" class="rounded"
                                     width="155">
                            </div>
                            <div class="ml-3 w-100">
                                <h4 class="mb-0 mt-0">{{ $tenant->fullname }}</h4>
                                <span>{{ $tenant->occupation }}</span>

                                <div
                                    class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                                    <div class="d-flex flex-column">
                                        <span class="articles">Leases</span>
                                        <span class="number1">{{tenantLeasesCount($tenant->id)}}</span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="followers">Last Payment</span>
                                        <span class="number2">{{tenantLastPayment($tenant->id)}}</span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="rating">Properties</span>
                                        <span class="number3">{{tenantPropertyCount($tenant->id)}}</span>
                                    </div>
                                </div>
                                <div class="button mt-2 d-flex flex-row align-items-center">
                                    <button class="btn btn-sm btn-outline-primary w-100">Add Payment</button>
                                    <button class="btn btn-sm btn-primary w-100 ml-2" data-toggle="modal"
                                            data-target="#addTenantPropertyModal">Add Property
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(tenantPropertyCount($tenant->id) > 0)
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card p-3">
                            <table class="table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Property</th>
                                    <th>Has Lease</th>
                                    <th>Paid</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tenantProperties as $key=>$tenantProperty)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$tenantProperty->property->name}}</td>
                                        <td>{{$tenantProperty->leases->count()==0 ? 'No':'Yes'}}</td>
                                        <td>
                                            @if($tenantProperty->leases->isNotEmpty())
                                                {{$tenantProperty->leases->sortByDesc('created_at')->first()->lastLeasePayment()}}
                                            @else
                                                No payments found
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        @endif


        <!-- Modal -->
            <div class="modal fade" id="addTenantPropertyModal" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Tenant Property</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('tenantProperties.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="">Property</label>
                                            @if ($countProperties == 0)
                                                <h4 style="color: #b10a0a;">All properties are taken</h4>
                                            @else
                                                <select name="property_id" id="" class="form-control" required>

                                                    <option selected disabled> select propety</option>
                                                    @foreach ($properties as $property)
                                                        <option
                                                            value="{{ $property->id }}">{{ $property->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
