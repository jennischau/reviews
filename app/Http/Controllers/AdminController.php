<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $orders=Order::get();
        return view('admin.index', compact('orders'));
    }
    public function updateStatus($id){
        $order=Order::find($id);
        if($order==null){
            return redirect()->route('admin.index')->with('error', 'Không tìm thấy đơn này');
        }
        if($order->status=="Đang chờ"){
           $order->status="Đang phân phối";
        }
        $order->save();
        return redirect()->route('admin.index');
    }
}
