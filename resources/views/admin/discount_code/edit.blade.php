@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit discount_code</h1>
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
                    <label >discount_code Name <span style="discount_code:red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('name',$getRecord->name) }}" name="name" placeholder="Enter new discount_code Name" required >
                  </div>
                  <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type" id="">
              <option {{ (old('type',$getRecord->type) == 0) ? 'selected' : '' }} value="0">Amount</option>
              <option {{ (old('type',$getRecord->type) == 1) ? 'selected' : '' }} value="1">Percent</option>
            </select>
          </div>

          <!-- Percent Amount -->
          <div class="form-group">
            <label>Percent Amount <span style="color:red;">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              value="{{ old('percent_amount',$getRecord->percent_amount) }}" 
              name="percent_amount" 
              placeholder="Enter percentage or fixed amount" 
              required>
          </div>

          <!-- Expire Date -->
          <div class="form-group">
            <label>Expire Date <span style="color:red;">*</span></label>
            <input 
              type="date" 
              class="form-control" 
              value="{{ old('expire_date',$getRecord->expire_date) }}" 
              name="expire_date" 
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