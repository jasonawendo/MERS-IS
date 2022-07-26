@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

  <br><br><br>

<div class="info">
  <div class="row">
      <div class="col-md-12">
        <center>
          <h2 class="page-title">{{$title}}</h2>
          <!-- <a style="color:blue;" href="/Admin/inspectors/createjob"><button class="btn btn-warning"><i class="fas fa-plus"></i>     Create Inspection Job</button></a> -->
          <br>
          <h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
        </center>
        <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
          <thead class="table-head">
            <tr>
	          <th>Inspection Job ID</th>
              <th>Inspection Date & Time</th> <!-- Must be before the starting date -->
              <th>Address (County)</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Completed</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach($jobs as $job)
            @php
              $completed = $job -> isCompleted;
            @endphp
            <tr>
              <td>{{$job -> IJID}}</td>
              <td>{{$job -> dateTimeInspection}}</td>
              <td>{{$job -> address}}</td>
              <td>{{$job -> created_at}}</td>
              <td>{{$job -> updated_at}}</td>
              <td class="icons">
                @if($completed == 1)
                  <i style="color:green;" class="fa fa-check"></i> Complete
                @else  
                  <i style="color:red;" class="fa fa-ban"></i> Incomplete
                @endif
              </td>
              <td class="icons">
                <a class="btn btn-info" style="color:white;" href="/Inspectors/jobs/{{$job -> IJID}}"><i class="fas fa-eye"></i></a>
              </td>
              
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>
  
  @endsection