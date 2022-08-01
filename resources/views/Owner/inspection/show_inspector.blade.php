@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
  <section>       
    <div class="profile py-4">
      <div class="container">
        <!-- Back btn -->
        <a href="javascript:history.back()"><button class="btn btn-light"><i  class="fa fa-backward"></i> BACK</button></a>
        <div class="row">
          <center><h2 class="page-title">View Inspector Profile</h2></center>
          <div class="col-lg-5 mx-auto">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent text-center">
                <img class="profile_img" src="/img/{{$user -> profilepic}}" alt="dp">
                <h3>{{$user -> fname}} {{$user -> lname}}</h3>
              </div>
              
              <div class="card-body text-center">
                <p class="mb-0"><strong class="pr-1">User ID:</strong> {{$user -> id}}</p>
                <p class="mb-0"><strong class="pr-1">Mobile Number:</strong> {{$user -> mobilenumber}}</p>
                <p class="mb-0"><strong class="pr-1">Email Address:</strong> {{$user -> email}}</p>
                <p class="mb-0"><strong class="pr-1">Address (County):</strong> {{$user -> address}}</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  
  @endsection