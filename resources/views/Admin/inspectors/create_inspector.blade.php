@extends('layouts.admin') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

<br><br><br>

<body>


<style type="text/css">
  .profile_imgi {
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin: 10px auto;
    border-radius: 50%;
  }
</style>

  <section class="form">
    <div class="container">
      <h1>Add New Quality Inspector</h1>
      <div class="content">
        <form action="/Admin/inspectors/create" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="details">
            <div class="input-box">
              <span class="details">First name</span>
              <input type="text" name="fname" placeholder="John" required>
            </div>
            
            <div class="input-box">
              <span class="details">Last Name</span>
              <input type="text" name="lname" placeholder="Doe" required>
            </div>

            <div class="input-box">
              <span class="details">Email</span>
              <input type="email" name="email" placeholder="jondoe@gmail.com" required>
            </div>

            <div class="input-box">
              <span class="details">Password</span>
              <input type="password" name="password" required> 
              <!-- You may need to check this again -->
            </div>

            <div class="input-box">
              <span class="details">Mobile Number</span>
              <input type="text" name="mobilenumber" placeholder="+2540000000000" required>
            </div>

            <div class="input-box">
              <span class="details">KRA PIN</span>
              <input type="text" name="krapin" placeholder="000000000" required>
            </div>

            <div class="input-box">
              <span class="details">Address (County)</span>
              <input type="text" name="address" placeholder="Nairobi" required>
            </div>

            <div class="input-box">
              <span class="details">National ID Number</span>
              <input type="text" name="nationalid" placeholder="12345678" required>
            </div>

            <div class="input-box">
              <span class="details">Profile Image</span>
              <input type="file" accept="image/png, image/jpeg, image/jpg" name="profile" onchange="readURL(this);" required>
              
            </div>

            <div class="input-box">
              <img id="img" class="profile_imgi" src="" alt="profile">
            </div>
          </div>

          <div class="button">
            <input style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" name="userupdate" value="Update">
          </div>
        </form>

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
