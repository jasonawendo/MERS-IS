@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
  <br><br><br>

  <div class="row">
      <div class="col-md-12">
        <center>
        	<h2 class="page-title">Assign Inspection Tasks to Inspection Job #{{$job -> IJID}}</h2>
        	<h6 style="color:white;" class="desc">Location: {{$job -> address}}</h6>
			<h6 style="color:white;" class="desc">Inspection Date/Time: {{$job -> dateTimeInspection}}</h6>
			<br>
        </center>

		<div class="info">
				<form action="/Admin/inspectors/assigntasks" method="POST">
					@csrf
					<table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Assign</th>
								<th>Inspection Task ID</th>
									<th>Task Description</th> <!-- Will be default depending on whether it is an elisting or rental request. 
										If it is rental request, it can be "Inspect equipment for Rental request".
										If it is elisitng request, it can be "Inspect equipment for Equipment Listing request". -->
									<th>Location</th>
									<th>Equipment ID</th> <!-- For Equipment listing requests -->
									<th>Rental ID</th> <!-- For Rental requests -->
									<th>Created at</th>
									<th>Inspection deadline</th>
									<!-- <th>Action</th> -->
							</tr>
						</thead>
						<input type="text" name="job" value="{{$job -> IJID}}" hidden>
						<tbody>
						@foreach($tasks as $task)
							<tr>
								<td>
									<input style="font-size:20pt;" type="checkbox" name="task[]" value="{{$task -> ITID}}" class="form-check-input">
								</td>
								<td>{{$task -> ITID}}</td>
								<td>{{$task -> taskDescription}}</td>
								<td>{{$task -> address}}</td>
								<td>{{$task -> equipmentID}}</td>
								<td>{{$task -> rentalID}}</td>
								<td>{{$task -> created_at}}</td>
								<td>{{$task -> deadline}}</td>
							</tr>
						@endforeach
						</tbody>
					</table>

					<center>
						<input style="padding:10px; font-size: 22pt;" class="btn btn-primary" type="submit" name="submit" value="SUBMIT"> <!-- Should redirect back to Inspection Job view -->
					</center>
				</form>
		</div>
      </div>
  </div>
  @endsection
