@extends('layouts.dashboard')
@section('content')

<div class="row page-heading">
   <h3> {{ $title }} </h3>
</div>

@if(session('success'))
   <h4>{{session('success')}}</h1>
@endif

@if (!$file_imported)
<div class="container-fluid">
   <div class="row">
      <form method="POST" action="{{ route('parse_csv') }}" enctype="multipart/form-data" class="col-md-8 form-inline">
         {{ csrf_field() }}

         <div class="form-group row{{ $errors->has('csv_file') ? ' has-error' : '' }}">
            <label>Select File:</label>
            <label>
               <input id="csv_file" name="csv_file" type="file" accept=".csv" required>
            </label>

            @if ($errors->has('csv_file'))
               <span class="help-block">
                  <strong>{{ $errors->first('csv_file') }}</strong>
               </span>
            @endif
         </div>

         <div class="form-group row">
            <label>
               <input type="checkbox" name="has_header" checked> File contains header row?
            </label>
         </div>

         <div class="form-group row">
            <button type="submit" class="btn btn-primary btn-main">Parse File</button>
         </div>

       </form>
   </div>
</div>

@else
<div class="container-fluid">

   <div class="row">
      <h5> CSV File Columns </h4>
   </div>

   <div class="row">
      <form class="col-md-12 form-inline" method="POST" action="{{ route('import_data') }}">
         {{ csrf_field() }}

         @if (count($errors) > 0)
            <div class="alert alert-danger">
               <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
         @endif

         <input type="hidden" name="import_file_id" value="{{ $csv_data_file->id }}" />

         <div style="overflow-x:scroll;">

            <table class="table">

               <tr>
                  @foreach ($csv_data[0] as $key => $value)
                     <td>
                        <select name="fields[{{ $key }}]">
                           @foreach (config('app.notification_fields') as $db_field)
                              <option value="{{$loop->index}}" @if ($loop->index == $loop->parent->index) selected @endif>{{ $db_field }}</option>
                           @endforeach
                        </select>
                     </td>
                  @endforeach
               </tr>
               
               @foreach ($csv_data as $row)
                  <tr>
                     @foreach ($row as $key => $value)
                        <td>{{ $value }}</td>
                     @endforeach
                  </tr>
               @endforeach

            </table>

         </div>

         <div>
            <button type="submit" class="btn btn-primary btn-main">Import Data</button>
         </div>

      </form>
   </div>
</div>
@endif


@endsection
