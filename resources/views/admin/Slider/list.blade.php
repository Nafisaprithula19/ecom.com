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
            <h1> Slider List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{url('admin/Slider/add')}}" class="btn btn-secondary btn-lg">Add New Slider</a>
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Slider List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th >Image</th>

                      <th>Title</th>
                      <th>Button Name</th>
                      <th>Button Link</th>

                      
                      <th>Status</th>
                      <th>Created date</th>

                      <th >Action</th>
                    </tr>
                    <tbody>
                        
                    @foreach($getRecord as $value )
                    <tr>
                      
                      <td>{{$value->id}}</td>
                      <td> @if(!empty($value->getImage()))

<img src="{{$value->getImage()}}" style="height:160px;" alt="">

@endif</td>


                      <td>{{$value->title}}</td>
                      <td>{{$value->button_name}}</td>
                      <td>{{$value->button_link}}</td>


                     


                      
                    
                      <td>{{($value->status == 0) ? 'Active' :'Inactive'}}</td>
                      <td>{{$value->created_at}}</td>

                      <td>
                      <a href="{{url('admin/Slider/edit/'. $value->id)}}" class="btn btn-success md-2">Edit</a>
                      <a href="{{url('admin/Slider/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
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
@endsection