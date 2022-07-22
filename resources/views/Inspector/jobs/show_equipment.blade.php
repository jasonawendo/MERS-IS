@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

    @php 
      $equipmentID = $equipment -> equipmentID;
      $ownerID = $equipment -> ownerID;
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
        <!-- Back btn -->
        <a href="javascript:history.back()"><button class="btn btn-light"><i  class="fa fa-backward"></i> BACK</button></a> 
        <div class="row">
          <center><h2 class="page-title">Equipment for Inspection task #{{$task}}</h2></center>
          <div class="col-lg-4">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent text-center">
                <img class="profile_img_spec" src="/img/{{$equipment -> equipmentImage}}" alt="dp">
                <h3>{{$equipment -> equipmentName}}</h3>
              </div>
              <div class="card-body">
                <p class="mb-0"><strong class="pr-1">Equipment ID:</strong> {{$equipmentID}}</p>
                <p class="mb-0"><strong class="pr-1">Rent Rate:</strong> ${{$equipment -> rentRate}} / day</p>
                <p class="mb-0"><strong class="pr-1">Equipment Owner ID:</strong> {{$ownerID}}</p>
                <a href="/Inspectors/rental/{{$equipmentID}}/{{$ownerID}}"><button class="btn btn-success">View Equipment Owner Details</button></a>
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