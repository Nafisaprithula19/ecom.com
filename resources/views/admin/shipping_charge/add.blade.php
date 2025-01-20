@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New shipping Charge</h1>
          </div>
      </div>
    </section>
    <section>
    <div class="card card-primary">
      <form action="" method="post">
        {{ csrf_field() }}
        <div class="card-body">

          <!-- shipping Charge Name -->
          <div class="form-group">
            <label>shipping Charge Name <span style="color:red;">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              value="{{ old('name') }}" 
              name="name" 
              placeholder="Enter new shipping Charge name" 
              required>
          </div>

          <!-- Type -->
         

          <!-- Percent Amount -->
          <div class="form-group">
            <label>Price <span style="color:red;">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              value="{{ old('price') }}" 
              name="price" 
              placeholder="Enter shipping price" 
              required>
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
