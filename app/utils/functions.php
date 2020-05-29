<?php
/**
	* 图片转base64
	* @param ImageFile String 图片路径
	* @return 转为base64的图片
	*/

    function Base64EncodeImage($ImageFile) {
        if(file_exists($ImageFile) || is_file($ImageFile)){
            $base64_image = '';
            $image_info = getimagesize($ImageFile);
            $image_data = fread(fopen($ImageFile, 'r'), filesize($ImageFile));
            $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
            return $base64_image;
        }
        else{
            return false;
        }
    }


    /*  base64格式编码转换为图片并保存对应文件夹 */
function base64_image_content($base64_image_content,$path){
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $new_file = $path."/".date('Ymd',time())."/";
        if(!file_exists($new_file)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700);
        }
        $new_file = $new_file.time().".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            return '/'.$new_file;
        }else{
            return false;
        }
    }else{
        return false;
    }
}