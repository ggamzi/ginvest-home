<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     *  ID, 닉네임 중복 검사
     *  @param string $type : account, nickname
     *  @param string $val  : value
     */
    public function dupChk(Request $request) {
        $type = $request->input("type");
        $value = $request->input("val");

        $res = User::where($type,$value)->count();
       
        return response(["status"=>"success","data"=>$res],200);
    }

    public function create(Request $request)
    {
        $phone = $request->input('hp1').$request->input('hp2').$request->input('hp3');

        return User::create([
            'nickname' => $request->input('nickname'),
            'account' => $request->input('account'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $phone
        ]);
    }
}
