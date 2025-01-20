<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\ShippingChargeModel;
use Illuminate\Validation\Rule;
use Auth;


class ShippingChargeController extends Controller
{
    public function list(){
        $data['getRecord'] = ShippingChargeModel::getRecord();
    $data['header_tittle'] = 'shipping_charge';
    return view('admin.shipping_charge.list', $data);
    }

    public function add(){
       
        $data['header_tittle'] = 'Add_new_shipping_charge';
        return view('admin.shipping_charge.add', $data);
        }
        public function insert(Request $request){
           
           

           $shipping_charge = new ShippingChargeModel;
           $shipping_charge->name = trim($request->name);
           $shipping_charge->price = trim($request->price);
           $shipping_charge->status = trim($request->status);
           $shipping_charge->save();

           return redirect('admin/shipping_charge/list')->with('error', "shipping_charge Successfully Created");


            
            }

            public function edit($id){
                $data['getRecord'] = ShippingChargeModel::getSingle($id);
                 $data['header_tittle'] = 'Edit shipping_charge';
                return view('admin.shipping_charge.edit', $data);
                 }
                 public function update($id, Request $request)
                 {
                   
                    
         
                    $shipping_charge = ShippingChargeModel::getSingle($id);
                    $shipping_charge->name = trim($request->name);
                    $shipping_charge->price = trim($request->price);
                    $shipping_charge->status = trim($request->status);
                    $shipping_charge->save();
         
                    return redirect('admin/shipping_charge/list')->with('error', "shipping_charge Successfully Updated");
                 }

                 public function delete($id){
                    $brand =  ShippingChargeModel::getSingle($id);
                    $brand -> is_delete = 1;
                    $brand->save();
                    return redirect()->back()->with('error', "shipping_charge Successfully Deleted");
                }
}
