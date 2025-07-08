<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $user=Auth::user();
        $totalPrice = 15000 * $request->quantity;
        if($totalPrice>$user->balance){
            return redirect()->back()->with('error', 'Tạo đơn không thành công! Vui lòng nạp thêm tiền.');
        }
        $order = Order::create([
            'user_id'   => $user->id, // hoặc request()->user()->id nếu qua API token
            'code'      => $this->generateOrderCode(),
            'map_link'  => $request->map_link,
            'action'    => 'Tăng review',
            'status'    => 'Đang chờ',
            'note'      => $request->note,
            'drive_link'=> $request->drive_link,
            'price'     => $totalPrice,
            'time' => now()
        ]);
        Transaction::create([
            'transaction_code' => strtoupper('DEP' . now()->format('dmY') . '-' . Str::random(6)),
            'balance_before' => $user->balance,
            'amount' => -$totalPrice,
            'balance_after' => $user->balance - $totalPrice,
            'description' => "Tạo đơn đánh giá cho tài khoản: ". $user->name,
            'user_id' => $user->id
        ]);
        $user->balance -= $totalPrice;
        $user->save();
        return redirect()->back()->with('success', 'Tạo đơn thành công!');
    }
    public function payment(){
        $user = Auth::user();
        $transactions=$user->transaction()->get();
        return view('payment', compact('transactions'));
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
