@extends('layouts.app')
@section('style')

    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css')}}">
   

@endsection
@section('content')

<main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a></li>

                        <li class="breadcrumb-item" aria-current="page">{{ $getProduct->getSubCategory->name }}</li>
                    </ol>

                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav><!-- End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery">
                                    <figure class="product-main-image">

                                    @php
                                       $getProductImage = $getProduct->getImageSingle($getProduct->id);
                                   @endphp
                                   @if(!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                        <img id="product-zoom" src="{{ $getProductImage->getLogo()}}" data-zoom-image="{{ $getProductImage->getLogo()}}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                        @endif
                                    </figure><!-- End .product-main-image -->

                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        @foreach($getProduct->getImage as $image)
                                        <a class="product-gallery-item" href="#" data-image="{{ $image->getLogo()}}" data-zoom-image="{{ $image->getLogo()}}">
                                            <img src="{{ $image->getLogo()}}" alt="product side">
                                        </a>
                                        @endforeach

                                       

                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details">
                                    <h1 class="product-title">{{$getProduct->title}}</h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                    <span id="getTotalPrice">${{number_format($getProduct->price,2)}}</span>
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                    {!! $getProduct->description !!}
                                    </div><!-- End .product-content -->

                                    <form action="{{url('product/add-to-cart')}}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{ $getProduct->id}}">
                                    @if(!empty($getProduct->getcolor->count()))
                                    <div class="details-filter-row details-row-size">
                                        <label for="size">Color:</label>
                                        <div class="select-custom">
                                            <select name="color_id" id="color_id" required class="form-control">
                                                <option value="" >Select a color</option>
                                                @foreach($getProduct->getColor as $color)
                                                <option value="{{$color->getcolor->id}}">{{$color->getcolor->name}}</option>
                                               @endforeach
                                            </select>
                                        </div><!-- End .select-custom -->
                                        @endif
                                    
                                        @if(!empty($getProduct->getSize->count()))
    <div class="details-filter-row details-row-size">
        <label for="size">Size:</label>
        <div class="select-custom">
            <select name="size_id" id="size_id" required class="form-control getSizePrice">
                <option data-price="0" value="">Select a size</option>
                @foreach($getProduct->getSize as $size)
                    <option data-price="{{ !empty($size->price) ? $size->price : 0 }}" value="{{ $size->id }}">
                        {{ $size->name }} @if(!empty($size->price))(${{ number_format($size->price, 2) }})@endif
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif


                                        
                                    </div><!-- End .details-filter-row -->

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" id="qty" class="form-control" value="1" min="1" max="100" name="qty" required step="1" data-decimals="0" required>
                                        </div><!-- End .product-details-quantity -->
                                    </div><!-- End .details-filter-row -->

                                    <div class="product-details-action">
                                        <button type="submit" class="btn-product btn-cart"><span>add to cart</span></button>

                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a> 
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->
                                    </form>

                                    <div class="product-details-footer">
                                        <!-- End .product-cat -->
                                       <!-- 
                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div> 
                                 -->
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->
                </div><!-- End .container -->

                <div class="product-details-tab product-details-extended">
                    <div class="container">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                            </li>
                            
                        </ul>
                    </div><!-- End .container -->

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="container">
                        {!! $getProduct->description !!}
                                </div> <!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                            {!! $getProduct->additional_information !!}
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                            <div class="product-desc-content">
                                <div class="container">
                                {!! $getProduct->shipping_returns !!}
                                </div><!-- End .container -->
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        >
                    </div><!-- End .tab-content -->
                </div><!-- End .product-details-tab -->

                <div class="container">
                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                        @foreach($getRelatedProduct as $value)
                        @php
                                       $getProductImage = $value->getImageSingle($value->id);
                                   @endphp
                        <div class="product product-7">
                            <figure class="product-media">
                                
                                <a href="{{url($value->slug)}}">
                                @if(!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                                    <img style ="height:360px; width:100%; object_fit: cover;" src="{{ $getProductImage->getLogo()}} " alt="{{$value->title}}" class="product-image">
                                                    @endif
                                  
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                    
                                </div><!-- End .product-action-vertical -->

                                <!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                <a href="{{url($value->category_slug.'/'.$value->sub_category_slug)}}">{{$value->sub_category_name}}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="{{url($value->slug)}}">{{$value->title}}</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                ${{number_format($value->price,2)}}
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div><!-- End .rating-container -->

                               <!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        @endforeach

                       <!-- End .product -->
                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
@endsection

@section('script')


    <script src="{{ url('assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{ url('assets/js/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{ url('assets/js/bootstrap-input-spinner.js')}}"></script>

    <script type="text/javascript"> 
    $(document).ready(function() {
        // Fix selector and console log
        $('.getSizePrice').change(function() {
            var product_price = '{{$getProduct->price}}';
            var price =$('option:selected', this).attr('data-price');
            var total = parseFloat(product_price) + parseFloat(price);
            $('#getTotalPrice').html('$' + total.toFixed(2));


        });
    });
</script>

    

@endsection

