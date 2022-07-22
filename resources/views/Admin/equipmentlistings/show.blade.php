@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

    @php 
      $status = $equipment -> status;
    @endphp

<style type="text/css">
	.profile .card .card-header .profile_img_spec {
    width: 100%;
    height: 210px;
    object-fit: cover;
    margin: 10px auto;
    border: 10px solid #E30613;
    border-radius: 10%;
	}
</style>

  <section>       
    <div class="profile py-4">
      <div class="container">
        <div class="row">
          <center><h2 class="page-title">View Equipment</h2></center>
          <div class="col-lg-4">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent text-center">
                <img class="profile_img_spec" src="/img/{{$equipment -> equipmentImage}}" alt="dp">
                <h3>{{$equipment -> equipmentName}}</h3>
                <!-- Star ratings can be placed here -->
              </div>
              <div class="card-body">
                <p class="mb-0"><strong class="pr-1">Equipment ID:</strong> {{$equipment -> equipmentID}}</p>
                <p class="mb-0"><strong class="pr-1">Rent Rate:</strong> ${{$equipment -> rentRate}} / day</p>
                <p class="mb-0"><strong class="pr-1">Equipment Owner ID:</strong> {{$equipment -> ownerID}}</p>
                <a href="/Admin/users/{{$equipment -> ownerID}}"><button class="btn btn-success">View Equipment Owner Details</button></a>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent border-0">
                <h3 class="mb-0"></i>General Information</h3>
              </div>
              <div class="card-body pt-0">
                <table class="table table-bordered">
                  <tr>
                    <th width="30%">Equipment Location</th>
                    <td width="2%">:</td>
                    <td>{{$equipment -> address}}</td>
                  </tr>

                  @if($status == "accepted")
                        <tr>
                          <th width="30%">Value</th>
                          <td width="2%">:</td>
                          <td>${{$equipment -> equipmentValue}}</td>
                        </tr>
                        <tr>
                          <th width="30%">Condition</th>
                          <td width="2%">:</td>
                          <td>{{$equipment -> equipmentCondition}}</td>
                        </tr>
                        <tr>
                          <th width="30%">Availability</th>
                          <td width="2%">:</td>
                          <td>{{$equipment -> equipmentAvailability}}</td>
                        </tr>      
                  @else
                        <tr></tr>
                  @endif
                  
                  <tr>
                    <th width="30%">Created At</th>
                    <td width="2%">:</td>
                    <td>{{$equipment -> created_at}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Updated At</th>
                    <td width="2%">:</td>
                    <td>{{$equipment -> updated_at}}</td>
                  </tr>
                  
                    @if($status == "accepted")
                    <tr>
                      <th width="30%">Action</th>
                      <td width="2%">:</td>
                      <td>
                        <form action="/Admin/equipmentlistings/{{$equipment -> equipmentID}}"" method="POST">
                              @csrf
                              <input id="isDeleted" type="number" name="isDeleted" value="1" hidden>
                              <input onclick="return confirm('This action will remove this Equipment Listing from the system. Proceed?')"
                              class="btn btn-danger" type="submit" name="submit" value="Remove Equipment">
                        </form>
                      </td> 
                      
                    </tr>   
                  @else
                        <tr></tr>
                  @endif

                </table>
              </div>
            </div>
              <div style="height: 26px"></div>
            <div class="card shadow-sm">
              <div class="card-header bg-transparent border-0">
                <h3 class="mb-0"></i>Equipment Description</h3>
              </div>
              <div class="card-body pt-0">
                  <p>{{$equipment -> equipmentDescription}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection