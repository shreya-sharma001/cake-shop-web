@extends('layout/masterLayout')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Product detail</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="/">Home</a>
                        <a href="/shop">Shop</a>
                        {{-- <span>Sweet autumn leaves</span> --}}
                        <span>{{$product->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__img">
                        <div class="product__details__big__img">
                            <img class="big_img" src="{{asset ('storage/'.$product->image)}}" alt="">
                        </div>
                        <div class="product__details__thumb">
                            {{-- {{dd($product)}} --}}
                            @foreach ($product->images as $thumbnail)
                            {{-- {{dd($thumbnail)}} --}}
                                <div class="pt__item active">
                                <img data-imgbigurl="{{ asset('storage/'.$thumbnail)}}"
                                    src="{{ asset('storage/'.$thumbnail)}}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        {{-- <div class="product__label">Cupcake</div> --}}
                        <div class="product__label">{{$product->CategoryName}}</div>
                        {{-- <h4>SWEET AUTUMN LEAVES</h4> --}}
                        <h4>{{$product->name}}</h4>
                        {{-- <h5>$26.41</h5> --}}
                        <h5>Price: {{$product->price}}</h5>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore
                            et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida</p> --}}
                        <p>{{$product->small_description}}</p>
                        <ul>
                            {{-- <li>SKU: <span>17</span></li> --}}
                            <li>SKU: <span>{{$product->SKU}}</span></li>
                            {{-- <li>Category: <span>Biscuit cake</span></li> --}}
                            <li>Category: <span>{{$product->CategoryName}}</span></li>
                            {{-- <li>Tags: <span>Gadgets, minimalisstic</span></li> --}}
                            <li>Tags: <span>{{$product->tagName}}</span></li>
                        </ul>
                        <div class="product__details__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="2">
                                </div>
                            </div>
                            <a href="{{route('addToCart',['id' => $product->id])}}" class="primary-btn">Add to cart</a>
                            <a href="#" class="heart__btn"><span class="icon_heart_alt"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__details__tab">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Additional information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Previews(1)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <p>{{$product->small_description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <p>{{$product->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <p>This delectable Strawberry Pie is an extraordinary treat filled with sweet and
                                        tasty chunks of delicious strawberries. Made with the freshest ingredients, one
                                        bite will send you to summertime. Each gift arrives in an elegant gift box and
                                        arrives with a greeting card of your choice that you can personalize online!3
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Products Section Begin -->
    <section class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relProducts as $relp)
                    <div class="col-lg-4 col-md-4">
                        {{-- {{dd($relp)}} --}}
                        <div class="product__item ">
                            <div class="product__item__pic set-bg" data-setbg="{{asset ('storage/'.$relp->image)}}">
                                <div class="product__label">
                                    <span>Cupcake</span>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{$relp->name}}</a></h6>
                                <div class="product__item__price">{{$relp->price}}</div>
                                <div class="cart_add">
                                    <a href="{{route('addToCart',['id' => $relp->id])}}">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Related Products Section End -->

@endsection

@section('title')
    Shop-Details
@endsection
