@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

    @php
    use Carbon\Carbon;
      $dt = Carbon::now()->setTimezone('Africa/Nairobi')->addDays(14);
      $datetime = $dt->toDateTimeString();
      $dt1 = Carbon::now()->setTimezone('Africa/Nairobi')->addDays(15);
      $datetime1 = $dt1->toDateTimeString();
    @endphp
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
           <h1>Create Rental request for {{$equipment -> equipmentName}}</h1>
          <div class="content">

            <form action="/Customer/rental/createrequest" method="POST">
              @csrf
              <div class="details">
              <input type="text" name="equipmentID" value="{{$equipment -> equipmentID}}" hidden>

                  <!-- <span class="details">Equipment ID</span> -->
                  <input type="text" name="rate" value="{{$rate}}" hidden>
                

                <div class="input-box">
                  <span class="details">Start Date & Time</span>
                  <input type="datetime-local" name="startDateTime" min="" required> <br/><br/>
                  <!-- <input type="date" name="inspectionDateTime" min="2021-06-25" max="2021-06-30" required> <br/><br/> -->
                  <!-- Min and max will be edited based on current date and a week(7 days) before rental was planned to begin. Maybe.  -->
                </div>

                <div class="input-box">
                  <span class="details">End Date & Time</span>
                  <input type="datetime-local" name="endDateTime" min="" required> <br/><br/>
                  <!-- <input type="date" name="inspectionDateTime" min="2021-06-25" max="2021-06-30" required> <br/><br/> -->
                  <!-- Min and max will be edited based on current date and a week(7 days) before rental was planned to begin. Maybe.  -->
                </div>

                <div class="input-box">
                  <span class="details">Quantity</span>
                  <input type="number" name="quantity" min="1" max="5" required> <br/><br/>
                  <!-- <input type="date" name="inspectionDateTime" min="2021-06-25" max="2021-06-30" required> <br/><br/> -->
                  <!-- Min and max will be edited based on current date and a week(7 days) before rental was planned to begin. Maybe.  -->
                </div>

                

                
              </div>
              <div class="button">
                <input style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" name="submit" value="Create Rental Request">
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  
  @endsection

