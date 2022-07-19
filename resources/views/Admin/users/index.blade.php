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
          <h2 class="page-title">{{ $title }}</h2>
          <h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
        </center>
        <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
            <thead class="table-head">
              <tr>
                <th>User ID</th>
                <th>Profile image</th>
                <th>Role</th>
                <th>Full Name</th>
                <th>Mobile Number</th>
                <th>Email Address</th>
                <th>Address (County)</th>
                <th>User Type</th>
                <th>Company Name</th>
                <th>Status</th>
                <th>Average Rating</th><!-- By default, all new users will start with a rating of 4 -->
                <th>Created at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              @php
                $status = $user -> status;
              @endphp
              <tr>
                <td>{{$user -> id}}</td>
                <td>
                  @if($status == "accepted")
                      <img class="tbl_img" src="/img/{{$user -> profilepic}}">
                  @else
                </td>
                @endif
                <td style="text-transform:capitalize;">{{$user -> role}}</td>
                <td>{{$user -> fname}} {{$user -> lname}}</td>
                <td>{{$user -> mobilenumber}}</td>
                <td>{{$user -> email}}</td>
                <td>{{$user -> address}}</td>
                <td style="text-transform:capitalize;">{{$user -> usertype}}</td>
                <td>{{$user -> companyname}}</td>

                @if($status == "accepted")
                      <td style="color:green; font-weight: bold;">Accepted</td>
                @elseif($status == "pending")
                      <td style="color:royalblue; font-weight: bold;">Pending</td>
                @else
                      <td style="color:red; font-weight: bold;">Rejected</td>
                @endif
                <td>{{$user -> averageRating}} / 10</td>
                <td>{{$user -> created_at}}</td>

                
                @if($status == "pending")
                  <td class="icons">
                    <a style="color:blue;" href="/Admin/users/{{$user -> id}}"><i class="fas fa-eye"></i></a>
                    <form action="/Admin/users/accepted/{{$user -> id}}"" method="POST">
                        @csrf
                        <input id="accepted" type="text" name="status" value="accepted" hidden>
                        <input onclick="return confirm('This action will accept this user registration request and add them to the system. Proceed?')"
                        class="btn btn-success" type="submit" name="submit" value="Accept">
                    </form>
                    <br>
                    <form action="/Admin/users/rejected/{{$user -> id}}"" method="POST">
                        @csrf
                        <input id="rejected" type="text" name="status" value="rejected" hidden>
                        <input onclick="return confirm('This action will reject this user registration request and disallow them from accessing the system. Proceed?')"
                        class="btn btn-danger" type="submit" name="submit" value="Reject">
                    </form>
                    
                  </td>  
                @else
                  <td class="icons">
                    <a style="color:blue;" href="/Admin/users/{{$user -> id}}"><i class="fas fa-eye"></i></a>
                  </td>
                @endif
                  
                  
                  <!-- <button class="btn btn-info">View Orders</button>
                  <button class="btn btn-info">View Requests</button>
                  <button class="btn btn-warning">View Reviews</button> -->
                
              </tr>
            @endforeach
            </tbody>
        </table>
      </div>
  </div>
</div>
  
  @endsection