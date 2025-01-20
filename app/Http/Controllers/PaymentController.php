<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\ProductModel;
use App\Models\ProductSizeModell;
use App\Models\DiscountCodeModel;
use App\Models\ShippingChargeModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ColorModel;
use App\Models\User;
use Hash;
use Auth;



class PaymentController extends Controller
{ 
    // In your PaymentController

public function apply_discount_code(Request $request)
{
    $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
    if(!empty($getDiscount)){
        $total = Cart::GetSubTotal();

        if($getDiscount->type == 0){
            $discount_amount = $getDiscount->percent_amount;
            $payable_total = $total - $getDiscount->percent_amount;



        }
        else{

            $discount_amount = ($total * $getDiscount->percent_amount )/100;
            $payable_total = $total-$discount_amount;

        }
        $json['status'] = true;
        $json['discount_amount'] = number_format($discount_amount,2);
        $json['payable_total'] =$payable_total;


        $json['message'] = "Success";

    }
    else{
        $json['status'] = false;
        $json['discount_amount'] = 0.00;
        $json['payable_total'] = Cart::GetSubTotal();
        $json['message'] = "discount code invalid";
    }
    echo json_encode($json);
}






    public function checkout(Request $request){
        $data['meta_title'] = 'checkout';
        $data['meta_description'] = ' ';
        $data['meta_keywords'] = ' ';
        $data['getShipping'] = ShippingChargeModel::getRecordActive();
        return view('payment.checkout',$data);

    }


    public function cart(Request $request){
        $data['meta_title'] = 'Cart';
        $data['meta_description'] = ' ';
        $data['meta_keywords'] = ' ';
       
        return view('payment.cart',$data);

    }

   
    public function cart_delete($id){
        Cart::remove($id);
        return redirect()->back();

    }
    public function add_to_cart(Request $request){

        $getProduct = ProductModel::getsingle($request->product_id);
        $total = $getProduct->price;
        if(!empty($request->size_id)){
            $size_id = $request->size_id;
            $getSize = ProductSizeModell::getSingle($size_id);

            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;

        }
        else{
            $size_id = 0;
        }
        $color_id = !empty($request->color_id) ? $request->color_id: 0;

        Cart::add([
            'id' => $getProduct->id, // Product ID
            'name' => 'product',
            'price' => $total, // Product price
            'quantity' => $request->qty, // Quantity
            'attributes' => [
                'size_id' => $size_id,
                 'color_id' => $color_id,// Any additional attributes
            ],
        ]);

     return redirect()->back();
    }

    public function update_cart(Request $request){


        foreach($request->cart as $cart)
        {
            Cart::update($cart['id'], array(              
             'quantity' =>array(
                    'relative' => false,
                    'value' => $cart['qty'],
             ),
            ));
        }
        return redirect()->back();

        

       

    }

    public function place_order(Request $request)
    {
        $validate = 0;  // Validation flag
        $message = '';  // Validation message
        $json = ['status' => false, 'message' => ''];  // Default JSON response
        if(!empty(Auth::check())){
            $user_id = Auth::user()->id;


        }
        else{
            if (!empty($request->isCreate)) {
                // Check if the email is already registered
                $checkEmail = User::checkEmail($request->email);
                if (!empty($checkEmail)) {
                    $message = "This email is already registered, please choose another.";
                    $validate = 1;
                } else {
                    $save = new User();  // Add this missing object creation
                    $save->name = trim($request->first_name);
                    $save->email = trim($request->email);
                    $save->password = Hash::make($request->password);
                    $save->save();
                    $user_id = $save->id;
                }
            } else {
                $user_id = '';
            }
        

        }
       
        // If validation fails, return the error message
        if (!empty($validate)) {
            $json['status'] = false;
            $json['message'] = $message;
            echo json_encode($json);
            return;
        }
    
        // Fetch shipping details
        $getShipping = ShippingChargeModel::getSingle($request->shipping);
        $payable_total = Cart::GetSubTotal(); // Initial subtotal
        $discount_amount = 0;
        $discount_code = '';
    
        // Check and apply discount
        if (!empty($request->discount_Code)) {
            $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_Code);
            if (!empty($getDiscount)) {
                $discount_code = $request->discount_Code;
                if ($getDiscount->type == 0) { // Fixed amount
                    $discount_amount = $getDiscount->percent_amount;
                    $payable_total -= $discount_amount;
                } else { // Percentage discount
                    $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                    $payable_total -= $discount_amount;
                }
            }
        }
    
