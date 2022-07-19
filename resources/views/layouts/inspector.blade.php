
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inspector Module</title>

  <link rel="stylesheet" type="text/css" href="/css/admin/style.css">
  <link rel="stylesheet" type="text/css" href="/css/admin/table.css">
  <link rel="stylesheet" type="text/css" href="/css/admin/createview.css">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- DATATABLES -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/b-2.2.3/cr-1.5.6/date-1.1.2/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/datatables.min.css"/>
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
            <li><a href="/Admin/dashboard">Dashboard</a></li>
            
            <li>
                <input type="checkbox" id="show-inspector">
                <label for="show-inspector">Quality Inspectors</label>
                <ul>
                        <li><a href="/Admin/inspectors/create">Add New Inspector</a></li>
                        <li><a href="/Admin/inspectors/inspectors">View Quality Inspectors</a></li>
                <li><a href="/Admin/inspectors/jobs">Inspection Jobs & Tasks</a></li><!-- View Inspection tasks table will be found in each job --> 
                <!-- Once an inspection task is complete, Inspector will accept or reject Inspection task(needs a new field) and in the backend the rental request inspection status will be accepted or rejected at the same time -->
                <li><a href="/Admin/inspectors/untasks">View Unassigned Tasks</a></li>
                </ul>
            </li>

            <li><a href="/Admin/reports">Profile</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
      </div>
	<!--       <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
      <form action="#" class="search-box">
        <input type="text" placeholder="Type Something to Search..." required>
        <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
      </form> -->
      <label class="search-icon"><a style="color: #E30613;" href="#"><i class="fas fa-comment"></i></a></label>
    </nav>
  </div>
</header>
  
<body class="antialiased">
            @yield('content')
            <!-- Blade directive allowing us to yield a specific section -->
</body>

<footer>
      <div class="bottom">
        <center>
          <span class="credit">Created By <a href="#">Y&J</a> | </span>
          <span class="far fa-copyright"></span><span> 2022 All rights reserved.</span>
        </center>
      </div>
</footer>

<!-- DATATABLES -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/b-2.2.3/cr-1.5.6/date-1.1.2/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/datatables.min.js"></script>
<!-- FONT AWESOME ICONS -->
<script src="https://kit.fontawesome.com/4a33c5baa2.js" crossorigin="anonymous"></script> 
<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- CHART JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




<script type="text/javascript">

     $('#table').DataTable({
      responsive: true
     });
</script>

</html>