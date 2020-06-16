<!-- website login page. 
    Do we need a whole page for login or do we need to put this in a corner or something?
-->

@extends('layouts.default')
@section('content')

<!-- add HTML related to login here -->
<div class="row">
   <div class="col-md-5 page-heading">
      <h3>Login to your Account</h3>
   </div>
   <div class="row">
      <form action="/action_page.php" class="col-md-3 login-form">
          <div class="form-group">
             <label for="email">User ID:</label>
             <input type="email" class="form-control" placeholder="Enter your user ID" id="email">
          </div>
          <div class="form-group">
             <label for="pwd">Password:</label>
             <input type="password" class="form-control" placeholder="Enter your password" id="pwd">
          </div>
          <div class="form-group form-check">
             <label class="form-check-label">
             <input class="form-check-input" type="checkbox"> Remember me
             </label>
             <a href=# class="forgot-pwd">Forgot Password?</a>
          </div>
          <button type="submit" class="btn btn-primary btn-main">Login</button>
      </form> 
   </div>
</div>

@endsection