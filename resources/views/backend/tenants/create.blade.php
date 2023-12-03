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
                    <h4>Add Tenant</h4>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ route('tenants.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                                @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Middlename</label>
                                <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
                                @if ($errors->has('middle_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('middle_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Lastname</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Phone number</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required>
                                @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Sex</label>
                                <select name="sex" class="form-control">
                                    <option selected disabled> Choose sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Birth date</label>
                                <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required>
                                @if ($errors->has('birth_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="">Occupation</label>
                                <input type="text" class="form-control" name="occupation" value="{{ old('occupation') }}" required>
                                @if ($errors->has('occupation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('occupation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a class="btn btn-danger mx-3" href="{{ route('tenants.index') }}">Back</a>
                    </div>
                  </form>
                </div>
                <!-- /.card -->    
              </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
