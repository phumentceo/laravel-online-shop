@extends('front-end.components.master')

@section('slider')
<div class="hero-slider">
  <div class="slider-item th-fullpage hero-area" style="background-image: url({{ asset('front-end/assets/images/slider/slider-1.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-center">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-item th-fullpage hero-area" style="background-image: url({{ asset('front-end/assets/images/slider/slider-3.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-left">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-item th-fullpage hero-area" style="background-image: url({{ asset('front-end/assets/images/slider/slider-2.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-right">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('contents')
  <section class="product-category section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title text-center">
            <h2>Product Category</h2>
          </div>
        </div>
        <div class="col-md-6">

          <div class="category-box">
            <a href="#!">
              <img src="{{ asset('uploads/category/' . $categories[0]->image) }}" alt="" />
              <div class="content">
                <h3>{{ $categories[0]->name }}</h3>
              </div>
            </a>	
          </div>
          <div class="category-box">
            <a href="#!">
              <img src="{{ asset('uploads/category/' .$categories[1]->image) }}" alt="" />
              <div class="content">
                <h3>{{ $categories[1]->name }}</h3>
              </div>
            </a>	
          </div>
        </div>

        <div class="col-md-6">
          <div class="category-box category-box-2">
            <a href="#!">
              <img src="{{ asset('uploads/category/' .$categories[2]->image) }}" alt="" />
              <div class="content">
                <h3>{{ $categories[2]->name }}</h3>
              </div>
            </a>	
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection