@extends('layouts.admin') 
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
<br>
	<section>
		<div class="row">
			<center><h2 class="page-title">Other Reports</h2></center>
			<div class="col-sm-12 col-xl-6 mb-4">
		        <div class="bg-dark rounded h-100 p-4">
					<h6 class="mb-4">Revenue per Month</h6>
					<canvas id="revenue" ></canvas>
				</div>
			</div> 

		    <div class="col-sm-12 col-xl-3 mb-4">
		        <div class="bg-dark rounded h-100 p-4">
		            <h6 class="mb-4">Rental Requests</h6>
		            <canvas id="r-request"></canvas>
		        </div>
		    </div>

		    <div class="col-sm-12 col-xl-3 mb-4">
		        <div class="bg-dark rounded h-100 p-4">
		            <h6 class="mb-4">Customer-Equipment Owner Ratio</h6>
		            <canvas id="ce-ratio"></canvas>
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
  
  // Worldwide Sales Chart
  var ctx1 = $("#revenue").get(0).getContext("2d");
  var myChart1 = new Chart(ctx1, {
      type: "bar",
      data: {
          labels: ["July", "August", "September", "October", "November", "December"],
          datasets: [{
                  label: "Revenue ($)",
                  data: [15, 30, 55, 65, 60, 80],
                  backgroundColor: "rgba(235, 22, 22, .7)"
              },
          ]
          },
      options: {
          responsive: true
      }
      });

  // Rental Request Pie chart
  var accepted = {{$accepted}};
  var pending = {{$pending}};
  var rejected = {{$rejected}};
  var ctx3 = $("#r-request").get(0).getContext("2d");
      var myChart5 = new Chart(ctx3, {
          type: "pie",
          data: {
              labels: ["Accepted", "Pending", "Rejected"],
              datasets: [{
                  backgroundColor: [
                    "#15E506",
                    "#0615E5",
                      "#E30613"
                  ],
                  data: [accepted, pending, rejected]
              }]
          },
          options: {
              responsive: true
          }
      });

  // Customer Equipment Owner ratio- Pie chart
  var customers = {{$customers}};
  var eowners = {{$owners}};
  var ctx4 = $("#ce-ratio").get(0).getContext("2d");
      var myChart5 = new Chart(ctx4, {
          type: "pie",
          data: {
              labels: ["Customers", "Equipment Owners"],
              datasets: [{
                  backgroundColor: [
                    "#009fe3",
                    "#fab600"
                  ],
                  data: [customers, eowners]
              }]
          },
          options: {
              responsive: true
          }
      });







</script>

@endsection

</html>
