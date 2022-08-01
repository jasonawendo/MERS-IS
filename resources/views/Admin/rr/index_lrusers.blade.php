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
        	<h2 class="page-title">View Low Rated Users</h2>
        	<h5 class="desc">These are the users with a rating below 4 / 10 or 2 stars</h5>
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
                <th>Average Rating</th><!-- By default, all new users will start with a rating of 4 -->
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
              <tr>
                <td>1</td>
                <td>
                  <img class="tbl_img" src="/img/{{$user -> profilepic}}">
                </td>
                <td>{{$user -> role}}</td>
                <td>{{$user -> fname}} {{$user -> lname}}</td>
                <td>{{$user -> mobilenumber}}</td>
                <td>{{$user -> email}}</td>
                <td>{{$user -> averageRating}} / 10</td>
                <td>
                <a href="/Admin/users/{{$user -> id}}"><button class="btn btn-info">View Profile</button></a>
                  <form action="/Admin/users/{{$user -> id}}"" method="POST">
                    @csrf
                    <input id="isDeleted" type="number" name="isDeleted" value="1" hidden>
                    <input onclick="return confirm('This action will remove this User from the system. Proceed?')"
                    class="btn btn-danger" type="submit" name="submit" value="Remove User">
                  </form>
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