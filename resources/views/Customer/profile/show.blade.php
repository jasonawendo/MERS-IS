@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

    @php
      $profile = $user->profilepic;
      $rating = $user -> averageRating;
      $stars = 0;
      if ($rating == 1 || $rating == 2)
      {
        $stars = 1;
      }
      else if ($rating == 3 || $rating == 4)
      {
        $stars = 2;
      }
      else if ($rating == 5 || $rating == 6)
      {
        $stars = 3;
      }
      else if ($rating == 7 || $rating == 8)
      {
        $stars = 4;
      }
      else if ($rating == 9 || $rating == 10)
      {
        $stars = 5;
      }
    @endphp

  <section>       
    <div class="profile py-4">
      <div class="container">
        <div class="row">
          <center>
            <h2 class="page-title">{{$user -> fname}}'s Profile</h2>
            <h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
          </center>
          <div class="col-lg-4">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent text-center">
              @if(!isset($profile))
                <img class="profile_img" src="/img/admin.jpg" alt="dp">
              @else
                <img class="profile_img" src="/img/{{$profile}}" alt="dp">
              @endif
                <div class="reviews">
                  @for ($i=0; $i < $stars; $i++) 
                    <i class="fas fa-star"></i> 
                  @endfor
                  @for ($j=5; $j > $stars; $j--)
                    <i class="far fa-star"></i> 
                  @endfor
                </div>
                <h3>{{$user -> fname}} {{$user -> lname}}</h3>
              </div>
              
              <div class="card-body">
                <p class="mb-0"><strong class="pr-1">User ID:</strong> {{$user -> id}}</p>
                <p class="mb-0"><strong class="pr-1">Mobile Number:</strong> {{$user -> mobilenumber}}</p>
                <p class="mb-0"><strong class="pr-1">Email Address:</strong> {{$user -> email}}</p>
                <p class="mb-0"><strong class="pr-1">Average Rating:</strong> {{$rating}}/10</p>
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
                    <th width="30%">National ID</th>
                    <td width="2%">:</td>
                    <td>{{$user -> nationalID}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Role</th>
                    <td width="2%">:</td>
                    <td>{{$user -> role}}</td>
                  </tr>
                  <tr>
                    <th width="30%">KRA Pin</th>
                    <td width="2%">:</td>
                    <td>{{$user -> krapin}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Address (County)	</th>
                    <td width="2%">:</td>
                    <td>{{$user -> address}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Company Name	</th>
                    <td width="2%">:</td>
                    <td>{{$user -> companyname}}</td>
                  </tr>
                  <tr>
                    <th width="30%">LinkedIn link	</th>
                    <td width="2%">:</td>
                    <td>{{$user -> linkedin}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Website link	</th>
                    <td width="2%">:</td>
                    <td>{{$user -> websitelink}}</td>
                  </tr>
                  <tr>
                    <th width="30%">User type</th>
                    <td width="2%">:</td>
                    <td style="text-transform:capitalize;">{{$user -> usertype}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Created At</th>
                    <td width="2%">:</td>
                    <td>{{$user -> created_at}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Action</th>
                    <td width="2%">:</td>
                    <td><a href="/Customer/profile/edit/{{$user -> id}}"><button class="btn btn-warning">Edit Profile Details</button></a></td>
                  </tr>
                </table>
              </div>
            </div>
            <div style="height: 26px"></div>
            <div class="card shadow-sm">
              <div class="card-header bg-transparent border-0">
                <h3 class="mb-0"></i>Bio Description</h3>
              </div>
              <div class="card-body pt-0">
                  <p>{{$user -> bio}}</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  
  @endsection