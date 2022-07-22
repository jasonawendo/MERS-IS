@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

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

            <form action="/Inspector/profile/edit" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="details">
                <input type="text" name="id" value="{{$user -> id}}" hidden>
                <input type="text" name="fname" value="{{$user -> fname}}" hidden>
                <input type="text" name="lname" value="{{$user -> lname}}" hidden>

                <div class="input-box">
                  <span class="details">Mobile Number</span>
                  <input type="text" name="mobilenumber" placeholder="+2540000000000" value="{{$user -> mobilenumber}}">
                </div>

                <div class="input-box">
                  <span class="details">Address (County)</span>
                  <input type="text" name="address" placeholder="Nairobi" value="{{$user -> address}}">
                </div>

                <div class="input-box">
                  <span class="details">Profile Image</span>
                  <input type="file" accept="image/png, image/jpeg, image/jpg" name="profile" onchange="readURL(this);">
                </div>

                <div class="input-box">
                  <img id="img" class="profile_imgi" src="/img/{{$user -> profilepic}}" alt="profile">
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