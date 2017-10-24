<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;
//
//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//    protected $redirectTo = '/porfile';
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required',
            'password' => 'required',
        ]);
    }

    public function store(Request $request) {

        $input = $request->all();
        if($this->validator($input)->fails()) {
            return response()->json([
                'message' => '参数错误'
            ], 400);
        }

        $res = DB::table('user')->where([
            'phone' => $input['phone'],
            'password' => $input['password']
        ])->first();

        if(!$res) {
            return response()->json([
                'message' => '不存在或者密码错误'
            ], 400);
        }

        $cookie = Uuid::uuid4()->getHex();
        DB::table('user')->where([
            'phone' => $input['phone']
        ])->update([
            'cookie' => $cookie
        ]);

        return response()->json(
            [
                'message' => 'ok~'
            ], 201
        )->cookie(Cookie('nullc', $cookie, 60 * 24 * 30));
    }
}
