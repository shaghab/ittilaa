<!-- website data entry view. change the file name if you want -->

@extends('layouts.default')
@section('content')

<!-- add HTML related to login here -->
<div class="row">
   <div class="col-md-5 page-heading">
      <h3>Add a new Notification</h3>
   </div>
   <div class="row">
    <form class="col-md-5 form-inline dataentry-form">
             <div class="form-group row">
               <label class="col-sm-4">Category:</label>
               <div class="dropdown d-inline-block category-dropdown">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  Choose a Category
                  </button>
                    <div class="dropdown-menu">
                       <a class="dropdown-item" href="#">Link 1</a>
                       <a class="dropdown-item" href="#">Link 2</a>
                       <a class="dropdown-item" href="#">Link 3</a>
                    </div>
               </div> 
             </div>
            <div class="form-group row">
               <label class="col-sm-4">Title:</label>
               <input type="text" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Publishing Date:</label>
                <input type="text" class="form-control col-sm-5">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Description:</label>
                <textarea class="form-control col-sm-8" rows="5"></textarea>
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Signing Authority:</label>
                <input type="text" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Source Name:</label>
                <input type="text" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Enter URL:</label>
                <input type="text" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <div class="col-sm-4"></div>
               <button type="submit" class="btn btn-primary btn-main col-sm-4">Add Notification</button>
               <button type="submit" class="btn btn-default col-sm-4">Discard</button>
            </div>
      </form>
   </div>
</div>

@endsection