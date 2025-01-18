@extends('front-end.components.master')

@section('contents')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Cart</h1>
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">cart</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">
       
        <div class="cart shopping">
            <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if (Session::has('success'))
                        <div class=" alert alert-success pb-0 text-center">
                           Congratulation❤️😘 <span>{{ Session::get('success') }}</span>
                        </div>
                    @endif
                    

                    <div class="block">
                        <div class="product-list">
                            <form method="post">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th class="">Item Name</th>
                                        <th class="">Item Quantity</th>
                                        <th class="">Item Price</th>
                                        <th class="">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item )
                                            @php
                                                $image = $item->attributes->image;
                                            @endphp
                                            <tr class="">
                                                <td class="">
                                                    <div class="product-info">
                                                    <img width="80" src="{{ asset('uploads/product/'.$image) }}" alt="" />
                                                    <a href="#!">{{ $item->name }}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="qty-control">
                                                        <button type="button" name="action" onclick="decrementQty()" class="btn btn-sm btn-danger">-</button>
                                                        <input id="product-qty" type="number" name="qty[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" style="width: 60px; text-align: center; padding: 3px; outline: none;"  readonly/>
                                                        <button type="button" name="action" onclick="incrementQty()" class="btn btn-sm btn-success">+</button>
                                                    </div>
                                                </td>
                                                <td class="">${{ $item->price }}</td>
                                                <td class="">
                                                    <a class="product-remove" href="{{ route('cart.remove',$item->id) }}">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                <a href="{{ route('checkout.index') }}" class="btn btn-main pull-right">Checkout</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
  <script>
    const incrementQty = () => {
        let qty = $('#product-qty').val();
        qty++;
        $('#product-qty').val(qty);
    }


    const decrementQty = () => {
        let qty = $('#product-qty').val();
        qty--;
        if(qty >= 1) {
            $('#product-qty').val(qty);
        }
    }


  </script>
@endsection