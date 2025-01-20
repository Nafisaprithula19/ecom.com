@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Order Detail</h1>
          </div>
          
      </div>
      <!-- /.container-fluid -->
    </section>
    <section>
    <div class="card card-primary">
            
              <!-- /.card-header -->
              <!-- form start -->
              
                 
              
                <div class="card-body">

                <div class="form-group">
                    <label >id : {{$getRecord->id}}</label>
                  </div>
                
                  <div class="form-group">
                    <label >transaction ID :{{$getRecord->	transaction_id}} </label>
                  </div>
                  <div class="form-group">
                    <label >Name : {{$getRecord->first_name}} {{$getRecord->last_name}} </label>
                  </div>
                  <div class="form-group">
                    <label >Company name :{{$getRecord->company_name}} </label>
                  </div>
                  <div class="form-group">
                    <label >Country name :{{$getRecord->country_name}} </label>
                  </div>
                  <div class="form-group">
                    <label >Address1 :{{$getRecord->address1}}</label>
                  </div>
                  <div class="form-group">
                    <label >Address2 :{{$getRecord->address2}}</label>
                  </div>
                  <div class="form-group">
                    <label >City :{{$getRecord->city}} </label>
                  </div>
                  <div class="form-group">
                    <label >State :{{$getRecord->state}}</label>
                  </div>
                  <div class="form-group">
                    <label >Post code : {{$getRecord->postcode}}</label>
                  </div>
                  <div class="form-group">
                    <label >Phone  :{{$getRecord->phone}} </label>
                  </div>
                  <div class="form-group">
                    <label >Email :{{$getRecord->email}} </label>
                  </div>
                  <div class="form-group">
                    <label >Notes :{{$getRecord->notes}} </label>
                  </div>
                  <div class="form-group">
                    <label >Discount Code :{{$getRecord->discount_Code	}}  </label>
                  </div>
                  <div class="form-group">
                    <label >Discount amount :{{ number_format($getRecord->discount_amount,2)}} </label>
                  </div>
                  <div class="form-group">
                    <label >Shipping name :{{$getRecord->getShipping->name}} </label>
                  </div>
                  <div class="form-group">
                    <label >Shipping amount :{{number_format($getRecord->shipping_amount,2)}} </label>
                  </div>
                  <div class="form-group">
                    <label >Total amount :{{number_format($getRecord->total_amount,2)}}</label>
                  </div>
                  <div class="form-group">
                    <label >Payment method :{{$getRecord->payment_method}} </label>
                  </div>
                  <div class="form-group">
                    <label >create date : {{date('d-m-y', strtotime($getRecord->created_at))}} </label>
                  </div>
                  <div class="form-group">
                    <label >Status : </label>
                  </div>
                 


                  

                 
                  
                </div>
                <!-- /.card-body -->

                
            </div>
            <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th >Image</th>
                    

                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Size </th>
                      <th>Color</th>
                      <th>Size amount ($) </th>
                      <th>Total amount($)</th>

                     





                    </tr>
                    <tbody>
                        @foreach($getRecord->getItem as $item)
                        @php
                                       $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id);
                                   @endphp
                        <tr>
                        <td>
                              <img style="width:100px; height:100px;" src="{{$getProductImage->getLogo()}}" alt=""> 
                            </td>
                            <td>
                                <a target="_blank" href="{{url($item->getProduct->slug)}}">

                                {{ $item->getProduct->title}}

                                </a>
                                           </td>
                            <td>
                                {{ $item->quantity}}
                            </td>
                            <td>
                                {{ $item->price}}
                            </td>
                            <td>
                                {{ $item->size_name}}
                            </td>
                            <td>
                                {{ $item->color_name}}
                            </td>
                            <td>
                                {{ number_format($item->size_amount,2)}}
                            </td>
                            <td>
                                {{ number_format( $item->total_price,2)}}
                            </td>
                        </tr>

                        @endforeach
                        
                    
                    </tbody>
                  </thead>
                  <tbody>
                   
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
</div>
    </section>

    <!-- Main content -->
    
</div>

  @endsection
  @section('script')
@endsection