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
                    <h4>Add Category</h4>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 mb-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a class="btn btn-danger mx-3" href="{{ route('category.index') }}">Back</a>
                    </div>
                  </form>
                </div>
                <!-- /.card -->    
              </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
