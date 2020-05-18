<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cartoonModel;

class cartoon extends Controller
{
    public function getCartoon(){
        $model = new cartoonModel();
        
        $model -> name = '毛小月';
        $model -> photo = 'imgxxxx';
        $model -> cartoon = 'img2222';
        // $model -> created_at = '121323124';

        $res = $model -> save();
        // echo 'xxx成功？';
        dd($res);
    }
    
}
