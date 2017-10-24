<?php

namespace App\Http\Controllers;

// https://packagist.org/packages/feicanfly/alisms-for-laravel

use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Core\DefaultAcsClient;
use zgldh\QiniuStorage\QiniuStorage;

class UserController extends Controller
{
    //
    public function index() {
        $disk = QiniuStorage::disk('qiniu');
        return response()->json(\GuzzleHttp\json_encode(
            array(
                'url' =>  $disk->privateDownloadUrl('ph.png')
    )
        ));
    }

    public function show($id, DefaultAcsClient $defaultAcsClient) {
        $request = new SendSmsRequest();
        $request->setPhoneNumbers($id);
        $request->setSignName('null小组');
        $request->setTemplateCode('SMS_103845017');
        $request->setTemplateParam(\GuzzleHttp\json_encode(array(
            'code' => '233333'
        )));
        $response = $defaultAcsClient->getAcsResponse($request);
        if($response->getName())
        return response()->json(
            $response
        );
    }



}
