<!-- This is website header where icons and such are added -->


<div class="header-hr">
   <ul class="list-inline header-links">
       <li class="list-inline-item">
        @if(Auth::user())
       <a href="{{ url('/logout') }}" class="btn btn-default" role="button"><i class="fa fa-user-o"></i>Logout {{ Auth::user()->name }}</a>
        @else
            <a href="{{ url('/login') }}" class="btn btn-default" role="button"><i class="fa fa-user-o"></i>Login/Register</a>
        @endif
       </li>
   </ul>
    <span>
        <img src="../images/Ittilaa Logo_001.png">
    </span>
</div>