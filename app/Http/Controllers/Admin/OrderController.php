<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\OrderModel;


class OrderController extends Controller
{
    public function list(){
        $data['getRecord'] = OrderModel::getRecord();
    $data['header_tittle'] = 'Orders';
    return view('admin.order.list', $data);
    }

    public function order_detail($id)
    {
    $data['getRecord'] = OrderModel::getSingle($id);
    $data['header_tittle'] = 'Order detail';
    return view('admin.order.detail', $data);
    }

    public function order_status(Request $request)
    {
        $getOrder = OrderModel::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();

        $json['message'] = "status successfully updated";
        echo json_encode($json);

    }

    
}
