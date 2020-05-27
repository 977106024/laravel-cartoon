<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cartoonModel;


use GuzzleHttp\Client;
// require './../public/base64Test.php';

class cartoon extends Controller
{
    public function getCartoon(Request $request) {
      $file = $request->file("photo"); //文件

      //文件是否正常
      if($file && $file -> isValid()){

        $extension = $file -> getClientOriginalExtension(); //获取上传图片的后缀名
        $newImagesName = md5(time()).rand(100000,99999).".".$extension; //重新命名上传文件名字
        $file -> move("upload",$newImagesName); //移动文件
        $base64Img = Base64EncodeImage('upload/'.$newImagesName);
        $base64Incomplete = str_replace('data:image/jpeg;base64,','',$base64Img);
        

        //百度AI
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
        
        
       

        //cartoon 请求百度AI 处理图片
        $imgRes = $http -> post('https://aip.baidubce.com/rest/2.0/image-process/v1/selfie_anime',[
            'form_params' => [
                'access_token' => $access_token,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'image' => $base64Incomplete
            ]
        ]);
        $b = json_decode($imgRes->getBody()->getContents(), true);        
        return  $b;
        
      }else{
        return ['文件错误！'];
      };
      
    
            
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
