<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\ColorModel;
use Illuminate\Validation\Rule;
use Auth;

class ColorController extends Controller
{
    public function list(){
        $data['getRecord'] = ColorModel::getRecord();
    $data['header_tittle'] = 'Color';
    return view('admin.color.list', $data);
    }

    public function add(){
       
        $data['header_tittle'] = 'Add_new_Color';
        return view('admin.color.add', $data);
        }
        public function insert(Request $request){
           
           
           $color = new ColorModel;
           $color->name = trim($request->name);
           $color->code = trim($request->code);
           $color->status = trim($request->status);
           
           $color->created_by = Auth::user()->id;
           $color->save();

           return redirect('admin/color/list')->with('error', "Color Successfully Created");


            
            }

            public function edit($id){
                $data['getRecord'] = ColorModel::getSingle($id);
                 $data['header_tittle'] = 'Edit Color';
                return view('admin.color.edit', $data);
                 }
                 public function update($id, Request $request)
                 {
                   
                    
         
                    $brand = ColorModel::getSingle($id);
                    $brand ->name = trim($request->name);
                    $brand ->code = trim($request->code);
                    $brand ->status = trim($request->status);
                  
                    $brand ->save();
         
                    return redirect('admin/color/list')->with('error', "Color Successfully Updated");
                 }

                 public function delete($id){
                    $brand =  ColorModel::getSingle($id);
                    $brand -> is_delete = 1;
                    $brand->save();
                    return redirect()->back()->with('error', "Color Successfully Deleted");
                }
}
