@extends('layouts.customer') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
<style type="text/css">
       	/* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Header */
    .modal-header {
      font-family: bebas neue;
      text-align: center;
      padding: 2px 16px;
      background-color: #E30613;
      color: white;
    }

    /* Modal Body */
    .modal-body {
      font-family: raleway;
      background: linear-gradient(#393939, #010101);
    }

    /* Modal Content */
    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      border: 1px solid #888;
      width: 40%;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
      animation-name: animatetop;
      animation-duration: 0.4s
    }

    .user-details .input-box input{ /*For other boxes*/
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
  }
</style>

<section class="form">
  <div class="container">
<p style="color:lightgreen; font-style: italic; font-weight: bold;">{{session('msg')}}</p>

    <h1>Online Wallet</h1>
    <div class="content">
        <div class="user-details">

<p>Your wallet balance is <span style=' font-size: 55pt; color:#F15025;'> ${{$wallet->amountAvailable}}</span></p>
<input class="btn btn-warning" style="font-family:bebas neue; font-size: 20pt; letter-spacing: 0.2em;" type="submit" name="submit" id='walletBtn' value="Update Wallet">

        <!-- The Modal -->
    <div id="walletModal" class="modal walletModal">
        <!-- Modal content -->
        <br><br><br><br><br>
          <div class="modal-content">
            <div class="modal-header">
              <span class="close walletClose">&times;</span>
              <h2>Add amount</h2>
            </div>
            <div class="modal-body">
              <form action="/Customer/wallet/update" method="POST">
                @csrf
                  <center>
                  <input type="number" name="walletID" value = "{{$wallet->walletID}}" hidden> 
                    <span class="details">Amount to add in Wallet ($):</span>
                    <input type="number" name="amount" placeholder="500" required> 
                      <br>
                      <br>
                    <input class="btn btn-success" style="width: 70%; font-family:bebas neue; font-size: 15pt;" type="submit" value="Add amount to wallet">
                  </center>
              </form>
            </div>
          </div>
    </div>
    </div>
  </div>
</section>

<script type="text/javascript">
	var modal = document.getElementById("walletModal");
	var btn = document.getElementById("walletBtn");
	var span = document.getElementsByClassName("walletClose")[0];
			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			  walletModal.style.display = "none";
			}
	walletBtn.onclick = function() {
			  walletModal.style.display = "block";
			}
</script>

@endsection


