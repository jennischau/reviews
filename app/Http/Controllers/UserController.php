<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users=User::get();
        return view('admin.user.index', compact('users'));
    }
    public function updateLevel($id, Request $request){
        $user=User::find($id);
        if($user==null){
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng này');
        }
        $user->level=$request->level;
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'Cập nhật cấp bậc thành công');
    }
}
