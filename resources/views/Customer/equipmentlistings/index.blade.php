@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->


  <!-- <style type="text/css">
		.sortfilter a
		{
			display: inline-block;
		}
		.sortfilter button 
		{
		  border: none;
		  outline: 0;
		  padding: 12px;
		  color: black;
		  background-color: burlywood ;
		  text-align: center;
		  cursor: pointer;
		  width: 100%;
		  font-size: 10pt;
		  border-radius: 5px;
		  transition: 0.5s;
		}
		.sortfilter button:hover{
			  background-color: #FF523B;
			  transform: scale(1.1);
			}
	</style> -->

    <link rel="stylesheet" type="text/css" href="/css/equipment.css">
    <!-- Equipment section -->
    <section class="equipment" id="equipment">
      <div class="container">
        <div class="row min-vh-40 align-items-center">
          <div class="col-md-6">
            <div class="content">
              <h3>Equipment</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Equipment Listings</strong></h2>
            <p class="mb-5">{{ $msg }}</p>    
          </div>
        </div>

        <!-- <div class="sortfilter col-md-12">
          <h4>Filter By:</h4>
            <a style="padding-left:10px;" class="nav-link menu" href="womenproduct.php?productfilter=4"><button>Formal</button></a>
            <a style="padding-left:10px;" class="nav-link menu" href="womenproduct.php?productfilter=5"><button>Casual</button></a>
            <a style="padding-left:10px;" class="nav-link menu" href="womenproduct.php?productfilter=6"><button>Sports</button></a>
        </div>
        <br><br> -->
        <div class="row">
          @foreach($equipmentlisting as $equipment)
          @php 
            $availability = $equipment -> equipmentAvailability;
          @endphp

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
              <div class="listing-img h-100 mr-4">
                <img src="/img/{{$equipment -> equipmentImage}}" alt="Image" class="img-fluid">
              </div>
              <div class="listing-contents h-100">
                <h3>{{$equipment -> equipmentName}}</h3>
                <div class="rent-price">
                  <strong>${{$equipment -> rentRate}}</strong><span class="mx-1">/</span>day
                </div>
                <div class="owner">
                  <div class="reviews">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> 
                  </div>  
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Availability:</span><br>
                    @if($availability == 1)
									  <span class="number">Yes</span>
									  @else
									  <span class="number">No</span>
									  @endif
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Condition:</span><br>
                    <span class="number">{{$equipment -> equipmentCondition}}</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Value:</span><br>
                    <span class="number">${{$equipment -> equipmentValue}}</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Location:</span><br>
                    <span class="number">{{$equipment -> address}}</span>
                  </div>&nbsp;
                </div>
                <div>
                  <p>{{$equipment -> equipmentDescription}}.</p>
                  <!-- <p><a href="#" class="btn btn-success btn-sm">Rent Now</a></p> -->
                  <p><a href="/Customer/equipmentlistings/{{$equipment -> equipmentID}}" class="btn btn-primary btn-xl">View listing</a></p>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
    
@endsection