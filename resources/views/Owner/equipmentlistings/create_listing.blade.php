@extends('layouts.owner') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

<br><br><br>

<body>


<style type="text/css">
  .imgi {
    width: 200px;
    height: 200px;
    object-fit: cover;
    margin: 10px auto;
    border-radius: 20%;
  }
</style>

  <section class="form">
    <div class="container">
      <h1>Add New Equipment Listing</h1>
      <div class="content">
        <form action="/Owner/listing/create" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="details">
            <div class="input-box">
              <span class="details">Equipment name</span>
              <input type="text" name="name" placeholder="Sony A7S" required>
            </div>
            
            <div class="input-box">
              <span class="details">Equipment Description</span>
              <textarea name="description" rows="3" cols="30"></textarea>
            </div>

            <div class="input-box">
              <span class="details"> Rent rate / day</span>
              <input type="text" name="rate" placeholder="300" required>
            </div>  

            <div class="input-box">
              <span class="details">Address (County)</span>
              <input type="text" name="address" placeholder="Nairobi" required>
            </div>

            <div class="input-box">
              <span class="details">Equipment Image</span>
              <input type="file" accept="image/png, image/jpeg, image/jpg" name="equipmentimg" onchange="readURL(this);" required>
              
            </div>

            <div class="input-box">
              <img id="img" class="imgi" src="" alt="Equipment Image">
            </div>
          </div>

          <div class="button">
            <input style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" value="Send Listing Request">
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
