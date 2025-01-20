@extends('layouts.app')
@section('style')

    <link rel="stylesheet" href="{{ url('assets/css/plugins/nouislider/nouislider.css')}}">
   

@endsection
@section('content')


<main class="main">
           

            <div class="login-page" style="background-image: ">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							    <li class="nav-item">
							        <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Forgot Password</a>
							    </li>
							    
							</ul>
							<div class="tab-content">
							    <div class=" " style="display:block;">
                                @if(session()->has('error'))
        <div class="alert alert-dark" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>       
            {{ session()->get('error') }}
        </div>
    @endif

                                <form action=""  method="post"style="margin-top:40px;">

                                {{ csrf_field() }}
							    		<div class="form-group">
							    			<label for="singin-email-2"> Email address *</label>
							    			<input type="text" class="form-control" id="singin-email-2" name="email" required>
							    		</div><!-- End .form-group -->

							    		

							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>Forgot Password</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>


							    		</div><!-- End .form-footer -->
							    	</form>
							    
							    </div><!-- .End .tab-pane -->
							   
							</div><!-- End .tab-content -->
						</div><!-- End .form-tab -->
            		</div><!-- End .form-box -->
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->
@endsection

@section('script')


@endsection

