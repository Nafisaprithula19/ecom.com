<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    use HasFactory;

    protected $table = 'Slider';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getRecord()
    {
        return self::select('Slider.*')
        
        ->where('Slider.is_delete' , '=',0)
        ->orderBy('Slider.id','desc')
        ->paginate(20);

    }

    static public function getRecordActive()
    {
        return self::select('Slider.*')
        ->where('Slider.status' , '=',0)
        ->where('Slider.is_delete' , '=',0)
        ->orderBy('Slider.id','asc')
        ->get();

    }

    

    public function getImage()
    {
    if(!empty($this->image_name) && file_exists('upload/Slider/'.$this->image_name)){
        return url('upload/Slider/'.$this->image_name);
    }
    else{
        return "";
    }
}

}
