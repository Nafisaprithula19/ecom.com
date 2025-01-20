<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\CategoryModel;
use App\models\ProductModel;
use App\models\BrandModel;
use App\models\ColorModel;
use App\models\SubCategoryModel;
use App\models\ProductColorModel; 
use App\models\ProductSizeModell;
use App\models\ProductImageModel;

use Str;
use Auth;

class ProductController extends Controller
{
    public function list(){
        $data['getRecord'] = ProductModel::getRecord();
        
    $data['header_tittle'] = 'Product';
    return view('admin.product.list', $data);
    }

    public function add(){
       
        $data['header_tittle'] = 'Add_new_Product';
        return view('admin.Product.add', $data);
        }

        public function insert(Request $request){

            $title = trim($request->title);

            // Create new product instance
            $product = new ProductModel;
            $product->title = $title;
            $product->created_by = Auth::user()->id;
            $product->save();
        
            // Generate slug and check for uniqueness
            $slug = Str::slug($title, ".");
            $checkSlug = ProductModel::checkSlug($slug);
        
            if (empty($checkSlug)) {
                // If slug is unique, assign it to product
                $product->slug = $slug;
                $product->save();
            } else {
                // Otherwise, append product ID to make it unique
                $product_id = $product->id; // Get the ID of the saved product
                $new_slug = $slug . '.' . $product_id;
                $product->slug = $new_slug; // Assign new unique slug
                $product->save();
            }
        
            // Redirect to the edit page for the product
            return redirect('admin/product/edit/' . $product->id);
        
        }
        public function edit($product_id){

            $product = ProductModel::getSingle($product_id);
            if(!empty($product)){
                $data['getCategory'] = CategoryModel::getRecordActive();
                $data['getBrand'] = BrandModel::getRecordActive();
                $data['getColor'] = ColorModel::getRecordActive();
                $data['product'] = $product;

                $data['getSubCategory'] = SubCategoryModel::getRecordSubCategory($product->category_id);
             $data['header_tittle'] = 'Edit Product';
             return view('admin.Product.edit', $data);

            }
            
           
             }

             public function delete($id){
                $product =  ProductModel::getSingle($id);
                $product -> is_delete = 1;
                $product->save();
                return redirect()->back()->with('error', "Product Successfully Deleted");
            }

             public function update($product_id, Request $request){
                

               
                
                $product = ProductModel::getSingle($product_id);
                
                if (!empty($product)){
                   
                    $product->title = trim($request->title);
                    $product->sku = trim($request->sku);
                    $product->category_id = trim($request->category_id);
                    $product->sub_category_id = trim($request->sub_category_id);
                    $product->brand_id = trim($request->brand_id);
                    $product->price = trim($request->price);
                    $product->old_price = trim($request->old_price);
                    $product->short_description= trim($request->short_description);
                    $product->description = trim($request->description);
                    $product->additional_information = trim($request->additional_information);
                    $product->shipping_returns = trim($request->shipping_returns);
                    $product->save();

                    ProductColorModel::DeleteRecord($product->id);
                    if(!empty($request->color_id)){
                        foreach($request->color_id as $color_id){
                            $color = new ProductColorModel;
                            $color->color_id = $color_id;
                            $color->product_id = $product->id;
                            $color->save();

                        }
                    }

                    ProductSizeModell::DeleteRecord($product->id);

                    if (!empty($request->size)) {
                        foreach ($request->size as $size) {
                            if (!empty($size['name'])) {
                                $saveSize = new ProductSizeModell;
                                $saveSize->name = $size['name'];
                                $saveSize->price = !empty($size['price']) ? $size['price'] : 0;
                                $saveSize->product_id = $product->id;
                                $saveSize->save();
                            }
                        }
                    }
                    if(!empty($request->file('image'))){
                        foreach($request->file('image') as $value){
                            if($value->isValid()){
                                $ext = $value->getClientOriginalExtension();
                                $randomStr = $product->id.str::random(20);
                                $filename = strtolower($randomStr).'.'.$ext;
                                $value->move('upload/product/',$filename);

                                $imageupload = new ProductImageModel;
                                $imageupload->image_name = $filename;
                                $imageupload->image_extension = $ext;
                                $imageupload->product_id = $product_id;
                                $imageupload->save();

                            }
                        }
                        
                    }

                    return redirect()->back()->with('error', "product Successfully Updated");
                }
                else{
                    abort(404);
                }


             } 

             public function image_delete($id)
             {
                $image = ProductImageModel::getSingle($id);
                if(!empty($image->getLogo()))
                {
                   unlink('upload/product/'.$image->image_name);
                }
                $image->delete();
                return redirect()->back()->with('error', "product Image Successfully Updated");
             }

}
