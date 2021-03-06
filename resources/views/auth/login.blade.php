@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary mb-2">
                                    {{ __('Login') }}
                                </button>
                              
                               
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <h5> <i> or </i> </h5>
                                <a href="/login/facebook" class="mb-2 mr-1 btn btn-secondary" style="width:200px">Login With Facebook</a>
                                <a href="/login/google" class="mb-2 mr-1 btn btn-secondary" style="width:200px">Login With Google</a>
                                <a href="/login/instagram" class="mb-2 mr-1 btn btn-secondary" style="width:200px">Login With Instagram</a></h5>
                                <a href="/login/twitter" class="mb-2 mr-1 btn btn-secondary" style="width:200px">Login with Twitter</a>
                           
                           
                            </div>
                        </div>
                    </form>
                    @isset($msg)
                                    <div class="text-danger col-12 mt-3 offset-md-4" role="alert">
                                    <strong>{{$msg}} </strong>
                                    </div>
                                    <div class="mx-auto my-2 col-12 ">
                                     <a class="btn btn-outline-primary btn-lg offset-md-4" href="{{ route('register',['role'=>'Influencer']) }}">Register As Influencer</a>
                                     <a class="btn btn-outline-success btn-lg" href="{{ route('register',['role'=>'Client']) }}">Register As Client</a>
                                    </div>
                                @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
