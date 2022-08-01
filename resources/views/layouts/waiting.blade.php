<!-- This file will has the header and footer so that we dont have to copy paste the heads continuously in all html
    files especially when they are the same. It is a generic file whereby all views will have these tags. -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Official Homepage</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<header>
  <div class="wrapper">
    <nav class="fixed-top">
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="/">ME<span style="color: #E30613;">RS</span></a></div>
        <ul class="links">
          <li><a href="/">Home</a></li>
          <!-- <li><a href="#">About</a></li> -->
          <li>
            <a href="/equipmentlistings" class="desktop-link">Equipment</a>
  
          </li>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <li style="font-family:bebas neue"><input type="submit" class="btn btn-light" value="Logout"></li>
          </form>
          
        </ul>
      </div>
      
      <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
      <form action="/search" class="search-box">
        @csrf
        <input type="text" name="search" placeholder="Search for Equipment..." required>
        <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
      </form>
    </nav>
  </div>
</header>

    <body class="antialiased">
            @yield('content')
            <!-- Blade directive allowing us to yield a specific section -->
    </body>
    
<footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.</p>
            <div class="social">
              <a href="#"><span class="fab fa-facebook-f"></span></a>
              <a href="#"><span class="fab fa-twitter"></span></a>
              <a href="#"><span class="fab fa-instagram"></span></a>
              <a href="#"><span class="fab fa-youtube"></span></a>
            </div>
          </div>
        </div>
        <div class="center box">
          <h2>Address</h2>
          <div class="content">
            <div class="place">
              <span class="fas fa-map-marker-alt"></span>
              <span class="text">Strathmore University</span>
            </div>
            <div class="phone">
              <span class="fas fa-phone-alt"></span>
              <span class="text">+254700000000</span>
            </div>
            <div class="email">
              <span class="fas fa-envelope"></span>
              <span class="text">mers@info.ac.ke</span>
            </div>
          </div>
        </div>
        <!-- <div class="right box">
          <h2>Contact us</h2> Just incase we have time to add this functionality
          <div class="content">
            <form action="#">
              <div class="email">
                <div class="text">Email *</div>
                <input type="email" required>
              </div>
              <div class="msg">
                <div class="text">Message *</div>
                <textarea rows="2" cols="25" required></textarea>
              </div>
              <div class="button">
                <button class="btn btn-light" style="width: 100%;font-size: 1.0625rem;font-weight: 500;" type="submit">Send</button>
              </div>
            </form>
          </div>
        </div> -->
      </div>
      <div class="bottom">
        <center>
          <span class="credit">Created By <a href="#">Y&J</a> | </span>
          <span class="far fa-copyright"></span><span> 2022 All rights reserved.</span>
        </center>
      </div>
</footer>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>