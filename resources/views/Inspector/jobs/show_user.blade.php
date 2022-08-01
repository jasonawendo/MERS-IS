@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
    @php
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
        <!-- Back btn -->
        <a href="javascript:history.back()"><button class="btn btn-light"><i  class="fa fa-backward"></i> BACK</button></a>
        <div class="row">
          <center><h2 class="page-title">View User Profile</h2></center>
          <div class="col-lg-5 mx-auto">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent text-center">
                <img class="profile_img" src="/img/{{$user -> profilepic}}" alt="dp">
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
              
              <div class="card-body text-center">
                <p class="mb-0"><strong class="pr-1">User ID:</strong> {{$user -> id}}</p>
                <p class="mb-0"><strong class="pr-1">Mobile Number:</strong> {{$user -> mobilenumber}}</p>
                <p class="mb-0"><strong class="pr-1">Email Address:</strong> {{$user -> email}}</p>
                <p class="mb-0 text-capitalize"><strong class="pr-1">User Type:</strong> {{$user -> usertype}}</p>
                <p class="mb-0"><strong class="pr-1">Address (County):</strong> {{$user -> address}}</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  
  @endsection