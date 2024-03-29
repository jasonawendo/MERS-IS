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
          @if($title == "View Admin")
          <a style="color:blue;" href="/Admin/create"><button class="btn btn-warning"><i class="fas fa-plus"></i>     Create Admin Account</button></a>
          @else
          @endif
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
                <th>Average Rating</th><!-- By default, all new users will start with a rating of 4 -->
                <th>Created at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              @php
                $role = $user -> role;
                $isDeleted = $user -> isDeleted;
              @endphp
              <tr>
                <td>{{$user -> id}}</td>
                
                  
                    @if($role == "Admin")
                    <td>
                      <img class="tbl_img" src="/img/admin.jpg">
                    </td>
                    @else
                    <td>
                      <img class="tbl_img" src="/img/{{$user -> profilepic}}">
                    </td>
                    @endif

                <td style="text-transform:capitalize;">{{$user -> role}}</td>
                <td>{{$user -> fname}} {{$user -> lname}}</td>
                <td>{{$user -> mobilenumber}}</td>
                <td>{{$user -> email}}</td>
                <td>{{$user -> address}}</td>
                <td style="text-transform:capitalize;">{{$user -> usertype}}</td>
                <td>{{$user -> companyname}}</td>


                @if($role == "Admin")
                <td></td>
                @else
                <td>{{$user -> averageRating}} / 10</td>
                @endif
                <td>{{$user -> created_at}}</td>
 
                  @if($role == "Admin")
                    @if($isDeleted == 0)
                      <td>
                        <form action="/Admin/users/{{$user -> id}}" method="POST">
                            @csrf
                            <input id="isDeleted" type="number" name="isDeleted" value="1" hidden>
                            <input onclick="return confirm('This action will remove this Admin from the system. Proceed?')"
                            class="btn btn-danger" type="submit" name="submit" value="Remove Admin">
                        </form>
                      </td>
                    @else
                      <td></td>
                    @endif
                  @else
                      <td class="icons">
                        <a class="btn btn-info" style="color:white;" href="/Admin/users/{{$user -> id}}"><i class="fas fa-eye"></i></a>
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
      <center>
            <button class="btn btn-primary" onclick='window.print()'>Print</button>
          </center>
          <br><br>
  </div>
</div>
  
  @endsection