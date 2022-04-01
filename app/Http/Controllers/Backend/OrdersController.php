<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdersController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.pages.order.index', compact('orders'));
    }
    public function show($id){
        $order = Order::find($id);
        $order->is_seen_by_admin = 1;
        $order->save();
        return view('admin.pages.order.show')->with('order', $order);
    }
    public function completed($id){
        $order = Order::find($id);
        if($order->is_completed){
            $order->is_completed = 0;
        }
        else{
            $order->is_completed = 1;
        }
        $order->save();
        session()->flash('success', 'Order completed status Changed..........');
        return back();
    }
    public function paid($id){
        $order = Order::find($id);
        if($order->is_paid){
            $order->is_paid= 0;
        }
        else{
            $order->is_paid = 1;
        }
        $order->save();
        session()->flash('success', 'Order paid status Changed..........');
        return back();
    }

    public function delete($id)
        {
            $order = Order::find($id);
            if (!is_null($order)) {
            $order->delete();
            }
            session()->flash('delete', 'Product has deleted successfully !!');
            return back();
        }

        public function chargeUpdate(Request $request, $id){
            $order = Order::find($id);
            $order->shipping_charge = $request->shipping_charge;
            $order->custom_discount = $request->custom_discount;
         
            $order->save();
            session()->flash('success', 'Shipping Charge and Discount Added');
            return back();
        }
        public function invoice($id){
            $order = Order::find($id);
           
            $pdf = PDF::loadView('admin.pages.invoice.invoice', compact('order'));
            // $pdf->stream('invoice.pdf');
            return $pdf->stream('invoice.pdf');
           
        }
}
