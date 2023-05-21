@extends('auth.layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-xl-5 col-lg-6 col-md-10">
        <div class="card">
            <div class="card-header bg-dark-cus">
                <div class="app-brand bg-transparent">
                    <a class="mx-auto pl-0" href="{{route('public.fixtures')}}">
                        <img src="{{asset('PublicArea/img/logo.png')}}" alt="Logo"
                            style="width: 100%;max-width: 100%;text-align: center;">
                    </a>
                </div>
            </div>
            <div class="card-body p-5">
                <h4 class="text-dark mb-5">Sign In</h4>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12 mb-4">
                            <input type="email" class="form-control input-lg" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="Email" required>
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 ">
                            <input type="password" class="form-control input-lg" id="password" name="password"
                                placeholder="Password" required>
                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="d-flex my-2 justify-content-center">
                            </div>
                            <button type="submit" class="btn btn-lg btn-dark-cus btn-block mb-4">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
