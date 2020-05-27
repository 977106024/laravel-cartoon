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