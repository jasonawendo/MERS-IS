@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

  <section>       
    <div class="profile py-4">
      <div class="container">
        <div class="row">
          <center><h2 class="page-title">View Inspection Job #{{$job -> IJID}}</h2></center>
	        <div class="col-lg-12">
		        <div class="card shadow-sm">
		          <div class="card-header bg-transparent border-0">
		            <h3 class="mb-0"></i>General Information</h3>
		          </div>
		          	<div class="card-body pt-0">
		                <table class="table table-bordered">
		                  <tr>
		                    <th width="30%">Inspector ID</th>
		                    <td width="2%">:</td>
		                    <td>{{$job -> inspectorID}}</td>
		                  </tr>
		                  <tr>
		                    <th width="30%">Inspection Date & Time</th>
		                    <td width="2%">:</td>
		                    <td>{{$job -> dateTimeInspection}}</td>
		                  </tr>
		                  <tr>
		                    <th width="30%">Address (County)</th>
		                    <td width="2%">:</td>
		                    <td>{{$job -> address}}</td>
		                  </tr>
		                  <tr>
		                    <th width="30%">Created At</th>
		                    <td width="2%">:</td>
		                    <td>{{$job -> created_at}}</td>
		                  </tr>
		                  <tr>
		                    <th width="30%">Updated At</th>
		                    <td width="2%">:</td>
		                    <td>{{$job -> updated_at}}</td>
		                  </tr>
		                </table>
		          	</div>
		        </div>
		          <div style="height: 26px"></div>
	        </div>
        </div>

        <!-- All rentals for this specific order -->

      </div>
    </div>

	<div class="info">
		<div class="row">
				<center><h3 class="tbl-title"></i>Inspection Tasks for Inspection Job #{{$job -> IJID}}</h3></center>
				<table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>Inspection Task ID</th>
						<th>Task Description</th> <!-- Will be default depending on whether it is an elisting or rental request. 
						If it is rental request, it can be "Inspect equipment for Rental request".
						If it is elisitng request, it can be "Inspect equipment for Equipment Listing request". -->
						<th>Address</th>
						<th>Equipment ID</th> <!-- For Equipment listing requests -->
						<th>Rental ID</th> <!-- For Rental requests -->
						<th>Created at</th>
						<th>Inspection Done</th>
						<!-- 	      					<th>Action</th> -->
					</tr>
					</thead>
					<tbody>
						
						@foreach($tasks as $task)
						@php
							$completed = $task -> isCompleted;
						@endphp
							<tr>
								<td>{{$task -> ITID}}</td>
								<td>{{$task -> taskDescription}}</td>
								<td>{{$task -> address}}</td>
								<td>{{$task -> equipmentID}}</td>
								<td>{{$task -> rentalID}}</td>
								<td>{{$task -> created_at}}</td>
								<td>
								@if($completed == 1)
								<i style="color:green;" class="fa fa-check"></i> Complete
								@else  
								<i style="color:red;" class="fa fa-ban"></i> Incomplete
								@endif
								</td>
							</tr>
						@endforeach
				
					</tbody>
				</table>
		</div>
	</div>
  </section>
  
  @endsection