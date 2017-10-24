<?php

namespace App\Http\Controllers;

use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Core\DefaultAcsClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;
use Validator;
class CodeController extends Controller
{
    //
    public function store(Request $request, DefaultAcsClient $defaultAcsClient) {
        $input = $request->all();
        if($this->validatorLogin($input)->fails()) {
            return response()->json([
                'message' => '参数错误'
            ], 400);
        }
        $request = new SendSmsRequest();
        $request->setPhoneNumbers($input['phone']);
        $request->setSignName('null小组');
        $request->setTemplateCode('SMS_103845017');

        $code = ''.rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        $request->setTemplateParam(\GuzzleHttp\json_encode(array(
            'code' => $code
        )));
        $key = Uuid::uuid4()->getHex();
        DB::table('cache')->insert([
            'key' => $key,
            'value' => $code,
            'expire' => Carbon::now()->subMinutes(10)
        ]);
        $cookie = Cookie('phoneCode', $key, 10);
        $res = $defaultAcsClient->getAcsResponse($request);
            return response()->json(
                $res,
                201
            )->cookie($cookie);
    }

    protected function validatorLogin(array $data){
        return Validator::make($data, [
            'phone' => [
                'required',
            ]
        ]);
    }
}
