@extends('layouts.inspector') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

<style type="text/css">
	  .icons
  {
  	color: #E30613;
    font-size: 22pt;
    padding: 20px;
  }

  .card
  {
  	background: #010101;
	color:white;
  }
  h6
  {
  	font-size: 30pt;
	color:white;
  }

</style>
  
<section>
	<div class="row">
		<center><h2 class="page-title">Dashboard</h2></center>

		<div class="col-sm-6 col-xl-4 mb-4">
			<div class="card">
				<div class="rounded d-flex align-items-center justify-content-between p-4">
                    <div class="icons">
                        <i  class="fa fa-backward fa-3x"></i>
                    </div>
                    <div class="ms-3">
                    <p style="font-size:15pt; font-family:bebas neue;" >Past Inspection jobs</p>
                    <h6>1</h6> <br>
                    <a href="/Admin/users/requests" class="btn btn-light">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
			</div> 
        </div>

        <div class="col-sm-6 col-xl-4 mb-4">
			<div class="card">
				<div class="rounded d-flex align-items-center justify-content-between p-4">
                        <div class="icons">
                            <i  class="fa fa-clock fa-3x"></i>
                        </div>
                    <div class="ms-3">
                        <p style="font-size:15pt; font-family:bebas neue;" >Pending Inspection jobs</p>
                        <h6>3</h6> <br>
                        <a href="/Admin/equipmentlistings" class="btn btn-light">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
			</div> 
        </div>

        <div class="col-sm-6 col-xl-4 mb-4">
			<div class="card">
				<div class="rounded d-flex align-items-center justify-content-between p-4">
                    <div class="icons">
                        <i  class="fa fa-check fa-3x"></i>
                    </div>
                    <div class="ms-3">
                        <p style="font-size:15pt; font-family:bebas neue;" >Assigned Inspection jobs</p>
                        <h6>2</h6> <br>
                        <a href="/Admin/users/requests" class="btn btn-light">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
			</div> 
        </div>
    
        

        <!-- <div class="col-sm-6 col-xl-3 mb-4">
                <div class="card">
                    <div class="rounded d-flex align-items-center justify-content-between p-4">
                <div class="icons">
                    <i  class="fa fa-mobile fa-3x"></i>
                </div>
            <div class="ms-3">
                <p style="font-size:15pt; font-family:bebas neue;" >Orders</p>
                <h6>4</h6> <br>
            </div>
            </div>
                </div> 
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
                <div class="card">
                    <div class="rounded d-flex align-items-center justify-content-between p-4">
                <div class="icons">
                    <i  class="fa fa-briefcase fa-3x"></i>
                </div>
            <div class="ms-3">
                <p style="font-size:15pt; font-family:bebas neue;" >Inspection Jobs</p>
                <h6>5</h6> <br>
                <a href="/Admin/inspectors/jobs" class="btn btn-light">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
            </div>
            </div>
                </div> 
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
                <div class="card">
                    <div class="rounded d-flex align-items-center justify-content-between p-4">
                <div class="icons">
                    <i  class="fa fa-tty fa-3x"></i>
                </div>
            <div class="ms-3">
                <p style="font-size:15pt; font-family:bebas neue;" >Equipment listing requests</p>
                <h6>6</h6> <br>
                <a href="/Admin/equipmentlistings/pending" class="btn btn-light">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
            </div>
            </div>
                </div> 
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
                <div class="card">
                    <div class="rounded d-flex align-items-center justify-content-between p-4">
                <div class="icons">
                    <i  class="fa fa-coins fa-3x"></i>
                </div>
            <div class="ms-3">
                <p style="font-size:15pt; font-family:bebas neue;" >Total Revenue</p>
                <h6>7</h6> <br>
                <a href="/Admin/orders/paid" class="btn btn-light">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
            </div>
            </div>
                </div> 
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
                <div class="card">
                    <div class="rounded d-flex align-items-center justify-content-between p-4">
                <div class="icons">
                    <i  class="fa fa-tty fa-3x"></i>
                </div>
            <div class="ms-3">
                <p style="font-size:15pt; font-family:bebas neue;" >Rental requests</p>
                <h6>8</h6> <br>
                <a href="/Admin/rentals/requests" class="btn btn-light">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
            </div>
            </div>
                </div> 
        </div> -->
	</div>

	<center><h2 style="color:#fff; font-size:25pt;" class="page-title">Report</h2></center>
	<div class="row">
		

		<div class="col-sm-12 col-xl-6 mb-4 mx-auto">
        <div class="bg-dark rounded h-100 p-4">
            <h6 class="mb-4">Complete : Incomplete jobs ratio</h6>
            <canvas id="el-request"></canvas>
        </div>
    </div>  
	</div>
</section>




<!-- DATATABLES -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/b-2.2.3/cr-1.5.6/date-1.1.2/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/datatables.min.js"></script>
<!-- FONT AWESOME ICONS -->
<script src="https://kit.fontawesome.com/4a33c5baa2.js" crossorigin="anonymous"></script> 
<!-- CHART JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">

	// Salse & Revenue Chart
	

	// Equipment Listing Request Pie chart
	var complete = 33;
	var incomplete = 33;
	var ctx2 = $("#el-request").get(0).getContext("2d");
	    var myChart5 = new Chart(ctx2, {
	        type: "pie",
	        data: {
	            labels: ["Complete", "Incomplete"],
	            datasets: [{
	                backgroundColor: [
	                	"#15E506",
	                	"#0615E5"
	                ],
	                data: [complete, incomplete]
	            }]
	        },
	        options: {
	            responsive: true
	        }
	    });
</script>

@endsection
