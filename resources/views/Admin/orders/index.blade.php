@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
  <br><br><br>

<div class="info">
	<div class="row">
		<div class="col-md-12">
			<center><h2 class="page-title">View Orders</h2></center>
			<table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
				<thead class="table-head">
					<tr>
						<th>Order ID</th>
						<th>Customer ID</th>
						<th>Payment Status</th>
						<th>total</th>
						<th>Created at</th>
						<th>Updated at</th> <!-- Updated once user pays for the Order -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
					@php
						$status = $order -> paymentStatus;
					@endphp
						<tr>
							<td>{{$order -> orderID}}</td>
							<td>{{$order -> customerID}}</td>
							<td class="icons">
								@if($status == 1)
									<i style="color:green;" class="fas fa-check"></i>
								@else
									<i style="color:red;" class="fas fa-exclamation"></i>
								@endif	
							</td>
							<!-- <td>Yes</td> -->
							<td>${{$order -> amount}}</td>
							<td>{{$order -> created_at}}</td>
							<td>{{$order -> updated_at}}</td>
							<td class="icons">
								<a class="btn btn-info" style="color:white;" href="/Admin/orders/{{$order -> orderID}}"><i class="fas fa-eye"></i></a>
							</td>
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