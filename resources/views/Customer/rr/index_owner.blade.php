@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
  <br><br><br>

  <div class="info">
    <div class="row">
        <div class="col-md-12">
          <center>
            <h2 class="page-title">View Owner Ratings and Reviews</h2>
            <h5 class="desc">These are the Ratings and Reviews you have given owners you have rented from</h5>
            <h6 style="color:lightgreen;" class="desc">{{ session('msg') }}</h6>
          </center>
      <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
        <thead class="table-head">
          <tr>
            <th>Owner Rating ID</th>
            <th>Owner</th> <!-- Receiving -->
            <th>Equipment Name</th> <!-- Must be a past rental -->
            <th>Rating</th> <!-- Both Star form and specific value -->
            <th>Review Description</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($rrs as $rr)
            <tr>
              <td>{{$rr -> ORID}}</td>
              <td>{{$rr -> fname}} {{$rr -> lname}}</td>
              <td>{{$rr -> equipmentName}}</td>
              <td>{{$rr -> rating}} / 10</td>
              <td class="review">{{$rr -> review}}</td>
              <td>{{$rr -> created_at}}</td>
              <td>
                <a style="color:blue;" href="/Customer/owners/ratingsreviews/{{$rr -> id}}"><button class="btn btn-warning">View Owner ratings</button></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
        </div>
    </div>
  </div>

  @endsection