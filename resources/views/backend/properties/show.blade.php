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
                    <h4>Property {{ $property->name }}</h4>
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
                                <input type="text" class="form-control" name="name" value="{{ $property->name }}" readonly>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Category</label>
                                <input type="text" name="" class="form-control" value="{{ $property->category->name }}" readonly>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-12">
                            <div class="form-group">
                                <label>Description</label>
                                <p>{{ $property->description }}</p>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex">
                      <a class="btn btn-danger" href="{{ route('properties.index') }}">Back</a>
                    </div>
                  </form>
                </div>
                <!-- /.card -->    
              </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
