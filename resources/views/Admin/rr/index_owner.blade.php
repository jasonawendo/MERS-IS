@extends('layouts.admin') 
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
            <h5 class="desc">These are the Ratings and Reviews given by the Customers to the Equipment Owners</h5>

          </center>
          <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
            <thead class="table-head">
                <tr>
                  <th>Customer Rating ID</th>
                  <th>Customer ID</th><!-- Sending -->
                  <th>Owner ID</th>  <!-- Receiving -->
                  <th>Details</th>
                  <th>Rental ID</th> <!-- Must be a past rental -->
                  <th>Rating</th> <!-- Both Star form and specific value -->
                  <th>Review Description</th>
                  <th>Created At</th>
                  
                </tr>
            </thead>
            <tbody>
              @foreach($rrs as $rr)
                <tr>
                  <td>{{$rr -> ORID}}</td>
                  <td>{{$rr -> customerID}} - {{$rr -> fname}} {{$rr -> lname}}</td>
                  <td>{{$rr -> ownerID}}</td>
                  <td class="icons">
                    <a style="color:blue;" href="/Admin/ratingsreviews/owners/{{$rr -> ownerID}}"><button class="btn btn-warning">View Owner ratings</button>
                  </td>
                  <td>{{$rr -> rentalID}}</td>
                  <td>{{$rr -> rating}} / 10</td>
                  <td>{{$rr -> review}}</td>
                  <td>{{$rr -> created_at}}</td>
                  
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
 
  @endsection