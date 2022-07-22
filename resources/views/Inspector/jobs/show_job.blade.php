@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
	@php
		use Carbon\Carbon; //Displays current date and time
		$dt = Carbon::now();
		$currentdatetime = $dt->toDateTimeString();
		
		


		$inspectiondatetime = $job -> dateTimeInspection;
		$completionStatus = $job -> isCompleted;
	@endphp

  <section>       
    <div class="profile py-4">
      <div class="container">
        <div class="row">
          <center>
			<h2 class="page-title">View Inspection Job #{{$job -> IJID}}</h2>
		  </center>
	        <div class="col-lg-12">
		        <div class="card shadow-sm">
		          <div class="card-header bg-transparent border-0">
		            <h3 class="mb-0"></i>General Information</h3>
		          </div>
		          	<div class="card-body pt-0">
		                <table class="table table-bordered">
		                  <tr>
		                    <th width="30%">Inspection Date & Time</th>
		                    <td width="2%">:</td>
		                    <td>{{$inspectiondatetime}}</td>
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
				<center>
					<h3 class="tbl-title"></i>Inspection Tasks for Inspection Job #{{$job -> IJID}}</h3>
					<h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
				</center>
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
						<th>Details</th>
						@if(($inspectiondatetime <= $currentdatetime) && ($completionStatus == 0))
						<th>Action</th>
						@else
						@endif
						
					</tr>
					</thead>
					<tbody>
						
						@foreach($tasks as $task)
						@php
							$completed = $task -> isCompleted;
							$equipmentID = $task -> equipmentID;
							$rentalID = $task -> rentalID;
							$ITID = $task -> ITID;
							$IJID = $job -> IJID;
						@endphp
							<tr>
								<td>{{$ITID}}</td>
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
								
									@if($completed == 0)
										@if(!isset($equipmentID) && isset($rentalID))
											<td><a href="/Inspectors/rental/redirect/{{$IJID}}/{{$ITID}}/{{$rentalID}}"><button class="btn btn-info">View Equipment details</button></a></td>
											@if(($inspectiondatetime <= $currentdatetime) && ($completionStatus == 0))
												<td class="icons">
													<form action="/Inspectors/rental/accepted/{{$IJID}}/{{$ITID}}/{{$rentalID}}" method="POST">
														@csrf
														<input id="accepted" type="text" name="status" value="accepted" hidden>
														<input onclick="return confirm('This action will complete and approve the Inspection and accept the correlating rental request. Proceed?')"
														class="btn btn-success" type="submit" name="submit" value="Accept">
													</form>
													<br>
													<form action="/Inspectors/rental/rejected/{{$IJID}}/{{$ITID}}/{{$rentalID}}" method="POST">
														@csrf
														<input id="rejected" type="text" name="status" value="rejected" hidden>
														<input onclick="return confirm('This action will complete and disprove the Inspection and reject the correlating rental request. Proceed?')"
														class="btn btn-danger" type="submit" name="submit" value="Reject">
													</form>
													<br>
												</td>
											@else
											@endif
										
										@elseif(!isset($rentalID) && isset($equipmentID))
											<td><a href="/Inspectors/rental/{{$IJID}}/{{$ITID}}/{{$equipmentID}}"><button class="btn btn-info">View Equipment details</button></a></td>
											@if(($inspectiondatetime <= $currentdatetime) && ($completionStatus == 0))
												<td class="icons">
													<a style="color:yellow;" href="/Inspectors/equipment/{{$IJID}}/{{$ITID}}/{{$equipmentID}}"><i class="fa fa-pen"></i></a>
												</td>
											@else
											@endif


										@else
										@endif
									@else
										@if(!isset($equipmentID) && isset($rentalID))
											<td><a href="/Inspectors/rental/redirect/{{$IJID}}/{{$ITID}}/{{$rentalID}}"><button class="btn btn-info">View Equipment details</button></a></td>
										@else
											<td><a href="/Inspectors/rental/{{$IJID}}/{{$ITID}}/{{$equipmentID}}"><button class="btn btn-info">View Equipment details</button></a></td>
										@endif
									@endif
								
							</tr>
						@endforeach
				
					</tbody>
				</table>
		</div>
	</div>
  </section>
  
  @endsection