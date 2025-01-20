@extends('admin.layouts.app')
@section('style')
<link rel="stylesheet" href="{{url('public/assets/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Product</h1>
          </div>
          @if(session()->has('error'))
        <div class="alert alert-dark" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>       
            {{ session()->get('error') }}
        </div>
    @endif
          
      </div>
      <!-- /.container-fluid -->
    </section>
    <section>
    <div class="card card-primary">
            
              <!-- /.card-header -->
              <!-- form start -->
           
              <form action="" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                         <label >Title<span style="color:red">*</span></label>
                          <input type="text" class="form-control" value="{{ old('title', $product->title) }}" name="title" placeholder="Enter new title" required >
                       </div>  
                     </div>


                     <div class="col-md-6">
                        <div class="form-group">
                           <label >SKU<span style="color:red">*</span></label>
                            <input type="text" class="form-control" value="{{ old('sku',  $product->sku) }}" name="sku" placeholder="Enter new SkU" required >
                         </div>
                        </div>

                        <div class="col-md-6">
              <div class="form-group">
                <label>Category<span style="color:red">*</span></label>
                <select class="form-control" id="changecategory" name="category_id">
                  <option value="">Select</option>
                  @foreach($getCategory as $category)
                    <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>  
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Sub-Category<span style="color:red">*</span></label>
                <select class="form-control" id="getsubcategory" name="sub_category_id">
                  <option value="">Select</option>
                  @foreach($getSubCategory as $subcategory)
                    <option {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                  @endforeach
                  
                </select>
              </div>  
            </div>


            <div class="col-md-6">
    <div class="form-group">
        <label>Brand<span style="color:red">*</span></label>
        <select class="form-control" name="brand_id">
            <option value="">Select</option>
            @foreach($getBrand as $brand)
                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>


                         
                       </div>  
                     </div>



                  </div>


                  <div class="row" style="margin-left:10px;">
                     <div class="col-md-6">
                        <div class="form-group">
                         <label >Price<span style="color:red">*</span></label>
                          <input type="text" class="form-control" value="{{$product->price}} " name="price" placeholder="Enter price" required >
                       </div>  
                     </div>


                       <div class="col-md-6">
                         <div class="form-group">
                           <label >Old Price<span style="color:red">*</span></label>
                            <input type="text" class="form-control" value="{{$product->old_price}} " name="old_price" placeholder="Enter old price" required >
                         </div>
                        </div>



                  </div>


                  <div class="row" style="margin-left:10px;">
                    <div class="col-md-12">
                     <div class="form-group">
                         <label >Color<span style="color:red">*</span></label>
                         @foreach($getColor as $color)
                         @php
                         $checked = '';
                         @endphp
                         @foreach($product->getColor as $pcolor)
                         @if($pcolor->color_id == $color->id)
                         @php
                         $checked = 'checked';
                         @endphp
                         @endif
                         @endforeach
                         <div>
                           <label ><input {{ $checked}} type="checkbox" name="color_id[]" value="{{ $color->id }}">{{ $color->name }}</label>
                         </div>
                  @endforeach
                       
                          
                       </div> 

                    </div>
                  </div>


                  <div class="row" style="margin-left:10px;">
    <div class="col-md-12">
        <label>Size<span style="color:red">*</span></label>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Price</th>
                        
                    </tr>
                </thead>
               
                <tbody id="AppendSize">
                  
    <tr>
        <td>
            <input type="text" name="size[0][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text"  name="size[0][price]" placeholder="Additional Price" class="form-control">
        </td>
       
    </tr>

   

    <tr>
        <td>
            <input type="text"  name="size[1][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[1][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>

    <tr>
        <td>
            <input type="text" name="size[2][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[2][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>

    <tr>
        <td>
            <input type="text" name="size[3][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[3][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>
    <tr>
        <td>
            <input type="text" name="size[4][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[4][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>
    <tr>
        <td>
            <input type="text" name="size[5][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[5][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>

    <tr>
        <td>
            <input type="text" name="size[6][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[6][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>

    <tr>
        <td>
            <input type="text" name="size[7][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[7][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>

    <tr>
        <td>
            <input type="text" name="size[8][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[8][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>

    <tr>
        <td>
            <input type="text" name="size[9][name]" placeholder="Size" class="form-control">
        </td>
        <td>
            <input type="text" name="size[9][price]" placeholder="Additional Price" class="form-control">
        </td>
        
    </tr>
    
    
</tbody>
            </table>
        </div>
    </div>
</div><div class="row" style="margin-left:10px;">


<div class="col-md-12">

   <div class="form-group">
     <label >Image</span></label>
      <input type="file" name="image[]" class="form-control" style="padding: 5px;" multiple accept="image/*">
   </div> 

</div>
</div>
               @if(!empty($product->getImage->count()))
               <div class="row" style="margin-left:10px;">
                    
                    @foreach($product->getImage as $image)
                     @if(!empty($image->getLogo()))
                    <div class="col-md-1" style="text-align:center;">
                         <img style = "width: 100px; height: 100px;" src="{{$image->getLogo() }}" alt="">
                         <a href="{{ url('admin/product/image_delete/' . $image->id) }}" style="margin-top:5px;" class="btn btn-danger btn-sm">
    <i class="fa fa-trash" aria-hidden="true"></i>
</a>

                    </div>
                    @endif
                    @endforeach
                </div>

               @endif
  



                  <div class="row" style="margin-left:10px;">


                    <div class="col-md-12">
                    
                       <div class="form-group">
                         <label >Short Description</span></label>
                          <textarea name="short_description" class="form-control editor" id="" placeholder="Short description">{{$product->short_description}}</textarea>
                       </div> 

                    </div>

                    
                    
                    
                    <div class="col-md-12">
                    
                       <div class="form-group">
                         <label >Description<span style="color:red">*</span></label>
                          <textarea name="description" class="form-control editor" id="" placeholder="Description">{{$product->description}}</textarea>
                       </div> 

                    </div>

                    
                    <div class="col-md-12">
                    
                       <div class="form-group">
                         <label >Additional Information</span></label>
                          <textarea name="additional_information" class="form-control editor" id="" placeholder="Additional Information">{{$product->additional_information}}</textarea>
                       </div> 

                    </div>

                    <div class="col-md-12">
                    
                       <div class="form-group">
                         <label >Shipping Returns</span></label>
                          <textarea name="shipping_returns" class="form-control editor" id="" placeholder="Shipping returns">{{$product->shipping_returns}}</textarea>
                       </div> 

                    </div>

                  </div>
                 <div class="row" style="margin-left:10px;">
                  <div class="col-md-12">
                  <div class="form-group">
                    <label >status</label>
                    <select class="form-control" name="status" id="">
                        <option {{($product->status==0)? 'selected' : ''}} value="0">Active</option>
                        <option  {{($product->status==1)? 'selected' : ''}}value="1">Inactive</option>
                    </select>
                  </div>
                  </div>
                 </div>

                  
                  

                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer" ">
                  <div>
                  <button style="margin-left:330px;" type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form>
            </div>
    </section>

    <!-- Main content -->
    
</div>

  @endsection
  @section('script')
  <script src="{{url('public/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
  
  <script type="text/javascript">
    $('.editor').summernote();
    
    var i = 0; // Start from 101 or whatever is suitable

// Event handler for adding a row
$('body').delegate('.AddSize', 'click', function() {
    var html = '<tr id="DeleteSize' + i + '">\n\
                    <td><input type="text" name=size[' + i + '][name]" placeholder="Size" class="form-control"></td>\n\
                    <td><input type="text" name="size[' + i + '][price]" placeholder="Additional Price" class="form-control"></td>\n\
                    <td><button type="button" id="' + i + '" class="btn btn-danger btn-sm DeleteSize">Delete</button></td>\n\
               </tr>';
    i++; // Increment index
    $('#AppendSize').append(html);
});


// Event handler for deleting a row
$('body').delegate('.DeleteSize','click', function() {
   var id = $(this).attr('id');
   $('#DeleteSize'+id).remove();
});
   




  $('body').on('change', '#changecategory', function(e) {
    var id = $(this).val();

    $.ajax({
      type: "POST",
      url: "{{ url('admin/get_sub_category') }}",
      data: {
        id: id,
        "_token": "{{ csrf_token() }}"
      },
      dataType: "json",
      success: function(data) {
        $('#getsubcategory').html(data.html);
      },
      error: function(data) {
        console.error("An error occurred:", data);
      }
    });
  });
</script>




@endsection