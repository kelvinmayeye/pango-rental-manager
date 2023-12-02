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
                    <h4>Add Property</h4>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ route('properties.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
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
                                <select name="category_id" id="" class="form-control" required>
                                    <option selected disabled> select category </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" cols="30" rows="4"></textarea>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a class="btn btn-danger mx-3" href="{{ route('properties.index') }}">Back</a>
                    </div>
                  </form>
                </div>
                <!-- /.card -->    
              </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
