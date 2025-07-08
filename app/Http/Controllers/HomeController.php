<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }

    public function order(){
        $user=Auth::user();
        $orders=$user->order()->get();
        return view('order', compact('orders'));
    }
    public function postOrder(Request $request)
    {
        $request->validate([
            'map_link' => 'required|url',
            'note' => 'required|string|max:1000',
            'quantity' => 'required|integer|min:1',
            'drive_link' => 'nullable|url',
        ]);

        $totalPrice = 15000 * $request->quantity;

        $order = Order::create([
            'user_id'   => Auth::id(), // hoặc request()->user()->id nếu qua API token
            'code'      => $this->generateOrderCode(),
            'map_link'  => $request->map_link,
            'action'    => 'Tăng review',
            'status'    => 'pending',
            'note'      => $request->note,
            'drive_link'=> $request->drive_link,
            'price'     => $totalPrice,
            'time' => now()
        ]);
        return redirect()->back()->with('success', 'Tạo đơn thành công!');
    }
    public function payment(){
        return view('payment');
    }
    public function profile(){
        $user = Auth::user();
        $transactions=$user->transaction()->get();
        $activities=$user->activities()->get();
        return view('profile', compact('transactions','activities'));
    }
    public function generateOrderCode(): string
    {
        $date = now()->format('dmY'); // ngày-tháng-năm: 08072024
        $random = strtoupper(\Illuminate\Support\Str::random(6)); // ví dụ: ABC123
        return 'ORD' . $date . '-' . $random;
    }
}
