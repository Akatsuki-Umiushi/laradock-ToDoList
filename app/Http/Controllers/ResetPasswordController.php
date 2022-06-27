<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers

class ResetPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        // メールアドレスとトークンを返却する
        $result = [
            'email' => $request->email,
            'token' => $request->token
        ];
        return response()->json($result);
    }
}