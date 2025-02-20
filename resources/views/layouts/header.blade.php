<header class="header">
            <div class="header-top">
                <div class="container">
                    

                    <div class="header-right">
                        <ul class="top-menu">
                            <li>
                                <a href="#">Links</a>
                                <ul>
                                    <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                                    @if(!empty(Auth::check()))
                                    <li><a href="{{url('admin/logout')}}"><i class="icon-user"></i>Log_out</a></li>

                                    @else
                                    <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>

                                    @endif
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="{{url('')}}" class="logo">
                            <img src="{{url('assets/images/logo.new.jpg')}}" alt="Molla Logo" width="120" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class=" active">
                                    <a href="{{url(' ')}}" >Home</a>

                                    
                                </li>
                                <li>
                                    <a href="{{url(' ')}}" class="sf-with-ul">Shop</a>

                                    <div class="megamenu megamenu-md">
                                        <div class="row no-gutters">
                                            <div class="col-md-12">
                                                <div class="menu-col">
                                                    <div class="row">
                                                        @php
                                                        $getCategoryHeader = App\Models\CategoryModel:: getRecordMenu()

                                                        @endphp
                                                        @foreach($getCategoryHeader as $value_category_header)
                                                       @if(!empty($value_category_header->getSubCategory->count()))
                                                        


                                                        <div class="col-md-4">
                                                            <a href="{{url( $value_category_header->slug)}}" class="menu-title">{{ $value_category_header->name}}</a><!-- End .menu-title -->
                                                            <ul>
                                                                @foreach($value_category_header->getSubCategory as $value_h_sub)
                                                                <li><a href="{{ url($value_category_header->slug . '/' . $value_h_sub->slug) }}">{{$value_h_sub->name}}</a></li>
                                                                       
                                                                @endforeach
                                                                
                                                            </ul>
                                                         </div>
                                                         @endif 
                                                         @endforeach


                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="banner banner-overlay">
                                                    <a href="category.html" class="banner banner-menu">
                                                       
                                                        <div class="banner-content banner-content-top">
                                                            <div class="banner-title text-white">Last <br>Chance<br><span><strong>Sale</strong></span></div><!-- End .banner-title -->
                                                        </div><!-- End .banner-content -->
                                                    </a>
                                                </div><!-- End .banner banner-overlay -->
                                            </div><!-- End .col-md-4 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu megamenu-md -->
                                </li>
                                
                                
                                
                               
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                            <form action="{{url('search')}} " method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count">{{Cart::getContent()->count() }}</span>
                            </a>
                     @if(!empty(Cart::getContent()->count()))
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-cart-products">

                                @foreach(Cart::getContent() as $header_cart )
                                @php
                                $getCartProduct = App\Models\ProductModel::getSingle($header_cart->id);
                               
                                   @endphp
                                   @if(!empty($getCartProduct))
                                   @php
                                   $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                                   @endphp
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="{{url('$getCartProduct->slug')}}">
                                                {{$getCartProduct->title}}    </a>
                                                
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">{{$header_cart->quantity}}</span>
                                               X ${{ number_format($header_cart->price,2)}}
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ $getProductImage->getLogo()}}" alt="product">
                                            </a>
                                        </figure>
                                        <a href="{{url('cart/delete/'.$header_cart->id)}}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                    </div><!-- End .product -->
                                    @endif
                                    @endforeach

                                    
                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>Total</span>

                                    <span class="cart-total-price">${{ number_format(Cart::GetSubTotal(),2)}}</span>
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <a href="{{url('cart')}}" class="btn btn-primary">View Cart</a>
                                    <a href="{{url('checkout')}}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdown-menu -->
                            @endif
                        </div><!-- End .cart-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->