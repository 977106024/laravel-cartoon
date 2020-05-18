<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cartoonModel;


use GuzzleHttp\Client;
// require './../public/base64Test.php';

class cartoon extends Controller
{
    public function getCartoon(Request $request){
        //请求参数
        $params = $request -> all();
        

        $http = new Client(['verify' => false ]);
        //get access_token
        $response = $http -> get('https://aip.baidubce.com/oauth/2.0/token',[
            'query' => [
                'grant_type' => 'client_credentials',
                'client_id' => 'f17IpDaOaBrKhSU1X4KEAIlT',
                'client_secret'=>'nEP7ix9bKMxGd23LmGW482sVXQY80G2a',
            ]
        ]);
        $a = json_decode($response->getBody()->getContents(), true);
        $access_token = $a['access_token'];
        // dd($access_token);
        
        //cartoon 请求百度AI 处理图片
        $imgRes = $http -> post('https://aip.baidubce.com/rest/2.0/image-process/v1/selfie_anime',[
            'form_params' => [
                'access_token' => $access_token,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'image' =>  $params['image']
            ]
        ]);
        $b = json_decode($imgRes->getBody()->getContents(), true);        
        dd($b);
            
          // 存入数据库
        // $model = new cartoonModel();
        
        // $model -> name = '毛小月';
        // $model -> photo = 'imgxxxx';
        // $model -> cartoon = 'img2222';
        // // $model -> created_at = '121323124';

        // $res = $model -> save();
        // // echo 'xxx成功？';
        // dd($res);
    }
    
}
