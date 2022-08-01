@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

  <br><br><br>

<div class="info">
  	<div class="row">
      <div class="col-md-12">
        <center>
			<h2 class="page-title">Pending Rating and Review</h2>
			<h5 class="desc">These are the Ratings and Reviews you need to do for Owners you have rented from</h5>
		</center>
        <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
          	<thead class="table-head">
	            <tr>
	            	<th>Rental ID</th>
					<th>Equipment</th>
					<th>Owner</th>
					<th>Start Date|Time</th> <!-- Must be at least a week before the Current date/time -->
					<!-- Should not be able to book if another customer has already booked the slot -->
					<th>End Date|Time</th>
					<th>Action</th>
      			</tr>
      			</thead>
      			<tbody>
					@foreach($rentals as $rental)
						@php 
							$InspectionStatus = $rental -> inspectionStatus;
							$OwnerStatus = $rental -> ownerStatus;
						@endphp
						<tr>
							<td>{{$rental -> rentalID}}</td>
							<td>{{$rental -> equipmentName}}</td>
							<td>{{$rental -> fname}} {{$rental -> lname}}</td>
							<td>{{$rental -> dateTimeStart}}</td>
							<td>{{$rental -> dateTimeEnd}}</td>
							<td>
								<a class="btn btn-info" href="/Customer/owners/ratingsreviews/{{$rental -> ownerID}}">View Owner details</a>
								<a style="color:white;" class="btn btn-warning" href="/Customer/owners/ratingsreviews/create/{{$rental -> ownerID}}/{{$rental -> rentalID}}">Give Rating & Review</a>
							</td>
						</tr>
					@endforeach
            	</tbody>
        </table>
      </div>
  	</div>
</div>

  @endsection