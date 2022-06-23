<!-- This file will has the header and footer so that we dont have to copy paste the heads continuously in all html
    files especially when they are the same. It is a generic file whereby all views will have these tags. -->
    <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Official Homepage</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">

    </style>
</head>
<header>
  <div class="wrapper">
    <nav class="fixed-top">
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="#">ME<span style="color: #E30613;">RS</span></a></div>
        <ul class="links">
          <li><a href="home">Home</a></li>
          <li><a href="#">About</a></li>
          <li>
            <a href="#" class="desktop-link">Equipment</a>
  <!--             <input type="checkbox" id="show-features">
            <label for="show-features">Features</label>
            <ul>
              <li><a href="#">Drop Menu 1</a></li>
              <li><a href="#">Drop Menu 2</a></li>
              <li><a href="#">Drop Menu 3</a></li>
              <li><a href="#">Drop Menu 4</a></li>
            </ul> -->
          </li>
          <li>
            <a href="registration" class="desktop-link">Register</a>
  <!--             <input type="checkbox" id="show-services">
            <label for="show-services">Services</label>
            <ul>
              <li><a href="#">Drop Menu 1</a></li>
              <li><a href="#">Drop Menu 2</a></li>
              <li><a href="#">Drop Menu 3</a></li>
              <li>
                <a href="#" class="desktop-link">More Items</a>
                <input type="checkbox" id="show-items">
                <label for="show-items">More Items</label>
                <ul>
                  <li><a href="#">Sub Menu 1</a></li>
                  <li><a href="#">Sub Menu 2</a></li>
                  <li><a href="#">Sub Menu 3</a></li>
                </ul>
              </li>
            </ul> -->
          </li>
          <li><a href="login">Login</a></li>
        </ul>
      </div>
      <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
      <form action="#" class="search-box">
        <input type="text" placeholder="Type Something to Search..." required>
        <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
      </form>
    </nav>
  </div>
</header>

  <body>
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
        <div class="right box">
          <h2>Contact us</h2> <!-- Just incase we have time to add this functionality -->
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
        </div>
      </div>
      <div class="bottom">
        <center>
          <span class="credit">Created By <a href="#">Y&J</a> | </span>
          <span class="far fa-copyright"></span><span> 2022 All rights reserved.</span>
        </center>
      </div>
</footer>
</html>