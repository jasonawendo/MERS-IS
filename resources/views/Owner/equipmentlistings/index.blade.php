@extends('layouts.owner') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
  <br><br><br>

  <div class="info">
    <div class="row">
        <div class="col-md-12">
          <center>
            <h2 class="page-title">{{ $title }}</h2>
            <a href="/Owner/listing/create"><button class="btn btn-warning"><i class="fas fa-plus"></i>     Create New Equipment Listing request</button></a>
            <h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
          </center>
          
          <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
            <thead class="table-head">
              <tr>
                <th>Equipment ID</th>
                <th>Equipment Image</th>
                <th>Equipment Name</th>
                <th>Equipment Description</th>
                <th>Rent Rate</th>
                <th>Location</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>


            @foreach($equipmentlisting as $equipment)
            @php 
              $status = $equipment -> status;
              $isDeleted = $equipment -> isDeleted;
            @endphp
              <tr>
                <td>{{$equipment -> equipmentID}}</td>
                <td>
                  <img class="tbl_img" src="/img/{{$equipment -> equipmentImage}}">
                </td>
                <td>{{$equipment -> equipmentName}}</td>
                <td>{{$equipment -> equipmentDescription}}</td>
                <td>${{$equipment -> rentRate}}</td>
                <td>{{$equipment -> address}}</td>

                @if($status == "accepted")
                      <td style="color:green; font-weight: bold;">Accepted</td>
                @elseif($status == "pending")
                      <td style="color:royalblue; font-weight: bold;">Pending</td>
                @else
                      <td style="color:red; font-weight: bold;">Rejected</td>
                @endif
                
                <td>{{$equipment -> created_at}}</td>
                <td class="icons">
                  <button class="btn btn-info" >
                    <a style="color:white;" href="/Owner/equipmentlistings/{{$equipment -> equipmentID}}"><i class="fas fa-eye"></i></a>
                  </button>
                  <br><br>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <center>
            <button class="btn btn-primary" onclick='window.print()'>Print</button>
          </center>
          <br><br>
    </div>
  </div>

@endsection