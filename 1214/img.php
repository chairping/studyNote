<?php


<?php

// �����հ�ͼ�����һЩ�ı�
//$im = imagecreatetruecolor(1200, 120);
//$text_color = imagecolorallocate($im, 233, 14, 91);
//imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);
//
//// �����������ͱ�ͷ ���� ����������� image/jpeg
//header('Content-Type: image/jpeg');
//
//// ���ͼ��
//imagejpeg($im);
//
//// �ͷ��ڴ�
//imagedestroy($im);


//if(!is_file($imgname)) throw new Exception('�����ڵ�ͼ���ļ�');
//
//$info = getimagesize($imgname);
//$type = image_type_to_extension($info[2], false);
////var_dump($info);
//$img = imagecreatefromjpeg($imgname);
//
//header("Content-type: {$info[2]}");
//
//$percent = 0.5;
//list($width, $height) = $info;
//
//$new_width = $width * $percent;
//$new_height = $height * $percent;
//// ����ȡ��
//$image_p = imagecreatetruecolor($new_width, $new_height);
//$image = imagecreatefromjpeg($imgname);
//imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//
//imagejpeg($image_p, null, 100);
//
//imagedestroy($img); //����ԭͼ
//imagedestroy($image_p); //����ԭͼ

header("Content-type: image/jpeg");

////原始图像
//$dst = "images/flower_1.jpg";
$dst = './1.jpg';
//
////得到原始图片信息
$dst_im = imagecreatefromjpeg($dst);
//$dst_info = getimagesize($dst);
//
////水印图像
//$src = "./logo_video.gif";
//$src_im = imagecreatefromgif($src);
//$src_info = getimagesize($src);
//
////水印透明度
//$alpha = 50;
//
////合并水印图片
//imagecopymerge($dst_im, $src_im, $dst_info[0] - $src_info[0], $dst_info[1] - $src_info[1], 0, 0, $src_info[0], $src_info[1], $alpha);
//
////输出合并后水印图片
//imagejpeg($dst_im);
//imagedestroy($dst_im);
//imagedestroy($src_im);

/** 圆角
$radius  = 100;
$img     = imagecreatetruecolor($radius, $radius);  // 创建一个正方形的图像
$bgcolor    = imagecolorallocate($img, 223, 0, 0);   // 图像的背景
$fgcolor    = imagecolorallocate($img, 0, 0, 0);
imagefill($img, 0, 0, $bgcolor);
// $radius,$radius：以图像的右下角开始画弧
// $radius*2, $radius*2：已宽度、高度画弧
// 180, 270：指定了角度的起始和结束点
// fgcolor：指定颜色
imagefilledarc($img, $radius, $radius, $radius*2, $radius*2, 180, 270, $fgcolor, IMG_ARC_PIE);
// 将弧角图片的颜色设置为透明
imagecolortransparent($img, $fgcolor);
// 变换角度
// $img = imagerotate($img, 90, 0);
// $img = imagerotate($img, 180, 0);
// $img = imagerotate($img, 270, 0);
header('Content-Type: image/png');
imagepng($img);
 **/

function get_lt_rounder_corner($radius) {
    $img     = imagecreatetruecolor($radius, $radius);  // 创建一个正方形的图像

    $bgcolor    = imagecolorallocate($img, 1, 2, 3);   // 图像的背景
    $fgcolor    = imagecolorallocate($img, 0, 0, 0);
    imagefill($img, 0, 0, $bgcolor);
    // $radius,$radius：以图像的右下角开始画弧
    // $radius*2, $radius*2：已宽度、高度画弧
    // 180, 270：指定了角度的起始和结束点
    // fgcolor：指定颜色
    imagefilledarc($img, $radius, $radius, $radius*2, $radius*2, 180, 270, $fgcolor, IMG_ARC_PIE);
    // 将弧角图片的颜色设置为透明
    imagecolortransparent($img, $fgcolor);

    // 变换角度
    // $img = imagerotate($img, 90, 0);
    // $img = imagerotate($img, 180, 0);
    // $img = imagerotate($img, 270, 0);
    // header('Content-Type: image/png');
    // imagepng($img);
    return $img;
}

$image_width    = 300;
$image_height   = 300;
$resource    = imagecreatetruecolor($image_width, $image_height);   // 创建一个正方形的图像
$bgcolor     = imagecolorallocate($resource, 223, 223, 0);          // 图像的背景
imagefill($resource, 0, 0, $bgcolor);


$dst = './1.jpg';
//
////得到原始图片信息
$resource = imagecreatefromjpeg($dst);
$dst_info = getimagesize($dst);

$image_width    = $dst_info[0];
$image_height   = $dst_info[1];

// 圆角处理
$radius  = 90;
// lt(左上角)
$lt_corner  = get_lt_rounder_corner($radius);
imagecopymerge($resource, $lt_corner, 0, 0, 0, 0, $radius, $radius, 100);
// lb(左下角)
$lb_corner  = imagerotate($lt_corner, 90, 0);
imagecopymerge($resource, $lb_corner, 0, $image_height - $radius, 0, 0, $radius, $radius, 100);
// rb(右上角)
$rb_corner  = imagerotate($lt_corner, 180, 0);
imagecopymerge($resource, $rb_corner, $image_width - $radius, $image_height - $radius, 0, 0, $radius, $radius, 100);
// rt(右下角)
$rt_corner  = imagerotate($lt_corner, 270, 0);
imagecopymerge($resource, $rt_corner, $image_width - $radius, 0, 0, 0, $radius, $radius, 100);


header('Content-Type: image/png');

imagecopymerge($dst_im, $resource, 0, 0 - 0, 0, 0, $image_width, $image_height, 100);
// 指定颜色通道 使之透明
$bgcolor    = imagecolorallocate($lt_corner, 1, 2, 3);
imagecolortransparent($dst_im, $bgcolor);





////原始图像
//$dst = "images/flower_1.jpg";
$dst = './body_bg.jpg';
//
////得到原始图片信息
$dstIm = imagecreatefromjpeg($dst);
$dst_info = getimagesize($dst);


//水印透明度
$alpha = 100;
//$image_width    = $dst_info[0];
//$image_height   = $dst_info[1];
//合并水印图片
imagecopymerge($dstIm, $dst_im, $dst_info[0] - $image_width, $dst_info[1] - $image_height, 0, 0, $image_width, $image_height, $alpha);

//输出合并后水印图片
imagejpeg($dstIm);
imagedestroy($dstIm);
imagedestroy($dst_im);






//imagepng($dst_im);

exit;



