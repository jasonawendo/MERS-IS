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
        	<h2 class="page-title">Inspection Tasks</h2>
        	<h5 class="desc">{{$title}}</h5>
        </center>

        <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Inspection Task ID</th>
					<th>Task Description</th> <!-- Will be default depending on whether it is an elisting or rental request. 
						If it is rental request, it can be "Inspect equipment for Rental request".
						If it is elisitng request, it can be "Inspect equipment for Equipment Listing request". -->
					<th>Address</th>
					<th>Rental ID - Name</th> <!-- For Rental requests -->
					<th>Created at</th>
					<th>Inspection Date - Time</th> 
					<th>Action</th>
					<!-- Applies to rental requests only, and functionality should be considered to count 7 days before rental would officially begin -->
				</tr>
			</thead>

			<tbody>
				@foreach($tasks as $task)
					<tr>
						<td>{{$task -> ITID}}</td>
						<td>{{$task -> taskDescription}}</td>
						<td>{{$task -> address}}</td>
						<td>{{$task -> rentalID}} - {{$task -> equipmentName}}</td>
						<td>{{$task -> created_at}}</td>
						<td>{{$task -> dateTimeInspection}}</td> <!-- Coming from Inspection job table -->
						<td>
							<a class="btn btn-warning" href="/Owner/inspectiontasks/{{$task -> inspectorID}}">View Inspector details</a>
						</td>
						
					</tr>
				@endforeach
			</tbody>
	    </table>
      </div>
  </div>
</div>

  @endsection