<?php

use Illuminate\Support\Facades\Route;
use Mrba\LaraHper\Controllers\AuthController;
use Mrba\LaraHper\Controllers\UserController;
use Mrba\LaraHper\Controllers\WXController;

Route::get('/clearsession', function () {
    session()->forget('wechat.oauth_user.default');
});

Route::get('/larahper', function () {
    return 'larahper-env';
});

// 开启微信oauth授权登录代理
Route::group(['middleware' => ['web',
    config('larahper.wechat_mock') ? 'wechat.mock' : 'wechat.oauth:default,snsapi_userinfo',
]], function () {
    Route::any('/auth/wxmp', [AuthController::class, 'wechat']);
});

// 使用微信授权登录代理 获取网页授权用户信息
Route::any('/proxy/auth/wxmp', [AuthController::class, 'ProxyAuthWechat'])
    ->middleware('proxy.wechat.oauth');

Route::post('api/login', [AuthController::class, 'login']);

/**
 * 帐号注册
 */
Route::post('api/register', [AuthController::class, 'register']);

Route::group(['prefix' => 'api', 'middleware' => ['api', 'auth:larahper']], function () {
    Route::any('/wx/jssdk', [WXController::class, 'JSSDK']);

    // example: 当前已认证用户信息
    Route::get('/auth/user', [UserController::class, 'userinfo']);
    Route::post('/auth/user', [UserController::class, 'updateUserInfo']);
});
