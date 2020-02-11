@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                @if ($role=='Influencer')
                <h5 class='text-center mb-4'>  What is your favourite platform?     </h5> 
                <div class="row ">
                     <div class="col-4 text-center">                 
                         <!-- <a class='fa fa-youtube-play' style='font-size:30px;color:red;'>Youtube</a> -->
                         <img src="{{asset('youtube-logo.png')}}" class="img-fluid "  width='100' style="vertical-align:top;">
                        </div> 
                     <div class="col-8 "> 
                         <a href="{{ url('/login/google?role=' . $role)}}" class="mt-4 btn btn-secondary" style="width:200px">Signup With Google</a> 
                    </div> 
                </div>
                <div class="row mb-2"> 
                    <div class="col-4 text-center"> 
                <img src="{{asset('instagram-logo.png ')}}"  width='70' style="vertical-align:top;">
                <i class="fas fa-info-circle mt-2" style="color:#427EAC;" title="If you have an Instagram Business Account that is linked to a facebook page of your own, we encourage you to register with facebook to benefit the most of our website services.However, if you don't have one, you can still sign up with instagram."></i>
                <!-- <button class="fas fa-info-circle mt-2 btn btn-outline-light btn-sm " style="color:steelblue;" title="If you have an Instagram Business Account that is linked to a facebook page of your own, we encourage you to register with facebook to benefit the most of our website services. However, if you don't have one, you can still sign up with instagram. ">	</button> -->

            </div>
                 <div class="col-8">               
                      <a href="{{ url('/login/facebook?role=' . $role)}}" class="btn btn-secondary mx-auto" style="width:200px">Signup With Facebook</a> <i> or </i> <a href="{{ url('/login/instagram?role=' . $role)}}" class="btn btn-secondary" style="width:200px">Signup With Instagram</a>
                    </div> 
                </div>
                <div class="row mt-4 mb-2"> <div class="col-4 text-center"> 
                <img src="{{asset('twitter-logo.png ')}}"  width='70' style="vertical-align:top;">
                </div> 
                <div class="col-8 ">                                            
                    <a href="{{ url('/login/twitter?role=' . $role)}}" class="btn btn-secondary" style="width:200px">Signup With Twitter</a>
                </div> 
                </div>
                <div class="row mt-3 mb-2"> 
                    <div class="col-4 text-center"> 
                <img src="{{asset('facebook-logo.png ')}}" class="border-rounded m" width='95' style="vertical-align:top;">
                      </div> 
                      <div class="col-8 ">                
                          <a href="{{ url('/login/facebook?role=' . $role)}}" class="mt-4 btn btn-secondary mx-auto" style="width:200px">Signup With Facebook</a> 
                        </div> 
                    </div>
                    <hr>
                    <div class="mb-4">       
                    <h5 class="text-center"> OR <br>

            <u>  You can register by our simple registeration form </u>  </h5>
        </div>
        @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <input type="hidden" name="role" value={{$role}}>
                        </div>

                        <div class="form-group row mb-0">
                            <div class=" offset-md-4">
                                <button type="submit" class="btn btn-primary mb-2">
                                    {{ __('Register') }}
                                </button> 
                                @if($role=='Client')
                                <h5> <i> or </i> </h5>
                                <a href="{{ url('/login/google?role=' . $role)}}" class="mb-2 mr-1 btn btn-secondary" style="width:200px">Signup With Google</a> 
                                <a href="{{ url('/login/facebook?role=' . $role)}}" class="mb-2 btn btn-secondary" style="width:200px">Signup With Facebook</a>
                                <a href="{{ url('/login/instagram?role=' . $role)}}" class="btn mb-2 mr-1 btn-secondary" style="width:200px">Signup With Instagram</a>
                                <a href="{{ url('/login/twitter?role=' . $role)}}" class="btn mb-2 btn-secondary" style="width:200px">Signup With Twitter</a>
                                @endif                
                            </div>


                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
