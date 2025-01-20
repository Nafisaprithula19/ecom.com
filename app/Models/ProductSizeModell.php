<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeModell extends Model
{
    use HasFactory;
    protected $table = 'product_size';

    static public function getSingle($id){
        return self::find($id);
    }
    

    protected $fillable = ['name', 'price', 'product_id'];

    static public function DeleteRecord($product_id){
        self::where('product_id','=',$product_id)->delete();

    }
}
