<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SliderModel;

use App\Models\CategoryModel;

use App\Models\ProductModel;





class HomeController extends Controller
{
    public function home()
    {    
        $data['getSlider'] = SliderModel::getRecordActive();
        $data['getCategory'] = CategoryModel::getRecordActiveHome();

        $data['getProduct'] = ProductModel::getRecentArrival();



        $data['meta_title'] = 'IB CODE';
        $data['meta_description'] = ' ';
        $data['meta_keywords'] = ' ';
        return view('home',$data);
    }


}
