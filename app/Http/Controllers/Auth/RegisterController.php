<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class RegisterController extends Controller
{
//    /*
//    |--------------------------------------------------------------------------
//    | Register Controller
//    |--------------------------------------------------------------------------
//    |
//    | This controller handles the registration of new users as well as their
//    | validation and creation. By default this controller uses a trait to
//    | provide this functionality without requiring any additional code.
//    |
//    */
//
//    use RegistersUsers;
//
//    /**
//     * Where to redirect users after registration.
//     *
//     * @var string
//     */
//    protected $redirectTo = '/home';
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }
//
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required',
            'password' => 'required',
            'code' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){

    }

    protected function store(Request $request) {
        $input = $request->all();
        if($this->validator($input)->fails()) {
            return response()->json([
                'message' => '参数错误'
            ]);
        }

        $key = $request->cookie('phoneCode');
        if(!$key) {
            return response()->json([
                'message' => '你还没有获取过验证码'
            ], 404);
        }

        $code = DB::table('cache')->where([
            'key' => $key,
        ])->value('value');

        // todo 时间验证

        if($code != $input['code']) {
            return response()->json([
                'message' => 'code错误',
                'key' => $key
            ], 400);
        }

        DB::table('user')->insert(
            [
                'phone' => $input['phone'],
                'password' =>  $input['password'],
                'username' => 'name'
            ]
        );

        return response()->json([
            'message' => 'ok~'
        ], 201);

    }
}
