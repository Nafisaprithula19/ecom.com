<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';

    static public function getSingle($id){
        return self::find($id);
    }
    
    static public function getRecord()
    {
        return self::select('product.*','users.name as created_by_name')
                    ->join('users', 'users.id', '=', 'product.created_by')
                    ->where('product.is_delete' , '=',0)
                    ->orderBy('product.id', 'desc')
                    ->paginate(20);
    }

    static public function getRecentArrival(){

        $return = self::select('product.*', 'users.name as created_by_name', 'category.name as category_name' , 'category.slug as category_slug','sub_category.name as sub_category_name','sub_category.slug as sub_category_slug')
        ->join('users', 'users.id', '=', 'product.created_by')
        ->join('category', 'category.id', '=', 'product.category_id') 
        ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
        ->where('product.is_delete', '=', 0) 
        ->where('product.status', '=', 0)            
        ->orderBy('product.id', 'desc')
        ->paginate(6);

return $return;

    }

    static public function getProduct($category_id = '', $subcategory_id = '')
    {
        $return = self::select('product.*', 'users.name as created_by_name', 'category.name as category_name' , 'category.slug as category_slug','sub_category.name as sub_category_name','sub_category.slug as sub_category_slug')
                    ->join('users', 'users.id', '=', 'product.created_by')
                    ->join('category', 'category.id', '=', 'product.category_id') 
                    ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id');
    
        if (!empty($category_id)) {
            $return = $return->where('product.category_id', '=', $category_id); // Assuming `category_id` is the correct column
        }
    
        if (!empty($subcategory_id)) {
            $return = $return->where('product.sub_category_id', '=', $subcategory_id); // Assuming `subcategory_id` is the correct column
        }

        if (!empty(Request::get('sub_category_id'))) {
            $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
            $sub_category_id_array = explode(",", $sub_category_id);
            $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
        }
        
        if (!empty(Request::get('brand_id'))) {
            $brand_id = rtrim(Request::get('brand_id'), ',');
            $brand_id_array = explode(",", $brand_id);
            $return = $return->whereIn('product.brand_id', $brand_id_array); // Fix typo in 'brand_id'
        }

        if(!empty(Request::get('q'))){

            $return = $return->where('product.title', 'like' ,'%'.Request::get('q').'%');

        }
    
        $return = $return->where('product.is_delete', '=', 0) 
        ->where('product.status', '=', 0)            
        ->orderBy('product.id', 'desc')
                    ->paginate(20);
    
        return $return;
    }

    static public function getRelatedProduct($product_id, $sub_category_id){
        $return = self::select('product.*', 'users.name as created_by_name', 'category.name as category_name' , 'category.slug as category_slug','sub_category.name as sub_category_name','sub_category.slug as sub_category_slug')
                    ->join('users', 'users.id', '=', 'product.created_by')
                    ->join('category', 'category.id', '=', 'product.category_id') 
                    ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
                    ->where('product.id', '!=', $product_id) 
                    ->where('product.sub_category_id', '=', $sub_category_id) 
                    ->where('product.is_delete', '=',0 ) 
                    
                        ->where('product.status', '=', 0)            
                        ->orderBy('product.id', 'desc')
                        ->limit(12)
                         ->get();
        return $return;

    }

    static public function getImageSingle($product_id){
       return ProductImageModel ::where('product_id','=',$product_id)->orderBy('order_by','asc')->first();

    }

    static public function getSingleSlug($slug){
        return self::where('slug','=',$slug)
        ->where('product.is_delete', '=', 0) 
        ->where('product.status', '=', 0)
        ->first();



    }
    


    static public function checkSlug($slug){
        return self::where('slug','=',$slug)->count();

    }

    public function getColor(){
        return $this->hasMany(ProductColorModel::class, "product_id");
     }

     public function getSize(){
        return $this->hasMany(ProductSizeModell::class, "product_id");
     }

     public function getImage(){
        return $this->hasMany(ProductImageModel::class, "product_id")->orderBy('order_by','asc');
     }

     public function getCategory(){
        return $this->belongsTo(CategoryModel::class, 'category_id');

     }

     public function getSubCategory(){
        return $this->belongsTo(SubCategoryModel::class, 'sub_category_id');

     }



}
