@extends('layouts.default')

@section('content')
<div class="row">
   <div class="col-md-5 page-heading">
      <h3>Create a New Account</h3>
   </div>
   <div class="row">
      <form method="POST" action="{{ url('register_user') }}" class="col-sm-3 login-form" enctype="multipart/form-data">
         {{ csrf_field() }}

         <div class="form-group">
            <label for="name">{{ __('User ID') }}:</label>

            <input id="name" name="name" type="text" placeholder="Choose a user ID" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>
         <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}:</label>

            <input id="email" name="email" type="email" placeholder="Enter your email address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>
         <div class="form-group">
            <label for="password">{{ __('Password') }}:</label>

            <input id="password" name="password" type="password" placeholder="Choose a password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>
         <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}:</label>

            <input id="password-confirm" name="password-confirm" type="password-confirm" placeholder="Enter the password again" class="form-control" name="password_confirmation" required autocomplete="new-password">
         </div>
        

         <div class="form-group">
            <button type="submit" class="btn btn-primary btn-main">{{ __('Register') }}</button>
         </div>
      </form> 
      <div class="row login-register">
         <p>Already have an account?  <a href="<?= url('/login'); ?>" class="btn btn-default">Login to your Account</a></p>
      </div>
   </div>
<div>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('register_user') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div>
    <Label>Already have an account? 
        <a href="<?= url('/login'); ?>">Log in</a>
    </Label>
</div>
</div> -->
@endsection
