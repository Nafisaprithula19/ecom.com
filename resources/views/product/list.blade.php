@extends('layouts.app')
@section('style')

    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css')}}">
   

@endsection
@section('content')

<main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
                    @if(!empty($getSubCategory))
                    <h1 class="page-title">{{$getSubCategory->name}}</h1>
                    @elseif(!empty($getCategory))
                    <h1 class="page-title">{{$getCategory->name}}</h1>
                    @endif
        			
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                        @if(!empty($getSubCategory))
                        <li class="breadcrumb-item " aria-current="page"><a href="{{ url($getCategory->slug) }}">{{$getCategory->name}}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$getSubCategory->name}}</li>
                        @elseif(!empty($getCategory))
                        <li class="breadcrumb-item active" aria-current="page">{{$getCategory->name}}</li>
                        @endif
                       
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox">
                				<div class="toolbox-left">
                					<!-- End .toolbox-info -->
                				</div><!-- End .toolbox-left -->

                				<div class="toolbox-right">
                					<div class="toolbox-sort">
                						<label for="sortby">Sort by:</label>
                						<div class="select-custom">
											<select name="sortby" id="sortby" class="form-control ChangeSortby">
											<option value="">select</option>
												<option value="popularity">Most Popular</option>
												<option value="rating">Most Rated</option>
												<option value="date">Date</option>
											</select>
										</div>
                					</div><!-- End .toolbox-sort -->
                					
                				</div><!-- End .toolbox-right -->
                			</div><!-- End .toolbox -->
							<div id ="getProductAjax">@include('product._list');</div>

                     
                		</div><!-- End .col-lg-9 -->
                		<aside class="col-lg-3 order-lg-first">
						<form id="FilterForm" method="post" action="javascript:void(0);">
    {{ csrf_field() }}
    <input type="hidden" name="sub_category_id" id="get_sub_category_id">
    <input type="hidden" name="brand_id" id="get_brand_id">
    <input type="hidden" name="sort_by_id" id="get_sort_by_id">
</form>
                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-clean">
                					<label>Filters:</label>
                					<a href="#" class="sidebar-filter-clear">Clean All</a>
                				</div><!-- End .widget widget-clean -->
                                 @if(!empty( $getSubCategoryFilter))
                				<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Category
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-1">
										<div class="widget-body">
										@foreach($getSubCategoryFilter as $f_category)
    <div class="filter-items filter-items-count">
        <div class="filter-item">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input changeCategory" value="{{$f_category->id}}" id="cat-{{ $f_category->id }}">
                <label class="custom-control-label" for="cat-{{ $f_category->id }}">{{ $f_category->name }}</label>
            </div>
            <span class="item-count">{{$f_category->TotalProduct()}}</span>
        </div>
    </div>
@endforeach



												

												
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
                                @endif


		

        						

        					

									

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
									        Brand
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-4">
										<div class="widget-body">
											<div class="filter-items">
											@foreach($getBrand as $f_brand)
    <div class="filter-item">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input changeBrand" value="{{$f_brand->id}}" id="brand-{{$f_brand->id}}">
            <label class="custom-control-label" for="brand-{{$f_brand->id}}">{{$f_brand->name}}</label> <!-- Updated `for` attribute -->
        </div><!-- End .custom-checkbox -->
    </div><!-- End .filter-item -->
@endforeach

												

											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        					
								<!-- End .widget -->
                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
@endsection

@section('script')
<script src="{{url('assets/js/wNumb.js')}}"></script>
<script src="{{url('assets/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{url('assets/js/nouislider.min.js')}}"></script>

	<script type="text/javascript">
    $(document).ready(function() {
        // Sort By Filter
        $('.ChangeSortby').change(function() {
            var id = $(this).val();  // `id` should be singular as it's a single value
            $('#get_sort_by_id').val(id); // Corrected selector by adding '#'
            console.log("Sort By ID:", $('#get_sort_by_id').val()); // Log to check updated value
			FilterForm();
        });

        // Category Filter
        $('.changeCategory').change(function() {
            var ids = ''; // Initialize `ids` to accumulate checked values
            $('.changeCategory:checked').each(function() {
                ids += $(this).val() + ','; // Add each checked value with a comma
            });
            $('#get_sub_category_id').val(ids.replace(/,$/, '')); // Remove trailing comma and set value
            console.log("Sub-category IDs:", $('#get_sub_category_id').val()); // Log to check updated value
			FilterForm();
        });

        // Brand Filter
        $('.changeBrand').change(function() {
            var ids = ''; // Initialize `ids` to accumulate checked values
            $('.changeBrand:checked').each(function() {
                ids += $(this).val() + ','; // Add each checked value with a comma
            });
            $('#get_brand_id').val(ids.replace(/,$/, '')); // Remove trailing comma and set value
            console.log("Brand IDs:", $('#get_brand_id').val()); // Log to check updated value
			FilterForm();
        });

      
       
    });



	function FilterForm(){
    $.ajax({
        type: "POST",
        url: "{{ url('get_filter_product_ajax') }}",
        data: $('#FilterForm').serialize(),
        dataType: "json",
        success: function(data) {
			$('#getProductAjax').html(data.success)
             // Use this to verify if data is returned
            // Add any additional actions here for displaying filtered products
        },
        error: function(error) {
             // Log the error for troubleshooting
        }
    });
}
</script>





@endsection

