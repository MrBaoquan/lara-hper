<?php

namespace Mrba\LaraHper\Controllers;

use Illuminate\Http\Request;
use Mrba\LaraHper\Facades\LaraHper;

class UserController extends APIController
{
    // 当前用户信息
    public function userinfo()
    {
        $user = LaraHper::user();
        return $this->responseJson($user);
    }

    public function updateUserInfo(Request $request)
    {
        // $input = $request->only('name', 'nick_name');
        // Auth::user()->update($input);
        // return $this->responseJson(new ResourcesUser(Auth::user()));
    }
}
