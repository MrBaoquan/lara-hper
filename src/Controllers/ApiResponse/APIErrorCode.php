<?php

namespace Mrba\LaraHper\Controllers\ApiResponse;

class APIErrorCode
{
    const Failed = -1; // 请求失败 服务器忙
    const Ok = 0; // 请求成功
    const LoginFailed = 10001; // 登录失败 用户名或密码错误
    const InvalidForm = 10002; // 表单数据验证失败
    const PermissionDenied = 10003; // 无权访问
    const NoContent = 10004; // 没有内容
    const InvalidParams = 10005;
    const ExpiredRequest = 10006; // 请求已过期
    const NoPermission = 10007; // 无权访问
    const CountLimit = 10008; // 数量限制
    const InvalidRequest = 10010;
    const LicenseExpired = 10011; // 许可证已过期

    const ServerError = 10100; // 服务器错误

    public static $statusTexts = [
        -1 => "server is busy now.",
        0 => "ok",
        10001 => "login failed, username or password not correct",
        10002 => 'form data validate failed',
        10003 => 'access no permission',
        10004 => 'get no results',
        10005 => 'invalid params',
        10006 => 'expired',
        10007 => 'no permission',
        10008 => 'count limit',
        10010 => 'not a valid application logic request',
        10011 => 'license has expired',

        10100 => 'server error',
    ];
}
