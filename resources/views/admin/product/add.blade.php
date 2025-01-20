@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New Product</h1>
          </div>
          
      </div>
      <!-- /.container-fluid -->
    </section>
    <section>
    <div class="card card-primary">
            
              <!-- /.card-header -->
              <!-- form start -->
           
              <form action="" method="post">
               {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label >Title<span style="color:red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('title') }}" name="title" placeholder="Enter new title" required >
                  </div>
                  
</hr>
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
    </section>

    <!-- Main content -->
    
</div>

  @endsection
  @section('script')
@endsection