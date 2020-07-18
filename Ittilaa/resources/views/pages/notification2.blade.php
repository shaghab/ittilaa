@extends('layouts.default')
@section('content')

<div class="container-fluid row">
   <div class="col-md-10 notifs-page">
      <div class="col-md-7">
         <div class="notif-embed embed-responsive embed-responsive-1by1">
            <iframe class="embed-responsive-item" src="../images/notif.pdf" allowfullscreen></iframe>
         </div>
         <!-- <embed class="notif-embed" src="../images/notif.pdf" height="1000px" width="100%"> -->
      </div>
      <div class="col-md-5 notif-details">
          <label>Notification</label>
          <h6>Ghori Town Phase 4-A and 5-A Sealed</h6>
          <p>Publishing Date: 25th June 2020<p>
          <p class="p-black">Due to huge number of COVID-19 cases in the areas 
              of Ghori Town Phase 4-A and 5-A, the mentioned areas have been 
              sealed till further orders. Due to huge number of COVID-19 cases 
              in the areas of Ghori Town Phase 4-A and 5-A, the mentioned areas 
              have been sealed till further orders.</p>
          <br>
          <p class="p-black"><b>Signing Authority:</b></p>
          <p class="p-black">Office of the District Magistrate Islamabad Capital Territory, Islamabad</p> 
          <p class="p-black"><b>Source:</b></p>
          <p class="p-black">DC Islamabad on Twitter</p>
          <a href=# class="btn btn-default" role="button"><i class="fa fa-link"></i>Go to Source</a>
        </div>
   </div>
</div>

@endsection