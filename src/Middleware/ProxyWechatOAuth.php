<?php

namespace Mrba\LaraHper\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProxyWechatOAuth
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
        if ($request->has('openid')) {
            return $next($request);
        }

        $redirectUrl = config('larahper.wechat_oauth_proxy') . '?redirect=' . $request->fullUrl();
        return redirect()->to($redirectUrl);
    }
}
