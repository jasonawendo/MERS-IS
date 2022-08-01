@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

    @php
    use Carbon\Carbon;
      $dt = Carbon::now()->setTimezone('Africa/Nairobi');
      $datetime = $dt->toDateTimeString();
    @endphp
<style>
  .details .input-box select{ /*For selection*/
  width: 100%;
}
</style>
    <br><br>


  <section class="form">
    <div class="row">
      <div class="col-md-12">
        <div class="container">
           <h1>Create Inspection Job</h1>
          <div class="content">

            <form action="/Admin/inspectors/createjob" method="POST">
              @csrf
              <div class="details">

                <!-- <div class="input-box">
                  <span class="details">Inspector ID</span>
                  <input type="text" name="userID" value="" required>
                </div> -->

                <div class="input-box"> 
                   <span class="details">Inspector Choice</span> <!-- Displays address/location options based on the unassigned inspection tasks -->
                   <select id="inspectorID" name="inspectorID" style=" margin-top: 15px;">
                    <optgroup label="Inspector" style="font-family:Montserrat;">
                      @foreach($inspectors as $inspector)
                        <option value="{{$inspector -> id}}" style="color: black;">{{$inspector -> id}} - {{$inspector -> fname}} {{$inspector -> lname}} - {{$inspector -> address}}</option>
                      @endforeach
                    </optgroup>
                  </select>
                </div>

                <div class="input-box">
                  <span class="details">Inspection Date & Time</span>
                  <input type="datetime-local" name="inspectionDateTime" min="" required> <br/><br/>
                  <!-- <input type="date" name="inspectionDateTime" min="2021-06-25" max="2021-06-30" required> <br/><br/> -->
                  <!-- Min and max will be edited based on current date and a week(7 days) before rental was planned to begin. Maybe.  -->
                </div>

                <div class="input-box"> 
                   <span class="details">Address (County)</span> <!-- Displays address/location options based on the unassigned inspection tasks -->
                   <select id="Address" name="address" style=" margin-top: 5px;">
                    <optgroup label="Address" style="font-family:Montserrat;">
                      @foreach($tasks as $task)
                        <option value="{{$task -> address}}" style="color: black;">{{$task -> address}}</option>
                      @endforeach
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="button">
                <input style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" name="submit" value="Create Job">
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="info">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h1>Unassigned Inspection tasks</h1>
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
              <th>Inspection deadline</th>
            </tr>
          </thead>

          <tbody>
            @foreach($tasks as $task)
              <tr>
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
      </div>
    </div>
  </section>
  
  @endsection

