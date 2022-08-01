@extends('layouts.admin') 
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

	<link rel="stylesheet" type="text/css" href="/css/admin/user.css">
  <section>       
    <div class="profile py-4">
      <div class="container">
		<!-- Back btn -->
        <a href="javascript:history.back()"><button class="btn btn-light"><i  class="fa fa-backward"></i> BACK</button></a> 
        <div class="row">
          <center><h2 class="page-title">Equipment Owner's ratings</h2></center>
          <div class="col-lg-6 mx-auto">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent text-center">
                <img class="profile_img" src="/img/{{$user -> profilepic}}" alt="dp">
                <h3>{{$user -> fname}} {{$user -> lname}}</h3>
                <div style="color:#E30613;" class="reviews">
                  @for ($i=0; $i < $stars; $i++) 
                    <i class="fas fa-star"></i> 
                  @endfor
                  @for ($j=5; $j > $stars; $j--)
                    <i class="far fa-star"></i> 
                  @endfor
                </div> 
              </div>
              <div class="card-body text-center">
                <p class="mb-0"><strong class="pr-1">User ID:</strong> {{$user -> id}}</p>
                <p class="mb-0"><strong class="pr-1">Average Rating:</strong> {{$user -> averageRating}} / 10</p>
                <p class="mb-0"><strong class="pr-1">Email Address:</strong> {{$user -> email}}</p>

				<form action="/Admin/users/{{$user -> id}}" method="POST">
					@csrf
					<input id="isDeleted" type="number" name="isDeleted" value="1" hidden>
					<input onclick="return confirm('This action will remove this User from the system. Proceed?')"
					class="btn btn-danger" type="submit" name="submit" value="Remove User">
				</form>

              </div>
            </div>
          </div>
        </div>

        <div class="rrowner">
        	<div class="row">
        		<!-- Should be ordered by latest reviews -->
        		<!-- Maybe sort functionality can be added here e.g lowest-highest ratings and vice versa -->
				@foreach($rrs as $rr)
					@php
						$rating = $rr -> rating;
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
					<div class="col-lg-4 mb-4 mb-lg-0">
						<div class="ratereview">
					<p style="color:grey;">Date {{$rr -> created_at}}</p>
						<blockquote class="mb-4">
							<p>"{{$rr -> review}}"</p>
						</blockquote>
						<div class="reviews"> 
							@for ($i=0; $i < $stars; $i++) 
								<i class="fas fa-star"></i> 
							@endfor
							@for ($j=5; $j > $stars; $j--)
								<i class="far fa-star"></i> 
							@endfor
						</div>
						<p class="mb-0"><strong class="pr-1">Rating:</strong> {{$rating}} / 10</p>
						<div class="d-flex v-card align-items-center">
							<div class="author-name">
							<span class="d-block"><strong class="pr-1">User #{{$rr -> ownerID}}  {{$rr -> fname}} {{$rr -> lname}}</strong></span>
							<span class="d-block"> Concerning Rental: <strong class="pr-1">#{{$rr -> rentalID}}  {{$rr -> equipmentName}}</strong></span>
							</div>
						</div>
						</div>
					</div>
				@endforeach
	        </div>
        </div>
      </div>
    </div>
  </section>
  
  @endsection