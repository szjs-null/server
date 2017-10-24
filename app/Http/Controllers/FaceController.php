<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//require_once dirname(dirname(__FILE__)).'/../../lib/baiduFaceSdk/AipFace.php';

class FaceController extends Controller
{
    //
    public function store(Request $request) {
//        if($request->hasFile('photo')) {
//            $apiFace = new AipFace(
//                env('BAIDU_FACE_APPID'),
//                env('BAIDU_FACE_KEY'),
//                env('BAIDU_FACE_SECRETKEY')
//            );
//            return response()->json(
//                $apiFace->detect(file_get_contents(), [
//                  'max_face_num' => 50,
//                ])
//            );
//        } else {
//            return response()->json(
//                array(
//                    'code' => '',
//                    'doc' => 'https://.....'
//                )
//            );
//        }
    }
    public function index() {
        $apiFace = new \ApiFace(
            env('BAIDU_FACE_APPID'),
            env('BAIDU_FACE_KEY'),
            env('BAIDU_FACE_SECRETKEY')
        );
        $file = file_get_contents('C:\\Users\\haozi\\Desktop\\pic\\IMG_20170526_143958_HDR.jpg');
        if($file)
            return response()->json(
//                $apiFace->verifyUser('1', 'A1', $file)
//                $apiFace->addUser('1', '666', 'A1', $file)
                $apiFace->detect($file, [
                    'max_face_num' => 20
                ])
            );
        return response()->json([
          'file' => 'notexist'
        ]);
    }
}
