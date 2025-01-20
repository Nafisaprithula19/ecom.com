<div class="products mb-3">
                                <div class="row justify-content-center">
                                   @foreach($getProduct as $value) 
                                   @php
                                       $getProductImage = $value->getImageSingle($value->id);
                                   @endphp
                                   
                                    <div class="col-6 col-md-3 col-lg-3">
                                        <div class="product product-7 text-center">
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
                                                

                   <!-- End .product-nav -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 -->
                                    @endforeach

                                    <!-- End .col-sm-6 col-lg-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .products -->

                			<nav aria-label="Page navigation">
								<div class="justify-content-center">
								{!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links()!!}
								</div>

							
							    
							</nav>