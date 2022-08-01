@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

  <br><br><br>
<style>
    .total-price
    {
    display: flex;
    justify-content: flex-end;
    }

    .total-price table
    {
    border-top: 3px solid #E30613;
    width: 100%;
    max-width: 350px;
    }

    td:last-child
    {
    text-align: right;
    }

    th:last-child
    {
    text-align: right;
    }

    @media(max-width:790px)
    {
    .cart-page
    {
    margin: 80px auto;
    }

    .total-price
    {
    display: flex;
    justify-content: flex-end;
    }

    .total-price table
    {
    border-top: 3px solid #E30613;
    width: 100%;
    }
</style>

<div class="info">
  	<div class="row">
      <div class="col-md-12">
        <center>
            <h2 class="page-title">Cart</h2>
            <h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
        </center>
        <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
          	<thead class="table-head">
	            <tr>
	            	<th>Rental ID</th>
					<th>Equipment</th>
					<th>Quantity</th>
					<th>Start Date|Time</th>
					<!-- Should not be able to book if another customer has already booked the slot -->
					<th>End Date|Time</th>
					<th>Total Price</th>
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
							<td>{{$rental -> quantity}}</td>
							<td>{{$rental -> dateTimeStart}}</td>
							<td>{{$rental -> dateTimeEnd}}</td>
							<td>${{$rental -> totalPrice}}</td>
                            <td><a class="btn btn-danger" href="/Customer/rentalrequest/remove/{{$rental -> rentalID}}"><i class="fas fa-trash"></i></a></td>
						</tr>
					@endforeach
            	</tbody>
        </table>

        <div class="total-price">
            <table class="table" style="color:white;font-size:20pt;">
                <tr>
                    <td style="font-weight: bold;">Total</td> 
                    <td>${{$total}}</td>
                </tr>
            </table>
        </div>

        <center>
            <a href="/Customer/rental/createorder/{{$total}}" style="padding:10px; font-size: 22pt;" class="btn btn-success"> CREATE ORDER</a>
        </center>
      </div>
  	</div>
</div>
<br><br>

  @endsection