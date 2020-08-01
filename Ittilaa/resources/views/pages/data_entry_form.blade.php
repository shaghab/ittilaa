@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-md-5 page-heading">
        <h3>Add a new Notification</h3>
    </div>
    @if(session('success'))
        <h4>{{session('success')}}</h1>
    @endif
    <div class="row">
        <form method="POST" action="{{ route('save_notificaton') }}" class="col-md-5 form-inline dataentry-form" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-4">Category:</label>
                {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Choose a Category
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div> --}}
                <div class="dropdown d-inline-block category-dropdown">
                    <select name="category" class="form-control col-sm-8">
                        <div class="dropdown-menu col-sm-8">
                            <option class="dropdown-item" value="">Category</option>

                            @foreach ($categories as $category)
                                <option class="dropdown-item" value="{{ $category['id'] }}">
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </div>
                   </select>

                   @if ($errors->has('category'))
                      <span class="help-block">
                         <strong>{{ $errors->first('category') }}</strong>
                      </span>
                   @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Category Caption:</label>
                <input type="text" name="d_cat_caption" class="form-control col-sm-8">
                @if ($errors->has('d_cat_caption'))
                    <span class="help-block">
                        <strong>{{ $errors->first('d_cat_caption') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Title:</label>
                <input type="text" name="title" class="form-control col-sm-8">
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Short Title:</label>
                <input type="text" name="short_title" class="form-control col-sm-8">
                @if ($errors->has('short_title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('short_title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Tags:</label>
                <input type="text" name="tags" class="form-control col-sm-8"/>
                @if ($errors->has('tags'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tags') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Publishing Date:</label>
                <input type="text" name="publish_date" class="form-control col-sm-5">

                {{-- <div class='input-group date' id='datetimepicker1'>
                    <input type="text" class="form-control col-sm-5">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div> --}}

                @if ($errors->has('publish_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('publish_date') }}</strong>
                    </span>
                @endif
            </div>
            {{-- <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });
            </script> --}}

            <div class="form-group row">
                <label class="col-sm-4">Document:</label>
                <input type="file" name="notice_file" class="form-control col-sm-8">

                @if ($errors->has('notice_file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('notice_file') }}</strong>
                    </span>
                @endif
            </div>

            {{-- TODO: Change to pdf to image control  --}}
            <div class="form-group row">
                <label class="col-sm-4">Thumbnail:</label>
                <input type="file" name="thumbnail_file" class="form-control col-sm-8">

                @if ($errors->has('thumbnail_file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('thumbnail_file') }}</strong>
                    </span>
                @endif                
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Description:</label>
                <textarea name="description" class="form-control col-sm-8" rows="5"></textarea>

                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Region:</label>
                <div class="dropdown d-inline-block region-dropdown">
                    <select id="region" name="region" class="form-control col-sm-8">
                        <div class="dropdown-menu col-sm-8">
                            <option class="dropdown-item" value="">Region</option>

                            @foreach ($regions as $region)
                                <option class="dropdown-item" value="{{ $region->name }}">{{ $region->name }}</option>
                            @endforeach
                        </div>
                    </select>
                </div>

                @if ($errors->has('region'))
                    <span class="help-block">
                        <strong>{{ $errors->first('region') }}</strong>
                    </span>
               @endif
            </div>

           <div class="form-group row">
                <label class="col-sm-4">Issuing Authority:</label>
                <input type="text" name="issuing_authority" class="form-control col-sm-8">

                @if ($errors->has('issuing_authority'))
                    <span class="help-block">
                        <strong>{{ $errors->first('issuing_authority') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Designation:</label>
                <input type="text" name="designation" class="form-control col-sm-8">

                @if ($errors->has('designation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('designation') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Unit:</label>
                <input type="text" name="unit_name" class="form-control col-sm-8">

                @if ($errors->has('unit_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('unit_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Unit type:</label>
                <input type="text" name="unit_type" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Caption 1:</label>
                <input type="text" name="caption1" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Caption 2:</label>
                <input type="text" name="caption2" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Caption 3:</label>
                <input type="text" name="caption3" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Enter URL:</label>
                <input type="text" name="source_url" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <div class="col-sm-4"></div>
                <button type="submit" class="btn btn-primary btn-main col-sm-4">Add Notification</button>
                <button type="reset" class="btn btn-default col-sm-4">Discard</button>
            </div>
        </form>
    </div>
</div>

@endsection