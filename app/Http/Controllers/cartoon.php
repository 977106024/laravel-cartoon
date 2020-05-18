<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cartoonModel;


use GuzzleHttp\Client;


class cartoon extends Controller
{
    public function getCartoon(){
        // phpinfo();
        // $model = new cartoonModel();
        
        // $model -> name = '毛小月';
        // $model -> photo = 'imgxxxx';
        // $model -> cartoon = 'img2222';
        // // $model -> created_at = '121323124';

        // $res = $model -> save();
        // // echo 'xxx成功？';
        // dd($res);
        
        $http = new Client(['verify' => false ]);
        $response = $http -> get('https://aip.baidubce.com/oauth/2.0/token',[
            'query' => [
                'grant_type' => 'client_credentials',
                'client_id' => 'f17IpDaOaBrKhSU1X4KEAIlT',
                'client_secret'=>'nEP7ix9bKMxGd23LmGW482sVXQY80G2a',
            ]
        ]);
        $a = json_decode($response->getBody()->getContents(), true);
        $access_token = $a['access_token'];
    }
    
}
