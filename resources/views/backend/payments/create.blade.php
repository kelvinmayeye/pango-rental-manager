@extends('backend.layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="col-md-4 mx-auto">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                      <h4>Add Payment</h4>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('payments.store') }}" method="POST">
                      @csrf
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="">Lease</label>
                                    <select name="lease_id" id="lease_id" class="form-control" required>
                                        <option selected disabled> select lease </option>
                                        @foreach ($leases as $lease)
                                            <option value="{{ $lease->id }}">{{ $lease->tenantProperty->tenant->fullname }} ({{ $lease->tenantProperty->property->name }}) {{ $lease->monthly_rate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 mb-2">
                              <div class="form-group">
                                  <label>Amount Paid</label>
                                  <input type="text" class="form-control" name="amount" required>
                              </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer d-flex">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-danger mx-3" href="{{ route('payments.index') }}">Back</a>
                      </div>
                    </form>
                  </div>
                <!-- /.card -->    
              </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
