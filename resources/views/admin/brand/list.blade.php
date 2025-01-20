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
            <h1> Brand List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{url('admin/brand/add')}}" class="btn btn-secondary btn-lg">Add New Brand</a>
           
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
                <h3 class="card-title">Brand List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Meta Title</th>
                      <th>Meta Description</th>
                      <th>Meta Keywords</th>
                      <th>Created By</th>
                      <th>Created Date</th>

                      <th>Status</th>
                      <th >Action</th>
                    </tr>
                    <tbody>
                        
                    @foreach($getRecord as $value )
                    <tr>
                      
                      <td>{{$value->id}}</td>
                      <td>{{$value->name}}</td>

                      <td>{{$value->slug}}</td>
                      <td>{{$value->meta_title}}</td>
                      <td>{{$value->meta_description}}</td>
                      <td>{{$value->meta_keywords}}</td>
                      <td>{{$value->created_by_name}}</td>
                      <td>{{date('d-m-y', strtotime($value->created_at))}}</td>
                      <td>{{($value->status == 0) ? 'Active' :'Inactive'}}</td>
                      <td>
                      <a href="{{url('admin/brand/edit/'. $value->id)}}" class="btn btn-success md-2">Edit</a>
                      <a href="{{url('admin/brand/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>
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