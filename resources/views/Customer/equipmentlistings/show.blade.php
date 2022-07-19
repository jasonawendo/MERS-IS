@extends('layouts.layout') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

	<!-- PHP All php code stays here -->
	@php 
		$availability = $equipment -> equipmentAvailability;
	@endphp
	<!-- PHP-->

    <link rel="stylesheet" type="text/css" href="/css/specequipment.css">

      <div id="page">
		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg product-detail-wrap" style="padding-top:90px;">
					<div class="col-sm-8">
						<img style="width:80%; margin-bottom:20px;" src="/img/{{$equipment -> equipmentImage}}">
					</div>
					<div class="col-sm-4 card">
						<div class="product-desc">
							<h3>{{$equipment -> equipmentName}}</h3>
							<p class="price">${{$equipment -> rentRate}} /day</p>
							<p class="description">{{$equipment -> equipmentDescription}}.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-equipment"><i class="fas fa-plus"></i> Make Rental Request</a>
                            </div>
					    </div>
				    </div>

				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-md-12 pills">
								<div class="bd-example bd-example-tabs">
								  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

								    <li class="nav-item">
								      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Description</a>
								    </li>
									<li class="nav-item">
								      <a class="nav-link" id="pills-specs-tab" data-toggle="pill" href="#pills-specs" role="tab" aria-controls="pills-specs" aria-expanded="true">Specifications</a>
								    </li>
								    <li class="nav-item">
								      <a class="nav-link" id="pills-owner-tab" data-toggle="pill" href="#pills-owner" role="tab" aria-controls="pills-owner" aria-expanded="true">Equipment Owner</a>
								    </li>
								  </ul>

								  <div class="tab-content" id="pills-tabContent">
								  	<!-- Description -->
								    <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
									      <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
											<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
											<ul>
												<li>The Big Oxmox advised her not to do so</li>
												<li>Because there were thousands of bad Commas</li>
												<li>Wild Question Marks and devious Semikoli</li>
												<li>She packed her seven versalia</li>
												<li>tial into the belt and made herself on the way.</li>
											</ul>
								    </div>

                                    <!-- Specs -->
                                    <div class="tab-pane border fade" id="pills-specs" role="tabpanel" aria-labelledby="pills-specs-tab">
								      <p>Condition: {{$equipment -> equipmentCondition}}.</p> 
									  <p>Equipment Value: ${{$equipment -> equipmentValue}}</p> 
									  @if($availability == 1)
									  	<p>Availability: Yes</p>
									  @else
									  	<p>Availability: No</p>
									  @endif
									  <p>Condition: {{$equipment -> address}}.</p> 
								    </div>

								    <!-- Equipment Owner -->
								    <div class="tab-pane border fade" id="pills-owner" role="tabpanel" aria-labelledby="pills-owner-tab">
								      <div class="row">
								   		<div class="col-md-12">
								   			<h3 class="head">Owner of this equipment</h3>
								   			<div class="owner">
										   		<div class="user-img" style="background-image: url(https://images.unsplash.com/photo-1618077360395-f3068be8e001?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80)"></div>
										   		<div class="desc">
										   			<h4>
										   				<span class="text-left">Jacob Webb</span>
										   			</h4>

                                                                <!-- Star rating -->
                                                    <div class="reviews">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i> 
                                                    </div>  
										   			<p>Equipment Owner Biography blah </p>
                                                       <a href="#" class="btn btn-equipment"><i class="fas fa-eye"></i> View Profile</a>
                                                </div>
										   	</div>
								   		</div>
								   	</div>
								    </div>
								  </div>
								</div>
				         </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="/js/jquery.flexslider-min.js"></script>

   <!-- For SWITCHING decription and Owner animation -->
   <script src="/js/bootstrap.min.js"></script> 





    
@endsection