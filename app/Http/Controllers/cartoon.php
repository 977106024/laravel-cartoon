<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cartoonModel;


use GuzzleHttp\Client;


class cartoon extends Controller
{
    public function getCartoon(Request $request) {
        $params = $request -> all();

        //百度AI
        $http = new Client(['verify' => false ]); //client对象发请求
        //get access_token
        // $response = $http -> get('https://aip.baidubce.com/oauth/2.0/token',[
        //     'query' => [
        //         'grant_type' => 'client_credentials',
        //         'client_id' => 'f17IpDaOaBrKhSU1X4KEAIlT',
        //         'client_secret'=>'',
        //     ]
        // ]);
        // $a = json_decode($response->getBody()->getContents(), true);
        // $access_token = $a['access_token'];
        $access_token = '24.48ab942facbffd0bb7c6702f81bc2d79.2592000.1593316517.282335-19902100';
        
          
        //cartoon 请求百度AI 处理图片
        $imgRes = $http -> post('https://aip.baidubce.com/rest/2.0/image-process/v1/selfie_anime',[
            'form_params' => [
                'access_token' => $access_token,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'image' => $params['imgUrl'], //base64图片
                'mask_id' => $params['mask_id'], //口罩数字
                'type' => $params['type'] //是否戴口罩
            ]
        ]);
        $b = json_decode($imgRes->getBody()->getContents(), true);        
        return  $b;
      
      
    
            
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

    public function upload (Request $request){
      $file = $request->file("photo"); //文件

      //文件是否正常
      if($file && $file -> isValid()){

        $extension = $file -> getClientOriginalExtension(); //获取上传图片的后缀名
        $newImagesName = md5(time()).rand(100000,99999).".".$extension; //重新命名上传文件名字
        $file -> move("upload",$newImagesName); //移动文件

       
        //图片转base64
        $base64Img = Base64EncodeImage('upload/'.$newImagesName);
        
        //去掉base64头部
        $base64Incomplete = str_replace('data:image/jpeg;base64,','',$base64Img);

        return [$base64Incomplete];

        //把图片存到服务器 图片域名文件夹下

        //把图片在线地址存到数据库


        return [true];
      }else{
        return ['文件错误！'];
      };
    }
    
}
