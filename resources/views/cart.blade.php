@extends('layouts.layout') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->

	<link rel="stylesheet" type="text/css" href="/css/cart.css">
    <section class="cart" id="cart">
    <div class="container">
        <div class="row min-vh-40 align-items-center">
          <div class="col-md-12">
            <div class="content">
              <h3>Cart</h3>
            </div>
          </div>
        </div>
  	</div>
</section>

<!-- Cart item details -->
<!-- CREATE A SHOPPING CART TABLE -->
<div class="table-responsive">
    <table class="table table-bordered table-dark">
        <tr style="background: #E30613;">
            <th></th>
            <th>Product</th>
            <th>Rate per day</th> 
            <th>Start Date/Time</th>
            <th>End Date/Time</th>
            <th>Quantity</th>
            <th>Inspection Status</th>
            <th>Owner Status</th>
            <th>Total price</th> <!-- Calculated based on start and end dates and quantity, thus must be calculated in backend -->
        </tr>
        <tbody>
            <tr>
                <!-- Place delted icon here and put functionality to make it is-delted to a different value -->
                <td></td> 
                <td><img style="border-radius: 24px" width="50" src="https://images.unsplash.com/photo-1656643950245-ea965f500549?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80">  Camera</td>
                <td>$40</td>
                <td>lorem</td>
                <td>lorem</td>
                <td>2</td>
                <td style="color:green;">Accepted</td>
                <td style="color:red;">Rejected</td>
                <td>$80</td>
            </tr>
                        <tr>
                <!-- Place delted icon here and put functionality to make it is-delted to a different value -->
                <td></td> 
                <td><img style="border-radius: 24px" width="50" src="https://images.unsplash.com/photo-1656643950245-ea965f500549?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80">Camera</td>
                <td>$40</td>
                <td>lorem</td>
                <td>lorem</td>
                <td>2</td>
                <td>Accepted</td>
                <td>Accepted</td>
                <td>$80</td>
            </tr>
                        <tr>
                <!-- Place delted icon here and put functionality to make it is-delted to a different value -->
                <td></td> 
                <td><img style="border-radius: 24px" width="50" src="https://images.unsplash.com/photo-1656643950245-ea965f500549?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80">Camera</td>
                <td>$40</td>
                <td>lorem</td>
                <td>lorem</td>
                <td>2</td>
                <td>Accepted</td>
                <td>Accepted</td>
                <td>$80</td>
            </tr>

        </tbody>
    </table>
</div>

<div class="total-price">
	<table class="table">
		<tr>
			<td style="font-weight: bold;">Total</td> 
					<!-- If 1 or more of the rentals are rejected, then they will not be involved in computation and won't
					be found in the order -->
			<td>$80</td>
		</tr>
	</table>
</div>

<div class="formsubmit">
	<div class="text-center">
		<form action="#" method="POST">
			<input class='btn mx-15' style='background: #FF523B;color: #fff;padding: 8px 30px;margin: 30px 0;border-radius: 100px;transition: 0.7s;transform: translateY(20px);font-family: bebas neue; font-size: 26pt;' 
					type='submit' name='order' value='Checkout'> 
					<!-- If rentals are yet to be accepted, button is inactive -->
					<!-- If all rentals are rejected, button wont be active -->
			<input class='btn mx-15' style='background: grey;color: #fff;padding: 8px 30px;margin: 30px 0;border-radius: 100px;transition: 0.7s;transform: translateY(20px);font-family: bebas neue; font-size: 26pt;' 
					type='submit' disabled name='noorder' value='Checkout'> 
		</form>
	</div>
</div>

    
@endsection