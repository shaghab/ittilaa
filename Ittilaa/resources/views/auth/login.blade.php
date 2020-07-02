@extends('layouts.default')

@section('content')
<div class="row">
   <div class="col-md-5 page-heading">
      <h3>Login to your Account</h3>
   </div>
   <div class="row">
      <form action="{{route('login')}}" class="col-md-3 login-form">
          <div class="form-group">
             <label for="email">User ID:</label>

             <input id="email" type="email" placeholder="Enter your user ID" class="form-control @error('email') is_invalid @enderror" required autocomplete="email" autofocus>

             @error('email')
             <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
             </span>
             @enderror
           </div>

          <div class="form-group">
             <label for="pwd">Password:</label>

             <input id="password" type="password" placeholder="Enter your password" class="form-control @error('password') is_invalid @enderror" required autocomplete="current-password">

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
   </div>
</div>

@endsection