<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class SessionController extends Controller
{
    //
    public function index() {
        return response()->json([
            'file' => 'notexist'
        ]);
    }

    public function create() {
        return response()->json([
            'file' => 'notexist'
        ]);
    }

    public function destroy(Request $request) {
        return response()->json([
            'file' => 'notexist'
        ]);
    }

    public function store(Request $request) {
        $input = $request->all();
        if($this->validatorLogin($input)) {
            if (Auth::attempt($input)) {
                return  response()->json([
                    'file' => 'ok~'
                ]);
            }
        }
        return response()->json([
            'file' => 'notexist'
        ]);
    }

    protected function validatorLogin(array $data){
        return Validator::make($data, [
            'phone' => [
                'required|alpha_num',
                Rule::dimensions()->width(11)
            ],
            'password' => 'required|string|min:6',
        ]);
    }
}
