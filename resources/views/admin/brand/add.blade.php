@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New Brand</h1>
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
                    <label >Brand Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Enter new Brand Name" required >
                  </div>
                  <div class="form-group">
                    <label >Slug <span style="color:red">*</label>
                    <input type="text" class="form-control" value="{{ old('slug') }}" name="slug" placeholder="Slug (i.g-URL)" required>
                    <div style="color:red">{{$errors->first('slug')}}</div>
                  </div>

                  
                  <div class="form-group">
                    <label >status</label>
                    <select class="form-control" name="status" id="">
                        <option {{(old('status')==0)? 'selected' : ''}} value="0">Active</option>
                        <option  {{(old('status')==1)? 'selected' : ''}}value="1">Inactive</option>
                    </select>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label >Meta Tillte <span style="color:red">*</label>
                    <input type="text" class="form-control" value="{{ old('meta-title') }}" name="meta_title" placeholder="Meta Title" required >
                  </div>
                  <div class="form-group">
                    <label >Meta Description</label>
                    <textarea class="form_control" name="meta_description"  placeholder="Meta Description" >{{ old('meta_description') }}</textarea>
                  </div>
                  <div class="form-group">
                    <label >Meta Keywords</label>
                    <input type="text" class="form-control" value="{{ old('meta_keywords') }}" name="meta_keywords" placeholder="Meta keywords" >
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