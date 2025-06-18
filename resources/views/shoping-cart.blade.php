@extends('layout/masterLayout')
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Shopping cart</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="/">Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                <?php
                                 $total_price=0;
                                ?>
                            </thead>
                            <tbody>
                                @foreach($product as $products)
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="storage/{{$products->image}}" width="100" alt="">
                                        </div>

                                        <div class="product__cart__item__text">
                                            <h6>{{$products->name}}</h6>
                                            {{-- <h5 id="price">{{$products->price}}</h5> --}}
                                            <h5 class="price">{{$products->price}}</h5>
                                        </div>

                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty" data-id="{{$products->id}}">
                                                <input type="text" value="{{$products->quantity}}">
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td class="cart__price" id="totalPrice">{{$products->total}}</td> --}}
                                    <td class="cart__price totalPrice">{{$products->total}}</td>
                                    <td class="cart__close"><span class="icon_close remove_from_cart" data-id="{{ $products->id }}"></span></td>
                                </tr>
                                <?php
                                  $total_price=$total_price+$products->total;
                                ?>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="/shop">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="/shoping-cart"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul class="grand-total-content">
                            <li>Subtotal <span>{{$total_price}}</span></li>
                            <li>Total <span>{{$total_price}}</span></li>
                        </ul>
                        <a href="/checkout" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection

@section('title')
    Shoping-Cart
@endsection
