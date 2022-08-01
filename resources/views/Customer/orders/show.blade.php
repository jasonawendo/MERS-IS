@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
  <section>       
    <div class="profile py-4">
      <div class="container">
        <div class="row">
          <center><h2 class="page-title">View Order #{{$order -> orderID}}</h2></center>
	        <div class="col-lg-12">
		        <div class="card shadow-sm">
		          <div class="card-header bg-transparent border-0">
		            <h3 class="mb-0"></i>General Information</h3>
		          </div>
		          	<div class="card-body pt-0">
		                <table class="table table-bordered">
		                  <tr>
		                    <th width="30%">Payment Status</th>
		                    <td width="2%">:</td>
							@php
								$status = $order -> paymentStatus;
								$approved = $order -> isApproved;
								$total = $order -> amount;
							@endphp

							@if($status == 1)
								<td>Paid</td>
							@else
								<td>Not Paid</td>
							@endif	
		                  </tr>
		                  <tr>
		                    <th width="30%">Total Bill</th>
		                    <td width="2%">:</td>
		                    <td>${{$order -> amount}}</td>
		                  </tr>
		                  <tr>
		                    <th width="30%">Created At</th>
		                    <td width="2%">:</td>
		                    <td>{{$order -> created_at}}</td>
		                  </tr>
		                  <tr>
		                    <th width="30%">Updated At</th>
		                    <td width="2%">:</td>
		                    <td>{{$order -> updated_at}}</td>
		                  </tr>
						  <tr>
		                    <th width="30%">Action</th>
		                    <td width="2%">:</td>
		                    <td>
								@if(($approved == 1) && ($total != 0) && ($status == 0))
									<a class="btn btn-warning" style="color:white;" href="/Customer/orders/{{$order -> orderID}}">PAY NOW</a>
								@else
								@endif
							</td>
		                  </tr>
		                </table>
		          	</div>
		        </div>
		          <div style="height: 26px"></div>
	        </div>
        </div>

      </div>
    </div>

	<div class="info">
		<div class="row">
			<center><h3 class="tbl-title"></i>Rentals for Order #{{$order -> orderID}}</h3></center>
			<table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Rental ID</th>
						<th>Equipment</th>
						<th>Quantity</th>
						<th>Start Date|Time</th> <!-- Must be at least a week before the Current date/time -->
						<!-- Should not be able to book if another customer has already booked the slot -->
						<th>End Date|Time</th>
						<th>Total Price</th>
						<th>Owner Status</th>
						<th>Inspection Status</th>
						<th>Created at</th>
						<th>Updated at</th>
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
							<td>{{$rental -> quantity}}</td>
							<td>{{$rental -> dateTimeStart}}</td>
							<td>{{$rental -> dateTimeEnd}}</td>
							<td>${{$rental -> totalPrice}}</td>

							@if($OwnerStatus == "accepted")
								<td style="color:green; font-weight: bold;">Accepted</td>
							@elseif($OwnerStatus == "pending")
								<td style="color:royalblue; font-weight: bold;">Pending</td>
							@else
								<td style="color:red; font-weight: bold;">Rejected</td>
							@endif

							@if($InspectionStatus == "accepted")
								<td style="color:green; font-weight: bold;">Accepted</td>
							@elseif(($InspectionStatus == "pending") && ( ($OwnerStatus == "pending") || ($OwnerStatus == "accepted") ))
								<td style="color:royalblue; font-weight: bold;">Pending</td>
							@elseif(($InspectionStatus == "pending") && ($OwnerStatus == "rejected"))
								<td>N / A</td>
							@else
								<td style="color:red; font-weight: bold;">Rejected</td>
							@endif
							<td>{{$rental -> created_at}}</td>
							<td>{{$rental -> updated_at}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>	
	</div>
  </section>
  @endsection