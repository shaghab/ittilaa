@extends('layouts.signing')

@section('content')
<div class="row">
   <div class="col-md-5 page-heading">
      <h3>Login to your Account</h3>
   </div>
   <div class="row">
      <form method="POST" action="{{ route('login_user') }}" class="col-sm-3 login-form" enctype="multipart/form-data">
         {{ csrf_field() }}

         <div class="form-group">
            <label for="name">User ID:</label>

            <input id="name" name="name" type="username" placeholder="Enter your user ID" class="form-control @error('name') is_invalid @enderror" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="form-group">
            <label for="password">Password:</label>

            <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control @error('password') is_invalid @enderror" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
            @enderror
         </div>
         <div class="form-group form-check">
            <label class="form-check-label">
               <input id="remember" name="remember" value="{{ old('remember') ? 'checked' : ''}}" class="form-check-input" type="checkbox"> Remember me
            </label>
         </div>
         <div class="form-group">
            <button type="submit" class="btn btn-primary btn-main">Login</button>

            @if (Route::has('password.request'))
               <a href="{{route('password.request')}}" class="forgot-pwd">{{__('Forgot Password?')}}</a>
            @endif
         </div>
      </form> 
      <div class="row login-register">
         <p>Don't have an account yet?  <a href="<?= url('/register'); ?>" class="btn btn-default">Create an Account</a></p>
      </div>
   </div>
<div>

@endsection