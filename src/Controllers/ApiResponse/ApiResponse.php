<?php

namespace Mrba\LaraHper\Controllers\ApiResponse;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    protected $statusCode = Response::HTTP_OK;
    protected $errorCode = APIErrorCode::Ok;
    protected $headers = [];
    protected $errorMsg = 'ok';

    protected function setStatus($InStatus)
    {
        $this->statusCode = $InStatus;
        return $this;
    }

    protected function setErrorCode($InErrorCode)
    {
        $this->errorCode = $InErrorCode;
        $this->errorMsg = APIErrorCode::$statusTexts[$InErrorCode];
        return $this;
    }

    protected function responseError($errCode, $tips = null)
    {
        return $this->setErrorCode($errCode)
            ->responseJson(isset($tips) ? $tips : APIErrorCode::$statusTexts[$errCode]);
    }

    protected function responseJson($data)
    {
        return response()->json($this->assembleJsonData($data), $this->statusCode);
    }

    protected function assembleJsonData($InData)
    {
        return [
            'result' => $InData,
            'errorcode' => $this->errorCode,
            'errormsg' => $this->errorMsg,
        ];
    }
}
