<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\DiscountCodeModel;
use Illuminate\Validation\Rule;
use Auth;


class DiscountCodeController extends Controller
{
    public function list(){
        $data['getRecord'] = DiscountCodeModel::getRecord();
    $data['header_tittle'] = 'discount_code';
    return view('admin.discount_code.list', $data);
    }

    public function add(){
       
        $data['header_tittle'] = 'Add_new_discount_code';
        return view('admin.discount_code.add', $data);
        }
        public function insert(Request $request){
           
           

           $discount_code = new DiscountCodeModel;
           $discount_code->name = trim($request->name);
           $discount_code->type = trim($request->type);
           $discount_code->percent_amount = trim($request->percent_amount);
           $discount_code->expire_date = trim($request->expire_date); // Save expire_date
           $discount_code->status = trim($request->status);
           $discount_code->save();

           return redirect('admin/discount_code/list')->with('error', "discount_code Successfully Created");


            
            }

            public function edit($id){
                $data['getRecord'] = DiscountCodeModel::getSingle($id);
                 $data['header_tittle'] = 'Edit discount_code';
                return view('admin.discount_code.edit', $data);
                 }
                 public function update($id, Request $request)
                 {
                   
                    
         
                    $discount_code = DiscountCodeModel::getSingle($id);
                    $discount_code->name = trim($request->name);
                    $discount_code->type = trim($request->type);
                    $discount_code->percent_amount = trim($request->percent_amount);
                    $discount_code->expire_date = trim($request->expire_date); // Save expire_date
                    $discount_code->status = trim($request->status);
                    $discount_code->save();
         
                    return redirect('admin/discount_code/list')->with('error', "discount_code Successfully Updated");
                 }

                 public function delete($id){
                    $brand =  DiscountCodeModel::getSingle($id);
                    $brand -> is_delete = 1;
                    $brand->save();
                    return redirect()->back()->with('error', "discount_code Successfully Deleted");
                }
}
