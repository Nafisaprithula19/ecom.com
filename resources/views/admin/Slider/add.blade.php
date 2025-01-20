@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New Slider</h1>
          </div>
      </div>
    </section>
    <section>
    <div class="card card-primary">
      <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">

          <!-- Slider Name -->
          <div class="form-group">
            <label>Title <span style="color:red;">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              value="{{ old('title') }}" 
              name="title" 
              placeholder="Enter new Slider name" 
              required>
          </div>

          <div class="form-group">
            <label>Image Upload <span style="color:red;">*</span></label>
            <input 
              type="file" 
              class="form-control" 
              required
              name="image_name" 
              placeholder="Enter new Slider name" 
              required>
          </div>

          <div class="form-group">
            <label>Button name </label>
            <input 
              type="text" 
              class="form-control"
              name="button_name" 
              value="{{ old('button_name') }}" 

              placeholder="Enter new button name" 
              >
          </div>

          <div class="form-group">
            <label>Button Link </label>
            <input 
              type="text" 
              class="form-control" 
            
              name="button_link" 
              value="{{ old('button_link') }}" 

              placeholder="Enter new button link" 
              >
          </div>

          
          

         

          <!-- Status -->
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" id="">
              <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
              <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
            </select>
          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    </section>
</div>
@endsection
@section('script')
@endsection
