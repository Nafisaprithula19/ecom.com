<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SliderModel;
use Illuminate\Validation\Rule;
use Str;
use Auth;



class SliderController extends Controller
{
    public function list(){
        $data['getRecord'] = SliderModel::getRecord();
    $data['header_tittle'] = 'Slider';
    return view('admin.Slider.list', $data);
    }

    public function add(){
       
        $data['header_tittle'] = 'Add_new_Slider';
        return view('admin.Slider.add', $data);
        }
        public function insert(Request $request){
           
           

           $Slider = new SliderModel;
           $Slider->title = trim($request->title);
           $Slider->button_name = trim($request->button_name);
           $Slider->button_link = trim($request->button_link);

           $file = $request->file('image_name');
           $ext = $file->getClientOriginalExtension();
           $randomStr = Str::random(20);
           $filename = strtolower($randomStr).'.'.$ext;
           $file->move('upload/Slider/',$filename);
           $Slider->image_name = trim($filename);



           

           $Slider->status = trim($request->status);
           $Slider->save();

           return redirect('admin/Slider/list')->with('error', "Slider Successfully Created");


            
            }

            public function edit($id){
                $data['getRecord'] = SliderModel::getSingle($id);
                 $data['header_tittle'] = 'Edit Slider';
                return view('admin.Slider.edit', $data);
                 }
                 public function update($id, Request $request)
                 {
                   
                    
         
                    $Slider = SliderModel::getSingle($id);
                    $Slider->title = trim($request->title);
                    $Slider->button_name = trim($request->button_name);
                    $Slider->button_link = trim($request->button_link);
                    if(!empty($request->file('image_name')))
                    {
                        $file = $request->file('image_name');
                        $ext = $file->getClientOriginalExtension();
                        $randomStr = Str::random(20);
                        $filename = strtolower($randomStr).'.'.$ext;
                        $file->move('upload/Slider/',$filename);
                    $Slider->image_name = trim($filename);

                    }
                    
         
         
         
                    
         
                    $Slider->status = trim($request->status);
                    $Slider->save();
         
                    return redirect('admin/Slider/list')->with('error', "Slider Successfully Updated");
                 }

                 public function delete($id){
                    $Slider =  SliderModel::getSingle($id);
                    $Slider -> is_delete = 1;
                    $Slider->save();
                    return redirect()->back()->with('error', "Slider Successfully Deleted");
                }
}
