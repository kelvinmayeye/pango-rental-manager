@extends('auth.index')
@section('content')
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Pango Rental Management</h1>
                        <p class="lead">
                            Effortlessly manage rentals with Pango. Streamline listings, automate rent, gain insights.
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">Login</h2>
                            <div class="m-sm-3">
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        <span style="color: #ff0400">{{ Session::get('error') }}</span>
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-danger" role="alert">
                                        <span style="color: #00b212">{{ Session::get('success') }}</span>
                                    </div>
                                @endif
                                <form action="{{ route('authentication') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">email</label>
                                        <input class="form-control form-control-lg" type="email" name="email"
                                            placeholder="email" />
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password"
                                            placeholder="password" />
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        Don't have an account? <a href="{{ url('register') }}">Register Here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
