<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Mail\AmazonSes;
use Auth;
use DB;

use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    public function pwdChangeMail(Reqeust $request) {
        $data = 'dd1';
        Mail::to('wlgns4706@naver.com')->send(new AmazonSes($data));
    }

}