@extends('layouts.layout') 
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
            <h3>Join our creative community</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="#"><button class="btn" style="background-color:#E30613; color:white;">Explore equipment offered</button></a>
          </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About section -->
    <section class="about" id="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 image">
            <img src="https://images.unsplash.com/photo-1497015289639-54688650d173?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80" class="w-100 mb-5 mb-md-0" alt="">
          </div>

          <div class="col-md-6 content">
            <span>About Us</span>
            <h3>Rent, Rent out Equipment, Make passive income, Rate eachother</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="#"><button class="btn" style="background-color:#E30613; color:white;">Register With Us</button></a>
          </div>
          
        </div>
      </div>
    </section>

    <!-- Services section -->
    <section class="services" id="services">
      <h1 class="heading">Our Services</h1>
      <div class="box-container container">

        <div class="box">
          <span class="fas fa-camera"></span>
          <h3>Rent Equipment</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="box">
          <span class="fas fa-money-bill"></span>
          <h3>Rent out Equipment</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="box">
          <span class="fas fa-check-double"></span>
          <h3>Quality Inspections</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="box">
          <span class="fas fa-user-check"></span>
          <h3>Users Authentication</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="box">
          <span class="fas fa-star"></span>
          <h3>Rate and Review peers</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="box">
          <span class="fas fa-comment-dots"></span>
          <h3>In-app communication</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

      </div>
    </section>
    <!-- How process works section-->
    <section class="process" id="process">
      <h1 class="heading">How the Process Works</h1>
      <div class="box-container container">

        <div class="box">
          <img class="processimg1" src="img/p1.png" alt="Register">
          <h3>Register as Customer or Equipment Owner</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="box">
          <img class="processimg2" src="img/p2.png" alt="Authentication">
          <h3>Wait for authentication</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

        <div class="box">
          <img class="processimg3" src="img/p3.png" alt="Access account">
          <h3>Access account and reap benefits</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </section>

    <!-- Testimonials section -->
  <section class="testimonials" id="testimonials">
    <div class="testheading">
      <h2>Testimonials</h2>
    </div>
    <!-- Testimonial-Box-containers -->
    <div class="testimonial-box-container">
      <!-- Testimonial 1 -->
      <div class="testimonial-box">
        <!-- Top -->
        <div class="box-top">
          <!-- Profile -->
          <div class="profile">
            <div class="profile-img">
              <img src="https://images.unsplash.com/photo-1621169806978-d997e4a587fb?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="Tracy">
            </div>
            <div class="name-user">
              <strong>Tracy Muhune</strong>
              <span>Founder of Zara</span>
            </div>
          </div>
            <!-- Reviews -->
            <div class="reviews">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i> 
            </div>  
        </div>
        <!-- Actual comments -->
        <div class="client-comment">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. </p>
          </div>
      </div>
      <!-- Testimonial 2 -->
      <div class="testimonial-box">
        <!-- Top -->
        <div class="box-top">
          <!-- Profile -->
          <div class="profile">
            <div class="profile-img">
              <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="Peter">
            </div>
            <div class="name-user">
              <strong>Peter Ochieng</strong>
              <span>Director at FTP</span>
            </div>
          </div>
            <!-- Reviews -->
          <div class="reviews">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i> 
          </div>  
        </div>
        <!-- Actual comments -->
        <div class="client-comment">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. </p>
          </div>
      </div>
      <!-- Testimonial 3 -->
      <div class="testimonial-box">
        <!-- Top -->
        <div class="box-top">
          <!-- Profile -->
          <div class="profile">
            <div class="profile-img">
              <img src="https://images.unsplash.com/photo-1561515075-cab76d2aefa9?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80" alt="Jaramogi">
            </div>
            <div class="name-user">
              <strong>Clent Jaramogi</strong>
              <span>Loyal Customer</span>
            </div>
          </div>
            <!-- Reviews -->
          <div class="reviews">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i> 
          </div>  
        </div>
        <!-- Actual comments -->
        <div class="client-comment">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. </p>
          </div>
      </div>
      <!-- Testimonial 4 -->
      <div class="testimonial-box">
        <!-- Top -->
        <div class="box-top">
          <!-- Profile -->
          <div class="profile">
            <div class="profile-img">
              <img src="https://images.unsplash.com/photo-1584048243280-9731afb8b3f7?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Vincent">
            </div>
            <div class="name-user">
              <strong>Vincent McHenry</strong>
              <span>H&M Director</span>
            </div>
          </div>
            <!-- Reviews -->
          <div class="reviews">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i> 
          </div>  
        </div>
        <!-- Actual comments -->
        <div class="client-comment">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. </p>
          </div>
      </div>
    </div>   
  </section>
  
  <!-- </body> -->

  @endsection




