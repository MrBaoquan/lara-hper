<?php

namespace Mrba\LaraHper\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mrba\LaraHper\Controllers\ApiResponse\APIErrorCode;
use Mrba\LaraHper\Models\WXUser as User;

class AuthController extends APIController
{
    public function login(Request $request)
    {
        $openid = $request->input('openid');
        $user = User::where('openid', $openid)->first();
        if (!isset($user)) {
            $user = User::create([
                'name' => $openid,
                'email' => $openid . '@default.com',
                'password' => Hash::make($openid),
                'openid' => $openid,
            ]);
        }
        return $this->responseJson([
            'access_token' => $this->createToken($user)->plainTextToken,
        ]);
    }

    /**
     * 用户注册接口
     */
    public function register(Request $request)
    {
        $inputs = $request->only('username', 'email', 'phone', 'password', 'name', 'openid', 'country', 'province', 'city', 'avatar_url');

        $validator = $this->checkUserInfo($inputs);
        if ($validator->fails()) {
            return $this->responseError(APIErrorCode::InvalidParams, $validator->failed());
        }

        return $this->responseJson($this->createUser($inputs));
    }

    /**
     * 微信授权路由
     */
    public function wechat(Request $request)
    {
        $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
        $userInfo = Arr::except($user['raw'], 'privilege');
        $redirectUrl = $request->input('redirect');
        parse_str(Arr::get(parse_url($redirectUrl), 'query', ''), $queries);
        $redirectUrl = (explode('?', $redirectUrl))[0] . '?' . http_build_query(array_merge($queries, $userInfo));
        return redirect()->to($redirectUrl);
    }

    /**
     * 微信授权路由代理  用于传回token给SPA应用
     */
    public function ProxyAuthWechat(Request $request)
    {
        $input = $request->all();
        $openid = Arr::get($input, 'openid');
        $user = config('larahper.database.users_model')::where('openid', Arr::get($input, 'openid'))->first();
        $appUrl = $request->query('redirect');
        if (!isset($appUrl)) {
            return $this->responseError(APIErrorCode::InvalidParams);
        }

        if (!isset($user)) {
            Arr::set($input, 'avatar_url', Arr::get($input, 'headimageurl'));
            Arr::set($input, 'email', $openid . '@example.com');
            Arr::set($input, 'name', Arr::get($input, 'nick_name'));
            $user = $this->createUser($input);
        }

        return redirect()
            ->to('http://' . $appUrl . '?access_token=' . $this->createToken($user)->plainTextToken);
    }

    private function createToken($user)
    {
        $user->tokens()->delete();
        return $user->createToken('auth');
    }

    /**
     * 验证用户表单字段
     */
    private function checkUserInfo($inputs)
    {
        $user_model = config('larahper.database.users_model');
        return Validator::make($inputs, [
            'email' => 'required|email|unique:' . $user_model,
            'username' => 'unique:' . $user_model,
            'phone' => 'min:11|unique:' . $user_model,
            'password' => 'required|min:6',
        ]);
    }

    /**
     * 创建用户到数据库
     */
    private function createUser($input)
    {
        $email = Arr::get($input, 'email');
        return config('larahper.database.users_model')::create([
            'name' => Arr::get($input, 'name', '新用户_' . Str::random('5')), // 用户昵称
            'username' => Arr::get($input, 'username', 'default_' . $email), // 用户名 用于登录
            'phone' => Arr::get($input, 'phone', $email), // 手机号 用于登录
            'email' => Arr::get($input, 'email'), // 用户邮箱 用于登录
            'password' => Hash::make(Arr::get($input, 'password', '123456')), // 帐号密码
            'openid' => Arr::get($input, 'openid', $email),
            'gender' => Arr::get($input, 'sex', 0),
            'avatar_url' => Arr::get($input, 'headimgurl'),
            'country' => Arr::get($input, 'country'),
            'province' => Arr::get($input, 'province'),
            'city' => Arr::get($input, 'city'),
        ]);
    }
}
