@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

  <br><br><br>

<div class="info">
  	<div class="row">
      <div class="col-md-12">
        <center><h2 class="page-title">{{ $title }}</h2></center>
        <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
          	<thead class="table-head">
	            <tr>
	            	<th>Rental ID</th>
					<th>Equipment ID - name</th>
					<th>Customer ID - name</th>
					<th>Quantity</th>
					<th>Start Date|Time</th> <!-- Must be at least a week before the Current date/time -->
					<!-- Should not be able to book if another customer has already booked the slot -->
					<th>End Date|Time</th>
					<th>Total Price</th>
					<th>Inspection Status</th>
					<th>Owner Status</th>
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
							<td>{{$rental -> equipmentID}} - {{$rental -> equipmentName}}</td>
							<td>{{$rental -> customerID}} - {{$rental -> fname}} {{$rental -> lname}}</td>
							<td>{{$rental -> quantity}}</td>
							<td>{{$rental -> dateTimeStart}}</td>
							<td>{{$rental -> dateTimeEnd}}</td>
							<td>${{$rental -> totalPrice}}</td>

							@if($InspectionStatus == "accepted")
								<td style="color:green; font-weight: bold;">Accepted</td>
							@elseif($InspectionStatus == "pending")
								<td style="color:royalblue; font-weight: bold;">Pending</td>
							@else
								<td style="color:red; font-weight: bold;">Rejected</td>
							@endif

							@if($OwnerStatus == "accepted")
								<td style="color:green; font-weight: bold;">Accepted</td>
							@elseif($OwnerStatus == "pending")
								<td style="color:royalblue; font-weight: bold;">Pending</td>
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
	  <center>
            <button class="btn btn-primary" onclick='window.print()'>Print</button>
          </center>
		  <br><br>
  	</div>
</div>

  @endsection