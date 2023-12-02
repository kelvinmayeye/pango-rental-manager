@extends('auth.index')
@section('content')
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-10 col-lg-8 col-xl-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Pango Rental Management</h1>
                        <p class="lead">
                            Effortlessly manage rentals with Pango. Streamline listings, automate rent, gain insights.
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">Register</h2>
                            <div class="m-sm-3">
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        <span style="color: #ff0400">{{ Session::get('error') }}</span>
                                    </div>
                                @elseif (Session::has('success'))
                                <div class="alert alert-danger" role="alert">
                                    <span style="color: #1eff00">{{ Session::get('success') }}</span>
                                </div>
                                @endif
                                <form action="{{ route('registration') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-1">
                                                <label class="form-label">Firstname</label>
                                                <input class="form-control form-control-lg" type="text" name="first_name"
                                                    placeholder="FirstName" required/>
                                                @if ($errors->has('first_name'))
                                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-1">
                                                <label class="form-label">Middlename</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="middle_name" placeholder="MiddleName" />
                                                @if ($errors->has('middle_name'))
                                                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-1">
                                                <label class="form-label">Lastname</label>
                                                <input class="form-control form-control-lg" type="text" name="last_name"
                                                    placeholder="LastName" required/>
                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" type="email" name="email"
                                                    placeholder="email" required/>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Phone number</label>
                                                <input class="form-control form-control-lg" type="text" name="phone_number"
                                                    placeholder="Phone Number" required/>
                                                @if ($errors->has('phone_number'))
                                                    <span style="color: #ff0400">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg" type="password" name="password"
                                                    placeholder="password" required/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input class="form-control form-control-lg" type="password"
                                                    name="password_confirmation" placeholder="confirm password" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        I have an account? <a href="{{ url('/') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
