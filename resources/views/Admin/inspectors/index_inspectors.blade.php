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
          <h2 class="page-title">View Quality Inspectors</h2>
          <h5  style="color:lightgreen;"> {{ session('msg') }} </h5>
        </center>
        <table id="table" class="display table table-dark table-bordered table-hover table-responsive" cellspacing="0" width="100%">
          <thead class="table-head">
            <tr>
	          <th>Inspector ID</th>
	          <td>Profile Image</td>
	          <th>Full Name</th>
	          <th>Email Address</th>
	          <th>Mobile No.</th>
	          <th>KRA Pin</th>
	          <th>Address (County)</th>
	          <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach($inspectors as $inspector)
            <tr>
              <td>{{$inspector -> id}}</td>
              <td>
                <img class="tbl_img" src="/img/{{$inspector -> profilepic}}">
              </td>
              <td>{{$inspector -> fname}} {{$inspector -> lname}}</td>
              <td>{{$inspector -> email}}</td>
              <td>{{$inspector -> mobilenumber}}</td>
              <td>{{$inspector -> krapin}}</td>
              <td>{{$inspector -> address}}</td>
              <td class="icons">
                <form action="/Admin/inspectors/remove/{{$inspector -> id}}"" method="POST">
                        @csrf
                        <input id="isDeleted" type="number" name="isDeleted" value="1" hidden>
                        <input onclick="return confirm('This action will remove this Quality Inspector from the system. Proceed?')"
                        class="btn btn-danger" type="submit" name="submit" value="Remove Quality Inspector">
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>
  @endsection