        // Add shipping charge
        $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
        $total_amount = $payable_total + $shipping_amount;
    
        // Create new order
        $order = new OrderModel();
        if (!empty($user_id)) {
            $order->user_id = trim($user_id);  // Fixed typo here
        }
    
        $order->first_name = trim($request->first_name);
        $order->last_name = trim($request->last_name);
        $order->company_name = trim($request->company_name);
        $order->country_name = trim($request->country_name);
        $order->address1 = trim($request->address1);
        $order->address2 = trim($request->address2);
        $order->city = trim($request->city);
        $order->state = trim($request->state);
        $order->postcode = trim($request->postcode);
        $order->phone = trim($request->phone);
        $order->email = trim($request->email);
        $order->notes = trim($request->notes);
    
        // Assign calculated values
        $order->discount_amount = $discount_amount;
        $order->discount_Code = $discount_code;
        $order->shipping_id = $request->shipping;
        $order->shipping_amount = $shipping_amount;
        $order->total_amount = $total_amount;
        $order->payment_method = trim($request->payment_method);
    
        // Save the order
        $order->save();
    
        // Save order items
        foreach (Cart::getContent() as $cart) {
            $order_item = new OrderItemModel();
            $order_item->order_id = $order->id;
            $order_item->product_id = $cart->id;
            $order_item->quantity = $cart->quantity;
            $order_item->price = $cart->price;


            // Assign optional attributes
            $color_id = $cart->attributes->color_id;

            if (!empty($color_id)) {
                $getColor = ColorModel::getSingle($color_id);
                $order_item->color_name = $getColor->name;
            }
            $size_id = $cart->attributes->size_id;
            if (!empty($size_id)) {
                $getSize = ProductSizeModell::getSingle($size_id);
                $order_item->size_name = $getSize->name;
                $order_item->size_amount = $getSize->price;
            }
    
            $order_item->total_price = $cart->price * $cart->quantity;
            $order_item->save();
        }
    
        // Return success JSON response
        $json['status'] = true;
        $json['message'] = 'success';
        $json['redirect'] = url('checkout/payment?order_id='.base64_encode($order->id));

        echo json_encode($json);
    }
    public function checkout_payment(Request $request){
        if(!empty(Cart::GetSubTotal()) && !empty($request->order_id))
        {
            $order_id = base64_decode($request->order_id);
            $getOrder = OrderModel::getSingle($order_id);
            if(!empty( $getOrder)){
                if($getOrder->payment_method == 'cash'){
                    $getOrder->is_payment = 1;
                    $getOrder->save();
                    cart::clear();
                    return redirect('cart')->with('error',"order successfully placed!!");


                }
                else if($getOrder->payment_method == 'paypal'){
                    ;
                    $query = array();
                    $query['business'] = "nafisabusiness@gmail.com";
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = 'IB CODE LTD';
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $getOrder->id;
                    $query['amount'] = $getOrder->total_amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('checkout');
                    $query['return'] = url('paypal/success-payment');
                    $query_string = http_build_query($query);
                    header('Location: http://www.sandbox.paypal.com/cgi-bin/webscr?'. $query_string);
                    exit();











                }
                else if($getOrder->payment_method == 'stripe'){

                }




            }
            else{
                abort(404);
            }


        }
        else{
            abort(404);
        }
        

    }

    public function paypal_success_payment(Request $request){
       if(!empty($request->item_number) && !empty($request->st) && $request->st == 'completed'){
        $getOrder = OrderModel::getSingle($request->item_number);
        if(!empty($getOrder)){
            $getOrder->transaction_id = $request->tx;
            $getOrder->is_payment = 1;

            $getOrder->payment_data = json_encode($request->all());

                    $getOrder->save();
                    cart::clear();
                    return redirect('cart')->with('error',"order successfully placed!!");

        }
        else{
        abort(404);

            
        }
       }
       else{
        abort(404);
       }

    }
    

}
