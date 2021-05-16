<?php

namespace Mrba\LaraHper\Controllers;

use Illuminate\Http\Request;
use Mrba\LaraHper\Controllers\ApiResponse\APIErrorCode;

class WXController extends APIController
{
    public function JSSDK(Request $request)
    {
        $url = $request->input('url');
        $app = app('wechat.official_account');
        if (!isset($url)) {
            return $this->responseError(APIErrorCode::InvalidParams);
        }
        $app->jssdk->setUrl($url);
        return $this->responseJson($app->jssdk->buildConfig(['scanQRCode'], false, false, false));
    }
}
