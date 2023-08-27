<?php

class Image
{

    public function crop_image($upload_file, $suitable_width, $suitable_height)
    {
        $upload_image = imagecreatefromjpeg($upload_file);

        $upload_width = imagesx($upload_image);
        $upload_height = imagesy($upload_image);

        $ratio = $suitable_height / $upload_height;
        $new_height = $suitable_height;
        $new_width = $ratio * $upload_width;

        if ($upload_height > $upload_width) {
            $ratio = $suitable_width / $upload_width;
            $new_width = $suitable_width;
            $new_height = $ratio * $upload_height;
        }

        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $upload_image, 0, 0, 0, 0, $new_width, $new_height, $upload_width, $upload_height);
       
        imagedestroy($upload_image);

        // 如果图片不合适就裁剪
        $diff = $new_width - $new_height;
        $y = 0;
        $x = round($diff / 2);
        if ($new_height > $new_width) {
            $diff = ($new_height - $new_width);
            $y = round($diff / 2);
            $x = 0;
        }
        $new_cropped_image = imagecreatetruecolor($suitable_width, $suitable_height);
        imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $suitable_width, $suitable_height, $suitable_width, $suitable_height);
        imagedestroy($new_image);

        // 把新创建的满足规则的图片存放到原来的上传路径
        imagejpeg($new_cropped_image, $upload_file, 90);
        imagedestroy($new_cropped_image);
    }
}
