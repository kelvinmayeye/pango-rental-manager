@extends('backend.layouts.app')
@section('content')
    @php
        $activeFlag = 0;
        $countProperties = $properties->count();
    @endphp
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="col-md-6">
                <!-- general form elements -->
                {{-- <div class="card">
                  <div class="card-header">
                    <h4>Tenant {{ $tenant->name }}</h4>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" value="{{ $tenant->fullname }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Category</label>
                                <input type="text" name="" class="form-control" value="" readonly>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-12">
                            <div class="form-group">
                                <label>Description</label>
                                <p></p>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex">
                      <a class="btn btn-danger" href="{{ route('tenants.index') }}">Back</a>
                    </div>
                  </form>
                </div> --}}

                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="image">
                            <img src="{{ asset('backend/dist/img/user2-160x160.png') }}" class="rounded" width="155">
                        </div>
                        <div class="ml-3 w-100">
                            <h4 class="mb-0 mt-0">{{ $tenant->fullname }}</h4>
                            <span>{{ $tenant->occupation }}</span>

                            <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                                <div class="d-flex flex-column">
                                    <span class="articles">Leases</span>
                                    <span class="number1">38</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="followers">Last Payment</span>
                                    <span class="number2">980</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="rating">Expiring</span>
                                    <span class="number3">8.9</span>
                                </div>
                            </div>
                            <div class="button mt-2 d-flex flex-row align-items-center">
                                <button class="btn btn-sm btn-outline-primary w-100">Add Payment</button>
                                <button class="btn btn-sm btn-primary w-100 ml-2" data-toggle="modal" data-target="#addTenantPropertyModal">Add Property</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="modal fade" id="addTenantPropertyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                  <option selected disabled> select propety </option>
                                  @foreach ($properties as $property)
                                      <option value="{{ $property->id }}">{{ $property->name }}</option>
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

    <!-- Modal -->

@endsection
