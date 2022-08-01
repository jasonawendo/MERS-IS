@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->


<style>
  .details .input-box select{ /*For selection*/
  width: 100%;
}
</style>
    <br><br>

  <section class="form">
    <div class="row">
      <div class="col-md-12">
        <div class="container">
           <h1>Give rating and review for {{$user -> fname}}</h1>
          <div class="content">

            <form action="/Customer/owners/ratingsreviews/create" method="POST">
              @csrf
              <div class="details">
                <input type="text" name="rentalID" value="{{$rentalID}}" hidden>
                <input type="text" name="ownerID" value="{{$user -> id}}" hidden>
                
                <div class="input-box">
                  <span class="details">Rate (Scale of 1-10)</span>
                  <input type="number" name="rating" min="1" max="10" required> <br/><br/>
                  <!-- <input type="date" name="inspectionDateTime" min="2021-06-25" max="2021-06-30" required> <br/><br/> -->
                  <!-- Min and max will be edited based on current date and a week(7 days) before rental was planned to begin. Maybe.  -->
                </div>

                <div class="input-box">
                  <span class="details">Review</span>
                  <textarea name="review" rows="6" cols="25"></textarea>
                </div>

              </div>
              <div class="button">
                <input style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" name="submit" value="Submit">
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  
  @endsection

