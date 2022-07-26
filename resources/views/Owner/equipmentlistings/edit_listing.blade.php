@extends('layouts.owner') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
@php
  $equipmentID = $equipment -> equipmentID;
@endphp
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
      <h1>Edit Equipment Listing for Equipment #{{$equipmentID}}</h1>
      <div class="content">
        <form action="/Owner/equipmentlistings/edit/{{$equipmentID}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="text" name="ownerID" value="{{$equipment -> ownerID}}" hidden>
          <div class="details">
            <div class="input-box">
              <span class="details">Equipment name</span>
              <input type="text" name="name" value="{{$equipment -> equipmentName}}" required>
            </div>
            
            <div class="input-box">
              <span class="details">Equipment Description</span>
              <textarea name="description" rows="3" cols="30">{{$equipment -> equipmentDescription}}</textarea>
            </div>

            <div class="input-box">
              <span class="details"> Rent rate ($)/ day</span>
              <input type="text" name="rate" value="{{$equipment -> rentRate}}" required>
            </div>  

            <div class="input-box">
              <span class="details">Address (County)</span>
              <input type="text" name="address" value="{{$equipment -> address}}" required>
            </div>

            <div class="input-box">
              <span class="details">Equipment Image</span>
              <input type="file" accept="image/png, image/jpeg, image/jpg" name="equipmentimg" onchange="readURL(this);">
              
            </div>

            <div class="input-box">
              <img id="img" class="imgi" src="/img/{{$equipment -> equipmentImage}}" alt="Equipment Image">
            </div>
          </div>

          <div class="button">
            <input style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" value="Update listing">
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
