<?php

namespace Mrba\LaraHper\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Mrba\LaraHper\Controllers\ApiResponse\APIErrorCode;

class WXController extends APIController
{
    public function JSSDK(Request $request)
    {
        $input = $request->only('debug','url','jsApiList');
        
        $debug = Arr::get($input,'debug',false);
        $jsApiList = Arr::get($input,'jsApiList',[]);
        $url = Arr::get($input,'url');
        
        $app = app('wechat.official_account');
        if (!isset($url)) {
            return $this->responseError(APIErrorCode::InvalidParams,'单页应用, 不传url必然导致签名错误');
        }
        $app->jssdk->setUrl($url);
        return $this->responseJson($app->jssdk->buildConfig($jsApiList, $debug, false, false));
    }
}
