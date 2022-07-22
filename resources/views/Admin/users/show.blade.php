@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
    @php
      $status = $user -> status;
      $isDeleted = $user -> isDeleted;
      $rating = $user -> averageRating;
      $stars = 0;
      if ($rating == 1 || $rating == 2)
      {
        $stars = 1;
      }
      else if ($rating == 3 || $rating == 4)
      {
        $stars = 2;
      }
      else if ($rating == 5 || $rating == 6)
      {
        $stars = 3;
      }
      else if ($rating == 7 || $rating == 8)
      {
        $stars = 4;
      }
      else if ($rating == 9 || $rating == 10)
      {
        $stars = 5;
      }
    @endphp
  <section>       
    <div class="profile py-4">
      <div class="container">
        <div class="row">
          <center><h2 class="page-title">View User Profile</h2></center>
          <div class="col-lg-4">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent text-center">
                @if($status == "accepted")
                <img class="profile_img" src="/img/{{$user -> profilepic}}" alt="dp">
                <div class="reviews">
                  @for ($i=0; $i < $stars; $i++) 
                    <i class="fas fa-star"></i> 
                  @endfor
                  @for ($j=5; $j > $stars; $j--)
                    <i class="far fa-star"></i> 
                  @endfor
                </div> 
                @else
                @endif
                <h3>{{$user -> fname}} {{$user -> lname}}</h3>
              </div>
              
              <div class="card-body">
                <p class="mb-0"><strong class="pr-1">User ID:</strong> {{$user -> id}}</p>
                <p class="mb-0"><strong class="pr-1">Mobile Number:</strong> {{$user -> mobilenumber}}</p>
                <p class="mb-0"><strong class="pr-1">Email Address:</strong> {{$user -> email}}</p>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card shadow-sm">
              <div class="card-header bg-transparent border-0">
                <h3 class="mb-0"></i>General Information</h3>
              </div>
              <div class="card-body pt-0">
                <table class="table table-bordered">
                  <tr>
                    <th width="30%">National ID</th>
                    <td width="2%">:</td>
                    <td>{{$user -> nationalID}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Role</th>
                    <td width="2%">:</td>
                    <td>{{$user -> role}}</td>
                  </tr>
                  <tr>
                    <th width="30%">KRA Pin</th>
                    <td width="2%">:</td>
                    <td>{{$user -> krapin}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Address (County)	</th>
                    <td width="2%">:</td>
                    <td>{{$user -> address}}</td>
                  </tr>
                  <tr>
                    <th width="30%">User Type</th>
                    <td width="2%">:</td>
                    <td style="text-transform:capitalize;">{{$user -> usertype}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Linked In profile (URL)</th>
                    <td width="2%">:</td>
                    <td>{{$user -> linkedin}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Company Name</th>
                    <td width="2%">:</td>
                    <td>{{$user -> companyname}}</td>
                  </tr>
                  <tr>
                    <th width="30%">Website Link</th>
                    <td width="2%">:</td>
                    <td>{{$user -> websitelink}}</td>
                  </tr>
                  <tr>
                      <th width="30%">Created At</th>
                      <td width="2%">:</td>
                      <td>{{$user -> created_at}}</td>
                    </tr>

                  @if($status == "accepted")
                    <tr>
                      <th width="30%">Average Rating</th>
                      <td width="2%">:</td>
                      <td>{{$user -> averageRating}} / 10</td>
                    </tr>
                  @else
                    <tr></tr>
                  @endif
                  
                  

                    @if($status == "accepted")
                      @if($isDeleted == 0)
                        <tr>
                          <th width="30%">Action</th>
                          <td width="2%">:</td>
                          <td>
                            <a href="#"><button class="btn btn-info">Contact User</button></a>
                            <a href="/Admin/users/{{$user -> role}}/{{$user -> id}}"><button class="btn btn-warning">View User ratings</button></a>
                            <br>
                            <form action="/Admin/users/{{$user -> id}}" method="POST">
                                    @csrf
                                    <input id="isDeleted" type="number" name="isDeleted" value="1" hidden>
                                    <input onclick="return confirm('This action will remove this User from the system. Proceed?')"
                                    class="btn btn-danger" type="submit" name="submit" value="Remove User">
                            </form>
                          </td>
                        </tr>
                      @else
                      @endif
                      
                    @elseif($status == "pending")
                      <tr>
                        <th width="30%">Action</th>
                        <td width="2%">:</td>
                        <td>
                          <form action="/Admin/users/accepted/{{$user -> id}}" method="POST">
                                  @csrf
                                  <input id="accepted" type="text" name="status" value="accepted" hidden>
                                  <input onclick="return confirm('This action will accept this user registration request and add them to the system. Proceed?')"
                                  class="btn btn-success" type="submit" name="submit" value="Accept Registration Request">
                          </form>
                          <br>
                          <form action="/Admin/users/rejected/{{$user -> id}}" method="POST">
                                  @csrf
                                  <input id="rejected" type="text" name="status" value="rejected" hidden>
                                  <input onclick="return confirm('This action will reject this user registration request and disallow them from accessing the system. Proceed?')"
                                  class="btn btn-danger" type="submit" name="submit" value="Reject Registration Request">
                          </form>
                        </td>
                      </tr>
                    @else
                      <td></td>
                    @endif
                </table>
              </div>
            </div>
              <div style="height: 26px"></div>
            @if($status == "accepted")
            <div class="card shadow-sm">
              <div class="card-header bg-transparent border-0">
                <h3 class="mb-0"></i>Bio Description</h3>
              </div>
              <div class="card-body pt-0">
                  <p>{{$user -> bio}}</p>
              </div>
            </div>
            @else
            <div></div>
            @endif
          </div>

        </div>
      </div>
    </div>
  </section>
  
  @endsection