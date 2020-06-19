<!-- website admin page 
    For now the layout is same as home page. you can create a separate layout for this page .
    In fact, you can create separate layouts for all pages though it does not make sense.
    But admin panel can have a different layout from main web pages 
    as there is different type of information displayed there
-->

@extends('layouts.default')

@section('content')

<!-- add HTML related to login here -->
<div class="container-fluid row">
   <div class="col-md-3">
      <div class="sidenav">
         <a href="#">Pending Notifications</a>
         <a href="#">Approved Notifications</a>
         <a href="#">Rejected Notifications</a>
         <a href="#">Data Entry View</a>
      </div>
   </div>
   <div class="col-md-8">
       <div class="row page-heading">
           <h3>Pending Notifications</h3>
       </div>
       <div class="row admin-notifs">
          <div class="card admin-card col-md-12">
              <div class="col-md-2">
                 <a href=#><img class="card-img-top" src="../images/Card test2.png" alt="Card image"></a>
              </div>
              <div class="card-body admin-card-body col-md-9">
                 <h4 class="card-title">Notification Title</h4>
                 <p class="card-text">Date: 1st January 2020</p>
                 <p class="card-text">Tags: Tag1, Tag2, Tag3, Tag4, Tag5</p>
                 <p class="card-text">Department: Ministry of Magic</p>
                 <a href="#" class="btn btn-success btn-accept">Approve</a>
                 <a href="#" class="btn btn-danger btn-reject">Reject</a>
             </div>
          </div>
       </div>
       <div class="row admin-notifs">
          <div class="card admin-card col-md-12">
              <div class="col-md-2">
                 <a href=#><img class="card-img-top" src="../images/Card test2.png" alt="Card image"></a>
              </div>
              <div class="card-body admin-card-body col-md-9">
                 <h4 class="card-title">Notification Title</h4>
                 <p class="card-text">Date: 1st January 2020</p>
                 <p class="card-text">Tags: Tag1, Tag2, Tag3, Tag4, Tag5</p>
                 <p class="card-text">Department: Ministry of Magic</p>
                 <a href="#" class="btn btn-success btn-accept">Approve</a>
                 <a href="#" class="btn btn-danger btn-reject">Reject</a>
             </div>
          </div>
       </div>
       <div class="row admin-notifs">
          <div class="card admin-card col-md-12">
              <div class="col-md-2">
                 <a href=#><img class="card-img-top" src="../images/Card test2.png" alt="Card image"></a>
              </div>
              <div class="card-body admin-card-body col-md-9">
                 <h4 class="card-title">Notification Title</h4>
                 <p class="card-text">Date: 1st January 2020</p>
                 <p class="card-text">Tags: Tag1, Tag2, Tag3, Tag4, Tag5</p>
                 <p class="card-text">Department: Ministry of Magic</p>
                 <a href="#" class="btn btn-success btn-accept">Approve</a>
                 <a href="#" class="btn btn-danger btn-reject">Reject</a>
             </div>
          </div>
       </div>
       <div class="row admin-notifs">
          <div class="card admin-card col-md-12">
              <div class="col-md-2">
                 <a href=#><img class="card-img-top" src="../images/Card test2.png" alt="Card image"></a>
              </div>
              <div class="card-body admin-card-body col-md-9">
                 <h4 class="card-title">Notification Title</h4>
                 <p class="card-text">Date: 1st January 2020</p>
                 <p class="card-text">Tags: Tag1, Tag2, Tag3, Tag4, Tag5</p>
                 <p class="card-text">Department: Ministry of Magic</p>
                 <a href="#" class="btn btn-success btn-accept">Approve</a>
                 <a href="#" class="btn btn-danger btn-reject">Reject</a>
             </div>
          </div>
       </div>
       <div class="row">
       <div class="col-md-3">
          <ul class="pagination custom-pagination">
             <li class="page-item"><a class="page-link" href="#">Previous</a></li>
             <li class="page-item"><a class="page-link" href="#">1</a></li>
             <li class="page-item"><a class="page-link" href="#">2</a></li>
             <li class="page-item"><a class="page-link" href="#">3</a></li>
             <li class="page-item"><a class="page-link" href="#">Next</a></li>
         </ul> 
      </div>
</div>
   </div>
</div>

@endsection
