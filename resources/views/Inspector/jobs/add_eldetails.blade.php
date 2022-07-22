@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
    @php 
    $equipmentID = $equipment->equipmentID
    @endphp
<style>
  .details .input-box select{ /*For selection*/
  width: 100%;
}
</style>

  <section class="form">
    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <h1>Add details & Accept/Reject listing #{{$equipmentID}}</h1>
          <div class="content">

            <form action="/Inspectors/equipment/{{$equipmentID}}" method="POST">
              @csrf
              <div class="details">
              <input type="text" name="job" value="{{$job}}" hidden>
              <input type="text" name="task" value="{{$task}}" hidden>

                <div class="input-box"> 
                   <span class="details">Equipment Condition</span>
                   <select id="Condition" name="condition" style=" margin-top: 5px;">
                    <optgroup label="Condition" style="font-family:Montserrat;">
                        <option value="Bad" style="color: black;">Bad</option>
                        <option value="Moderate" style="color: black;">Moderate</option>
                        <option value="Good" style="color: black;">Good</option>
                    </optgroup>
                  </select>
                </div>

                <div class="input-box">
                  <span class="details">Equipment Value ($)</span>
                  <input type="text" name="value" placeholder="100" required>
                </div>

              </div>
              <input onclick="return confirm('This action will complete and approve this Inspection task and accept the correlating equipment listing request. Proceed?')"
              class="btn btn-success" style="width:49.5%; font-family:bebas neue; font-size: 20pt;" type="submit" name="submit" value="accept">
              <input onclick="return confirm('This action will complete this Inspection task and reject the correlating equipment listing request. Proceed?')"
              class="btn btn-danger" style="width:49.5%; font-family:bebas neue; font-size: 20pt;" type="submit" name="submit" value="reject">
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
  
  @endsection

