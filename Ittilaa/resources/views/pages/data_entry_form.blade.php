@extends('layouts.default')
@section('content')

<div class="row">
    <div class="col-md-5 page-heading">
        <h3>Add a new Notification</h3>
    </div>
    <div class="row">
        <form method="POST" action="{{ route('save_notificaton') }}" class="col-md-5 form-inline dataentry-form" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-4">Category:</label>
                <div class="dropdown d-inline-block category-dropdown">
                {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Choose a Category
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div> --}}
                    <select name="category" class="form-control col-sm-8">
                        @php
                            $count = $categories ? count($categories) : 0;
                            [$keys, $values] = Arr::divide($categories);
                        @endphp

                        <option class="dropdown-item" value="">Choose a Category</option>
                        <div class="dropdown-menu col-sm-8">
                            @for ($index = 0; $index < $count; $index++)
                                <option class="dropdown-item" value="{{ $values[$index] }}">{{ $keys[$index] }}</option>
                            @endfor
                        </div>
                    </select>
                </div> 
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Title:</label>
                <input type="text" name="title" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Tags:</label>
                <input type="text" name="tags" class="form-control col-sm-8"/>
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Publishing Date:</label>
                <input type="datetime" name="publish_date" class="form-control col-sm-5">

                {{-- <div class='input-group date' id='datetimepicker1'>
                    <input type="text" class="form-control col-sm-5">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div> --}}
            </div>
            {{-- <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });
            </script> --}}

            <div class="form-group row">
                <label class="col-sm-4">Document:</label>
                <input type="file" name="notice_file" class="form-control col-sm-8">
            </div>

            {{-- TODO: Change to pdf to image control  --}}
            <div class="form-group row">
                <label class="col-sm-4">Thumbnail:</label>
                <input type="file" name="thumbnail_file" class="form-control col-sm-8">
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Description:</label>
                <textarea name="description" class="form-control col-sm-8" rows="5"></textarea>
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Region:</label>
                <div class="dropdown d-inline-block region-dropdown">
                    <select name="region" class="form-control col-sm-8">
                        <div class="dropdown-menu col-sm-8">
                            @foreach ($regions as $region)
                                <option class="dropdown-item" value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </div>
                    </select>
                </div> 
            </div>
                {{-- <div class="form-group row">
                <label class="col-sm-4">Ministry:</label>
                <div class="dropdown d-inline-block ministry-dropdown">
                    <select name="region_id" class="form-control col-sm-8">
                        <div class="dropdown-menu col-sm-8">
                            @foreach ($ministries as $ministry)
                                <option class="dropdown-item" value="{{ $ministry->id }}">{{ $ministry->name }}</option>
                            @endforeach
                        </div>
                    </select>
                </div> 
            </div> --}}

            <div class="form-group row">
                <label class="col-sm-4">Division:</label>
                <div class="dropdown d-inline-block division-dropdown">
                    <select name="division" class="form-control col-sm-8">
                        <div class="dropdown-menu col-sm-8">
                            @foreach ($divisions as $division)
                                <option class="dropdown-item" value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </div>
                    </select>
                </div> 
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Signing Authority:</label>
                <input type="text" name="signing_authority" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Source Name:</label>
                <input type="text" name="notifier" class="form-control col-sm-8">
            </div>
            <div class="form-group row">
                <label class="col-sm-4">Source Designation:</label>
                <input type="text" name="notifier_designation" class="form-control col-sm-8">
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