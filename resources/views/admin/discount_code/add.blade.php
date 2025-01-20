@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New Discount Code</h1>
          </div>
      </div>
    </section>
    <section>
    <div class="card card-primary">
      <form action="" method="post">
        {{ csrf_field() }}
        <div class="card-body">

          <!-- Discount Code Name -->
          <div class="form-group">
            <label>Discount Code Name <span style="color:red;">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              value="{{ old('name') }}" 
              name="name" 
              placeholder="Enter new discount code name" 
              required>
          </div>

          <!-- Type -->
          <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type" id="">
              <option {{ (old('type') == 0) ? 'selected' : '' }} value="0">Amount</option>
              <option {{ (old('type') == 1) ? 'selected' : '' }} value="1">Percent</option>
            </select>
          </div>

          <!-- Percent Amount -->
          <div class="form-group">
            <label>Percent Amount <span style="color:red;">*</span></label>
            <input 
              type="text" 
              class="form-control" 
              value="{{ old('percent_amount') }}" 
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
              value="{{ old('expire_date') }}" 
              name="expire_date" 
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
