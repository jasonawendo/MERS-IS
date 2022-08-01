@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
@php
$profile = $user -> profilepic
@endphp

<style type="text/css">
  .profile_imgi 
  {
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin: 10px auto;
    border-radius: 50%;
  }
</style>

  <section class="form">
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <h1>Edit your Profile details</h1>
          <div class="content">

            <form action="/Customer/profile/edit" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="details">
                <input type="text" name="id" value="{{$user -> id}}" hidden>
                <input type="text" name="fname" value="{{$user -> fname}}" hidden>
                <input type="text" name="lname" value="{{$user -> lname}}" hidden>

                <div class="input-box">
                  <span class="details">Mobile Number</span>
                  <input type="text" name="mobilenumber"  value="{{$user -> mobilenumber}}">
                </div>

                <div class="input-box">
                  <span class="details">LinkedIn link</span>
                  <input type="text" name="linkedin"  value="{{$user -> linkedin}}">
                </div>

                <div class="input-box">
                  <span class="details">Website link</span>
                  <input type="text" name="website"  value="{{$user -> websitelink}}">
                </div>

                <div class="input-box">
                  <span class="details">Company Name</span>
                  <input type="text" name="company"  value="{{$user -> companyname}}">
                </div>

                <div class="input-box">
                  <span class="details">Address (County)</span>
                  <input type="text" name="address" value="{{$user -> address}}">
                </div>

                <div class="input-box">
                  <span class="details">Bio Description</span>
                  <textarea name="bio" rows="3" cols="30">{{$user -> bio}}</textarea>
                </div>

                <div class="input-box">
                  <span class="details">Profile Image</span>
                  <input type="file" accept="image/png, image/jpeg, image/jpg" name="profile" onchange="readURL(this);">
                </div>

                <div class="input-box">
                  @if(!isset($profile))
                    <img id="img" class="profile_imgi" src="/img/admin.jpg" alt="profile">
                  @else
                    <img id="img" class="profile_imgi" src="/img/{{$user -> profilepic}}" alt="profile">
                  @endif
                </div>
                
              </div>
              <div class="button">
                <input style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" name="userupdate" value="Update Information">
              </div>            
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
  
  @endsection
<!-- Script for displaying image once selected in the form -->
<script type="text/javascript">
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>