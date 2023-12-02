@extends('backend.layouts.app')
@section('content')
    @php
        $activeFlag = 0;
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
                            <span>Senior Journalist</span>

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
                                <button class="btn btn-sm btn-outline-primary w-100">Chat</button>
                                <button class="btn btn-sm btn-primary w-100 ml-2">Follow</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
