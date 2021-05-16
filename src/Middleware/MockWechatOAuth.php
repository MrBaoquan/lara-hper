<?php

namespace Mrba\LaraHper\Middleware;

use Closure;
use Illuminate\Http\Request;
use Overtrue\Socialite\User;

class MockWechatOAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = new User([
            "raw" => [
                'openid' => 'testopenid',
                'name' => 'testname',
                'nickname' => 'testnickname',
                'headimgurl' => 'testavatar',
                'email' => null,
                'sex' => 1,
                'country' => '中国',
                'province' => '安徽',
                'city' => '合肥',
            ],

        ]);
        session(['wechat.oauth_user.default' => $user]);
        return $next($request);
    }
}
