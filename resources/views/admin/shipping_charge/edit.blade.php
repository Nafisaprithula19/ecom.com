@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit shipping Charge</h1>
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
                    <label >shipping Charge Name <span style="shipping Charge:red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('name',$getRecord->name) }}" name="name" placeholder="Enter new shipping Charge Name" required >
                  </div>
                

          <!-- price -->
          <div class="form-group">
            <label>price <span style="color:red;">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              value="{{ old('price',$getRecord->price) }}" 
              name="price" 
              placeholder="Enter shipping price" 
              required>
          </div>

         
                  
                  <div class="form-group">
                    <label >status</label>
                    <select class="form-control" name="status" id="">
                        <option {{(old('status',$getRecord->status ) == 0)? 'selected' : ''}} value="0">Active</option>
                        <option  {{(old('status',$getRecord->status )==1)? 'selected' : ''}}value="1">Inactive</option>
                    </select>
                  </div>
                  <hr>
                  
</hr>
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
    </section>

    <!-- Main content -->
    
</div>

  @endsection
  @section('script')
@endsection