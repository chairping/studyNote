<?php
 // 获取图片大小
        list($width, $height, $type, $attr) = getimagesize('/var/www/html/cp/public/1.jpeg');
        var_dump( getimagesize('/var/www/html/cp/public/1.jpeg'));
//          0 => int 180
//          1 => int 180
//          2 => int 2
//          3 => string 'width="180" height="180"' (length=24)
//          'bits' => int 8
//          'channels' => int 3
//          'mime' => string 'image/jpeg' (length=10)  图片类型
//        1 = GIF，
//        2 = JPG，
//        3 = PNG，
//        4 = SWF，
//        5 = PSD，
//        6 = BMP，
//        7 = TIFF(intel byte order)，
//        8 = TIFF(motorola byte order)，
//        9 = JPC，
//        10 = JP2，
//        11 = JPX，
//        12 = JB2，
//        13 = SWC，
//        14 = IFF，
//        15 = WBMP，
//        16 = XBM。

// 以字符串格式打开
        $data       = file_get_contents('/var/www/html/cp/public/1.jpeg');
        $size_info2 = getimagesizefromstring($data);
        var_dump($size_info2);

define ('IMAGETYPE_GIF', 1);
define ('IMAGETYPE_JPEG', 2);
define ('IMAGETYPE_PNG', 3);
define ('IMAGETYPE_SWF', 4);
define ('IMAGETYPE_PSD', 5);
define ('IMAGETYPE_BMP', 6);
define ('IMAGETYPE_TIFF_II', 7);
define ('IMAGETYPE_TIFF_MM', 8);
define ('IMAGETYPE_JPC', 9);
define ('IMAGETYPE_JP2', 10);
define ('IMAGETYPE_JPX', 11);
define ('IMAGETYPE_JB2', 12);
define ('IMAGETYPE_SWC', 13);
define ('IMAGETYPE_IFF', 14);
define ('IMAGETYPE_WBMP', 15);
define ('IMAGETYPE_JPEG2000', 9);
define ('IMAGETYPE_XBM', 16);
define ('IMAGETYPE_ICO', 17);
define ('IMAGETYPE_UNKNOWN', 0);
define ('IMAGETYPE_COUNT', 18);

        var_dump(image_type_to_extension(IMAGETYPE_PNG)); // get pic name  etc. .png
        // http://php.net/manual/zh/function.image-type-to-mime-type.php
        // header("Content-type: " . image_type_to_mime_type(IMAGETYPE_PNG));