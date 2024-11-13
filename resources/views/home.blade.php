@extends('layouts.dashboard')

@section('content')
 <!-- Home Tab -->
 <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <!-- Header Section -->
    <div class="text-center py-5" style="
        background-color: rgba(0, 0, 0, 0.6); 
        color: white; 
        width: 100%; 
        height: 680px; 
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;">
        <h1>#Sip&SavorForU</h1>
    </div>

    <!-- Welcome Section -->
    <div class="text-center py-5" style= "background-color: #DCDCDC; width: 900">
        <h2 class="text-success text-center">Welcome to Sip and Savor</h2>
        <p class="container my-5">This is our final project for the Advanced Web Programming course, bringing you a unique cafe experience right at your fingertips. Enjoy browsing through our menu, crafted with care and love for coffee enthusiasts.</p>
    </div>

    <!-- Our Menu Section -->
    <div class="text-center py-5" style= "background-color: #f9f9f9">
        <div class="container my-5">
        <h3 class="text-success">Our Menu</h3><br>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/menu-sample.png') }}" alt="Our Menu Image" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
            </div>
            <div class="col-md-6">
                <p>Explore our delicious menu options, ranging from freshly brewed coffee to delightful pastries. Each item is carefully selected to bring you the best flavors for an unforgettable experience.</p>
                <a href="{{ route('order') }}" class="btn btn-success">Order</a>
            </div>
        </div>
        </div>
    </div>

    <!-- Our Cafe Section -->
    <div class="text-center py-5" style="background-color: #DCDCDC;">
        <div class="container my-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h4 class="text-success font-weight-bold">Our Cafe</h4>
                    <p>Welcome to our cozy cafe, where every corner is designed for comfort and relaxation. Enjoy your favorite coffee while soaking in the warm ambiance and friendly atmosphere.</p>
                    <!-- <a href="#order" class="btn btn-success">Visit Us</a> -->
                </div>
                <div class="col-md-6">
                    <div id="cafeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/cafe-pict1.png') }}" alt="Our Cafe Image 1" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/cafe-pict2.png') }}" alt="Our Cafe Image 2" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/cafe-pict3.png') }}" alt="Our Cafe Image 3" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#cafeCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#cafeCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection