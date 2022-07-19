@extends('layouts.admin') 
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
            <h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
          </center>
          
          <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
            <thead class="table-head">
              <tr>
                <th>Equipment ID</th>
                <th>Equipment Image</th>
                <th>Owner ID</th>
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
            @endphp
              <tr>
                <td>{{$equipment -> equipmentID}}</td>
                <td>
                  <img class="tbl_img" src="/img/{{$equipment -> equipmentImage}}">
                </td>
                <td>{{$equipment -> ownerID}}</td>
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
                
                <td>{{$equipment -> createdAt}}</td>
                <td class="icons">
                  <a style="color:blue;" href="/Admin/equipmentlistings/{{$equipment -> equipmentID}}"><i class="fas fa-eye"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>

@endsection