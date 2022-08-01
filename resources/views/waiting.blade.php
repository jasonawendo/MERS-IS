@extends('layouts.waiting') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

    <!-- Home section -->
    <section class="home" id="home">
      <div class="container">
        <div class="row min-vh-40 align-items-center">
          <div class="col-md-6">
          <div class="content">
            <h3>Hello User</h3>
            <p>Your account was either deleted or removed from the platform. You cannot access the system.</p>
            <a href="/equipmentlistings"><button class="btn" style="background-color:#E30613; color:white;">Explore equipment offered</button></a>
          </div>
          </div>
        </div>
      </div>
    </section>
  
  <!-- </body> -->

@endsection




