@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          @if(session()->has('error'))
        <div class="alert alert-dark" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>       
            {{ session()->get('error') }}
        </div>
    @endif
            <h1>Order List</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
     
              <!-- /.card-body -->
              
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th >#</th>
                    

                      <th>Name</th>
                      <th>Company name</th>
                      <th>Country</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>

                      <th>Post code</th>
                      <th >Phone</th>
                      <th >Email</th>

                      <th >Discount Code</th>

                      <th >Discount amount</th>
                      <th >Shipping amount</th>
                      <th >Total amount</th>
                      <th >Payment method</th>

                      <th >create date</th>
                      <th >status</th>

                    

                      <th >Action</th>





                    </tr>
                    <tbody>
                        
                    @foreach($getRecord as $value )
                    <tr>
                      
                      <td>{{$value->id}}</td>
                      

                      <td>{{$value->first_name}}  {{$value->last_name}}</td>
                      <td>{{$value->company_name}}</td>
                      <td>{{$value->country_name}}</td>
                      <td>{{$value->address1}}<br> {{$value->address2}}</td>
                      <td>{{$value->city}}</td>
                      <td>{{$value->state}}</td>

                      <td>{{$value->postcode}}</td>

                      <td>{{$value->phone}}</td>

                      <td>{{$value->email}}</td>
                      <td>{{$value->discount_Code}}</td>
                      <td>{{number_format($value->discount_amount,2)}}</td>

                      

                      <td>{{number_format($value->shipping_amount,2)}}</td>

                      <td>{{number_format($value->total_amount,2)}}</td>
                      <td>{{$value->payment_method}}</td>

                      






                      <td>{{date('d-m-y', strtotime($value->created_at))}}</td>
                      <td>
                        <select  class="form-control ChangeStatus" id="{{$value->id}}" style="width:150px;">
                          <option {{($value->status == 0)? 'selected' :''}} value="0">Pending</option>
                          <option {{($value->status == 1)? 'selected' :''}} value="1">In progress</option>

                          <option {{($value->status == 2)? 'selected' :''}} value="2">delivered</option>

                          <option {{($value->status == 3)? 'selected' :''}} value="3">completed</option>
                          <option {{($value->status == 4)? 'selected' :''}} value="4">Cancelled</option>


                        </select>
                      </td>
                      <td>
                      <a href="{{url('admin/order/detail/'. $value->id)}}" class="btn btn-success md-2">View Details</a>
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
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          
          
         
        </div>
        
      </div>
    </section>
</div>

  @endsection
  @section('script')
  <script type="text/javascript">
    $('body').delegate('.ChangeStatus','change',function(){

      var status = $(this).val();
      var order_id = $(this).attr('id');
      $.ajax({
        type: "GET",
        url: "{{ url('admin/order_status') }}",
        data: {

          status : status,
          order_id : order_id

        },
        dataType: "json",
        success: function(data) {
          alert(data.message);
			
        }
       
        });


    });

  </script>
@endsection