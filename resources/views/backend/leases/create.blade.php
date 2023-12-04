@extends('backend.layouts.app')
@section('content')
@php
        $activeFlag = 0;
    @endphp
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2">
                <!-- general form elements -->
                <div class="card">
                  <div class="card-header">
                    <h4>Add Lease</h4>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ route('leases.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                          <div class="col-md-6 mb-2">
                              <div class="form-group">
                                  <label for="">Tenant</label>
                                  <select name="tenant_property_id" class="form-control" required>
                                      <option selected disabled> select Tenant Property </option>
                                      @foreach ($tenantProperties as $tenantProperty)
                                          <option value="{{ $tenantProperty->id }}">{{ $tenantProperty->tenant->fullname }} ({{ $tenantProperty->property->name }})</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Monthly Rate</label>
                                <input type="text" class="form-control" name="monthly_rate" placeholder="" required>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Start date</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                        </div>
                          <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>End date date</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a class="btn btn-danger mx-3" href="{{ route('leases.index') }}">Back</a>
                    </div>
                  </form>
                </div>
                <!-- /.card -->    
              </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
