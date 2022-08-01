@extends('layouts.owner') 
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
	            	<th>Rental ID</th>
					<th>Equipment</th>
					<th>Customer Name</th>
					<th>Customer Details</th>
					<th>Quantity</th>
					<th>Start Date|Time</th> <!-- Must be at least a week before the Current date/time -->
					<!-- Should not be able to book if another customer has already booked the slot -->
					<th>End Date|Time</th>
					<th>Total Price</th>
					<th>Inspection Status</th>
					<th>Owner Status</th>
					<th>Created at</th>
					
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
							<td>
								<a href="/Owner/customers/ratingsreviews/{{$rental -> customerID}}" class="btn btn-warning">View Customer Details</a>
							</td>
							<td>{{$rental -> quantity}}</td>
							<td>{{$rental -> dateTimeStart}}</td>
							<td>{{$rental -> dateTimeEnd}}</td>
							<td>${{$rental -> totalPrice}}</td>

							@if($OwnerStatus == "rejected")
							<td>N / A</td>
							@else
								@if($InspectionStatus == "accepted")
									<td style="color:green; font-weight: bold;">Accepted</td>
								@elseif($InspectionStatus == "pending")
									<td style="color:royalblue; font-weight: bold;">Pending</td>
								@else
									<td style="color:red; font-weight: bold;">Rejected</td>
								@endif
							@endif

							@if($OwnerStatus == "accepted")
								<td style="color:green; font-weight: bold;">Accepted</td>
							@elseif($OwnerStatus == "pending")
								<td style="color:royalblue; font-weight: bold;">Pending</td>
							@else
								<td style="color:red; font-weight: bold;">Rejected</td>
							@endif
							<td>{{$rental -> created_at}}</td>
							
							@if(($InspectionStatus == "pending") && ($OwnerStatus == "pending"))
								<td class="icons">
									<a href="/Owner/rental/{{$rental -> rentalID}}/accepted/{{$rental -> equipmentID}}"
									onclick="return confirm('This action will accept {{$rental -> fname}} {{$rental -> lname}}s rental request. Proceed?')"
									class="btn btn-success"><i class="fas fa-check"></i></a>
									<br><br>
									<a href="/Owner/rental/{{$rental -> rentalID}}/rejected/{{$rental -> equipmentID}}"
									onclick="return confirm('This action will reject {{$rental -> fname}} {{$rental -> lname}}s rental request. Proceed?')"
									class="btn btn-danger"><i class="fas fa-ban"></i></a>
								</td>
							@else
								<td></td>
							@endif
						</tr>
					@endforeach
            	</tbody>
        </table>
      </div>
	  <center>
            <button class="btn btn-primary" onclick='window.print()'>Print</button>
          </center>
          <br><br>
  	</div>
</div>

  @endsection