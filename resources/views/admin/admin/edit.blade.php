@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Admin</h1>
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
                    <label >Name</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control"value="{{ old('email') }}" name="email" requird placeholder="Enter email">
                    <div style="color:red">{{$errors->first('email')}}</div>
                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control"value="{{$getRecord->password}}" name="password" placeholder="Password">
                    <p>Do you want to change password so,please add</p>
                  </div>
                  <div class="form-group">
                    <label >status</label>
                    <select class="form-control" name="status" required id="">
                        <option {{ ($getRecord->status == 0)?'selected':''}} value="0">Active</option>
                        <option {{ ($getRecord->status == 1)?'selected':''}} value="1">Inactive</option>
                    </select>
                  </div>
                 
                  
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