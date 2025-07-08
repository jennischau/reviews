<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VnPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = env('VNPAY_RETURNURL');
        $vnp_TmnCode = env('VNPAY_TMNCODE');
        $vnp_HashSecret = env('VNPAY_HASHSECRET');

        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Nạp tiền cho tài khoản: '. Auth::user()->name;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->amount* 100;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
        'code' => '00',
        'message' => 'success',
        'data' => $vnp_Url
        );
        return redirect()->to($vnp_Url);
    }


    public function handleReturn(Request $request)
    {
        $inputData = $request->all();
        $vnp_HashSecret = env('VNPAY_HASHSECRET');

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHashCheck = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHashCheck === $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                // Thành công
                $amount = $request->vnp_Amount / 100;

                if (Auth::check()) {
                    $user = Auth::user();


                    Transaction::create([
                        'transaction_code' => strtoupper('DEP' . now()->format('dmY') . '-' . Str::random(6)),
                        'balance_before' => $user->balance,
                        'amount' => $amount,
                        'balance_after' => $user->balance + $amount,
                        'description' => "Nạp tiền cho tài khoản: ". $user->name,
                        'user_id' => $user->id
                    ]);

                    $user->balance += $amount;
                    $user->total_deposit += $amount;
                    $user->save();
                }

                // Có thể lưu transaction vào bảng deposites ở đây nếu cần

                return redirect()->route('profile')->with('success', 'Nạp tiền thành công');
            } else {
                return redirect()->route('profile')->with('error', 'Giao dịch không thành công');
            }
        } else {
            return redirect()->route('profile')->with('error', 'Chữ ký không hợp lệ');
        }
    }

}
