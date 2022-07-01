@extends('layouts.layout') 
<!-- Blade directive used to call a specific template/layout file -->

@section('content') 
<!-- Blade directive used to call name the body as a section that can be 
    referred to when determining which content to place where -->
    <link rel="stylesheet" type="text/css" href="/css/equipment.css">

    <!-- Equipment section -->
    <section class="equipment" id="equipment">
      <div class="container">
        <div class="row min-vh-40 align-items-center">
          <div class="col-md-6">
            <div class="content">
              <h3>Equipment</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Equipment Listings</strong></h2>
            <p class="mb-5">Explore all the equipment listing verified, checked and offered on our platform. Ensure you have an account before you can rent.</p>    
          </div>
        </div>
        
        <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
              <div class="listing-img h-100 mr-4">
                <img src="https://images.unsplash.com/photo-1554446422-d05db23719d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1774&q=80" alt="Image" class="img-fluid">
              </div>
              <div class="listing-contents h-100">
                <h3>Large Microphone</h3>
                <div class="rent-price">
                  <strong>$389.00</strong><span class="mx-1">/</span>day
                </div>
                <div class="owner">
                  <div class="reviews">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> 
                  </div>  
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Availability:</span><br>
                    <span class="number">Yes</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Condition:</span><br>
                    <span class="number">Fair</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Value:</span><br>
                    <span class="number">$40</span>
                  </div>&nbsp;
                </div>
                <div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                  <p><a href="#" class="btn btn-success btn-sm">Rent Now</a></p>
                  <p><a href="#" class="btn btn-primary btn-sm">View listing</a></p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
              <div class="listing-img h-100 mr-4">
                <img src="https://images.unsplash.com/photo-1554446422-d05db23719d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1774&q=80" alt="Image" class="img-fluid">
              </div>
              <div class="listing-contents h-100">
                <h3>Large Microphone</h3>
                <div class="rent-price">
                  <strong>$389.00</strong><span class="mx-1">/</span>day
                </div>
                <div class="owner">
                  <div class="reviews">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> 
                  </div>  
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Availability:</span><br>
                    <span class="number">Yes</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Condition:</span><br>
                    <span class="number">Fair</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Value:</span><br>
                    <span class="number">$40</span>
                  </div>&nbsp;
                </div>
                <div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                  <p><a href="#" class="btn btn-success btn-sm">Rent Now</a></p>
                  <p><a href="#" class="btn btn-primary btn-sm">View listing</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
              <div class="listing-img h-100 mr-4">
                <img src="https://images.unsplash.com/photo-1554446422-d05db23719d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1774&q=80" alt="Image" class="img-fluid">
              </div>
              <div class="listing-contents h-100">
                <h3>Large Microphone</h3>
                <div class="rent-price">
                  <strong>$389.00</strong><span class="mx-1">/</span>day
                </div>
                <div class="owner">
                  <div class="reviews">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> 
                  </div>  
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Availability:</span><br>
                    <span class="number">Yes</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Condition:</span><br>
                    <span class="number">Fair</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Value:</span><br>
                    <span class="number">$40</span>
                  </div>&nbsp;
                </div>
                <div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                  <p><a href="#" class="btn btn-success btn-sm">Rent Now</a></p>
                  <p><a href="#" class="btn btn-primary btn-sm">View listing</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
              <div class="listing-img h-100 mr-4">
                <img src="https://images.unsplash.com/photo-1554446422-d05db23719d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1774&q=80" alt="Image" class="img-fluid">
              </div>
              <div class="listing-contents h-100">
                <h3>Large Microphone</h3>
                <div class="rent-price">
                  <strong>$389.00</strong><span class="mx-1">/</span>day
                </div>
                <div class="owner">
                  <div class="reviews">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> 
                  </div>  
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Availability:</span><br>
                    <span class="number">Yes</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Condition:</span><br>
                    <span class="number">Fair</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Value:</span><br>
                    <span class="number">$40</span>
                  </div>&nbsp;
                </div>
                <div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                  <p><a href="#" class="btn btn-success btn-sm">Rent Now</a></p>
                  <p><a href="#" class="btn btn-primary btn-sm">View listing</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
              <div class="listing-img h-100 mr-4">
                <img src="https://images.unsplash.com/photo-1554446422-d05db23719d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1774&q=80" alt="Image" class="img-fluid">
              </div>
              <div class="listing-contents h-100">
                <h3>Large Microphone</h3>
                <div class="rent-price">
                  <strong>$389.00</strong><span class="mx-1">/</span>day
                </div>
                <div class="owner">
                  <div class="reviews">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> 
                  </div>  
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Availability:</span><br>
                    <span class="number">Yes</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Condition:</span><br>
                    <span class="number">Fair</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Value:</span><br>
                    <span class="number">$40</span>
                  </div>&nbsp;
                </div>
                <div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                  <p><a href="#" class="btn btn-success btn-sm">Rent Now</a></p>
                  <p><a href="#" class="btn btn-primary btn-sm">View listing</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
              <div class="listing-img h-100 mr-4">
                <img src="https://images.unsplash.com/photo-1554446422-d05db23719d2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1774&q=80" alt="Image" class="img-fluid">
              </div>
              <div class="listing-contents h-100">
                <h3>Large Microphone</h3>
                <div class="rent-price">
                  <strong>$389.00</strong><span class="mx-1">/</span>day
                </div>
                <div class="owner">
                  <div class="reviews">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> 
                  </div>  
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Availability:</span><br>
                    <span class="number">Yes</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Condition:</span><br>
                    <span class="number">Fair</span>
                  </div>&nbsp;
                  <div class="listing-feature pr-4">
                    <span class="caption">Value:</span><br>
                    <span class="number">$40</span>
                  </div>&nbsp;
                </div>
                <div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                  <p><a href="#" class="btn btn-success btn-sm">Rent Now</a></p>
                  <p><a href="#" class="btn btn-primary btn-sm">View listing</a></p>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-5">
            <div class="custom-pagination">
              <a href="#">1</a>
              <span>2</span>
              <a href="#">3</a>
              <a href="#">4</a>
              <a href="#">5</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection