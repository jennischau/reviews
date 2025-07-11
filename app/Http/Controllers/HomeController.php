<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderTask;
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
            'content' => 'max:1000',
            'quantity' => 'integer|min:1',
            'drive_link' => 'nullable|url',
        ],[
            'map_link.required' => 'Vui lòng nhập link maps',
            'map_link.url' => 'Vui lòng nhập đúng định dang link',
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
            'status'    => 'Đang chờ',
            'content'      => $request->content,
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
        $admins=User::where('level','admin')
        ->where('account_number', '!=', '')
        ->get();
        $payment=$admins[0]??null;
        $minPay=0;
        $transactions=Transaction::get();
        foreach($admins as $admin){

            $sum=0;
            foreach($transactions as $transaction){
                $lastPart = substr($transaction->transaction_code, strrpos($transaction->transaction_code, '-') + 1);
                if(strcasecmp($lastPart, $admin->recipient) === 0){
                    $sum+=$transaction->amount;
                }
            }
            if (is_null($minPay) || $sum < $minPay) {
                $minPay = $sum;
                $payment = $admin;
            }
        }
        $transactions=$user->transaction()->get();
        return view('payment', compact('transactions','payment'));
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
    public function getTask(){
        $user=Auth::user();
        if(!in_array($user->level, ['admin', 'reviewer'])){
            return view('index');
        }
        $orders=Order::where('status', 'Đang phân phối')
        ->doesntHave('tasks')
        ->get();

        $tasks = Order::whereHas('tasks', function ($q) use ($user) {
            $q->where('user_id', $user->id)
              ;
        })->where('status', 'Đang thực hiện')->get();


        $completes = Order::whereHas('tasks', function ($q) use ($user) {
            $q->where('user_id', $user->id)
              ;
        })->where('status', 'Hoàn thành')->get();
        return view('task',compact('orders','tasks','completes'));
    }
    public function receiveOrder($id){
        $user=Auth::user();
        if($user->level!='reviewer'){
            return view('index');
        }
        $order=Order::find($id);
        if($order==null){
            return redirect()->route('getTask')->with('error','Không tìm thấy đơn hàng này');
        }
        OrderTask::create([
            'order_id' => $id,
            'user_id' => $user->id,
        ]);
        $order->status='Đang thực hiện';
        $order->save();
        return redirect()->route('getTask')->with('success','Nhận đơn hàng thành công');
    }
    public function report($id){
        return view('report', compact('id'));
    }
    public function reportOrder($id){
        $user=Auth::user();
        if($user->level!='reviewer'){
            return view('index');
        }
        $order=Order::find($id);
        if($order==null){
            return redirect()->route('getTask')->with('error','Không tìm thấy đơn hàng này');
        }
        $order->status='Đã báo cáo';
        $order->save();
        return redirect()->route('getTask')->with('success','Báo cáo đơn hàng thành công');
    }
}
