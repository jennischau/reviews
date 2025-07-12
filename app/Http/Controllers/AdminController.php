<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(){
        $orders=Order::get();
        return view('admin.index', compact('orders'));
    }
    public function updateStatus($id,Request $request){
        $order=Order::find($id);
        if($order==null){
            return redirect()->route('admin.index')->with('error', 'Không tìm thấy đơn này');
        }
        $order->status=$request->status;
        if($request->status=='Hoàn thành'){
            $order->completed_at=now();
        }
        $order->save();
        return redirect()->route('admin.index');
    }
    public function payment(Request $request){
        $user=User::find($request->id);
        if($user==null){
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng này');
        }
        Transaction::create([
            'transaction_code' => strtoupper('DEP' .  '-' . Str::random(6).  '-' . Auth::user()->recipient),
            'balance_before' => $user->balance,
            'amount' => $request->amount,
            'balance_after' => $user->balance + $request->amount,
            'description' => "Nạp tiền cho tài khoản: ". $user->name,
            'user_id' => $user->id
        ]);
        $user->balance += $request->amount;
        $user->total_deposit += $request->amount;
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'Nạp tiền thành công cho '.$user->name);
    }
    public function generateOrderCode(): string
    {
        $date = now()->format('dmY'); // ngày-tháng-năm: 08072024
        $random = strtoupper(Str::random(6)); // ví dụ: ABC123
        return 'ORD' . $date . '-' . $random;
    }
    public function bank(){
        $user=Auth::user();
        if($user==null){
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng này');
        }
        return view('admin.bank', compact('user'));
    }
    public function updateBank(Request $request){
        $user=Auth::user();
        if($user==null){
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng này');
        }
        $user->name_bank= $request->name_bank;
        $user->short_name= $request->short_name;
        $user->account_number= $request->account_number;
        $user->account_name= $request->account_name;
        $user->recipient= $request->recipient;
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'Cập nhật thông tin ngân hàng thành công');
    }
}
