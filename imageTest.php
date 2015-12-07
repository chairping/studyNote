<?php

/* ������س������� */
define('THINKIMAGE_GD',      1); //��������ʶGD������
define('THINKIMAGE_IMAGICK', 2); //��������ʶimagick������

/* ����ͼ��س������� */
define('THINKIMAGE_THUMB_SCALING',   1); //��������ʶ����ͼ�ȱ�����������
define('THINKIMAGE_THUMB_FILLED',    2); //��������ʶ����ͼ���ź��������
define('THINKIMAGE_THUMB_CENTER',    3); //��������ʶ����ͼ���вü�����
define('THINKIMAGE_THUMB_NORTHWEST', 4); //��������ʶ����ͼ���Ͻǲü�����
define('THINKIMAGE_THUMB_SOUTHEAST', 5); //��������ʶ����ͼ���½ǲü�����
define('THINKIMAGE_THUMB_FIXED',     6); //��������ʶ����ͼ�̶��ߴ���������

/* ˮӡ��س������� */
define('THINKIMAGE_WATER_NORTHWEST', 1); //��������ʶ���Ͻ�ˮӡ
define('THINKIMAGE_WATER_NORTH',     2); //��������ʶ�Ͼ���ˮӡ
define('THINKIMAGE_WATER_NORTHEAST', 3); //��������ʶ���Ͻ�ˮӡ
define('THINKIMAGE_WATER_WEST',      4); //��������ʶ�����ˮӡ
define('THINKIMAGE_WATER_CENTER',    5); //��������ʶ����ˮӡ
define('THINKIMAGE_WATER_EAST',      6); //��������ʶ�Ҿ���ˮӡ
define('THINKIMAGE_WATER_SOUTHWEST', 7); //��������ʶ���½�ˮӡ
define('THINKIMAGE_WATER_SOUTH',     8); //��������ʶ�¾���ˮӡ
define('THINKIMAGE_WATER_SOUTHEAST', 9); //��������ʶ���½�ˮӡ

/**
 * ͼƬ���������࣬������ͼƬ�����
 * Ŀǰ֧��GD���imagick
 * @author ����� <zuojiazi.cn@gmail.com>
 */
class ThinkImage{

    /**
     * ͼƬ��Դ
     * @var resource
     */
    private $img;

    /**
     * ���췽��������ʵ����һ��ͼƬ�������
     * @param string $type Ҫʹ�õ���⣬Ĭ��ʹ��GD��
     */
    public function __construct($type = THINKIMAGE_GD, $imgname = null){

        /* �жϵ��ÿ������ */
        switch ($type) {
            case THINKIMAGE_GD:
                $class = 'ImageGd';
                break;
            default:
                throw new Exception('��֧�ֵ�ͼƬ���������');
        }

        /* ���봦��⣬ʵ����ͼƬ������� */
        require_once "Driver/{$class}.class.php";
        $this->img = new $class($imgname);

    }

    /**
     * ��һ��ͼ��
     * @param  string $imgname ͼƬ·��
     * @return Object          ��ǰͼƬ��������
     */
    public function open($imgname){

        $this->img->open($imgname);
        return $this;

    }

    /**
     * ����ͼƬ
     * @param  string  $imgname   ͼƬ��������
     * @param  string  $type      ͼƬ����
     * @param  boolean $interlace �Ƿ��JPEG����ͼƬ���ø���ɨ��
     * @return Object             ��ǰͼƬ��������
     */
    public function save($imgname, $type = null, $interlace = true){

        $this->img->save($imgname, $type, $interlace);
        return $this;

    }

    /**
     * ����ͼƬ���
     * @return integer ͼƬ���
     */
    public function width(){

        return $this->img->width();

    }

    /**
     * ����ͼƬ�߶�
     * @return integer ͼƬ�߶�
     */
    public function height(){

        return $this->img->height();

    }

    /**
     * ����ͼ������
     * @return string ͼƬ����
     */
    public function type(){

        return $this->img->type();

    }

    /**
     * ����ͼ��MIME����
     * @return string ͼ��MIME����
     */
    public function mime(){

        return $this->img->mime();

    }

    /**
     * ����ͼ��ߴ����� 0 - ͼƬ��ȣ�1 - ͼƬ�߶�
     * @return array ͼƬ�ߴ�
     */
    public function size(){

        return $this->img->size();

    }

    /**
     * �ü�ͼƬ
     * @param  integer $w      �ü�������
     * @param  integer $h      �ü�����߶�
     * @param  integer $x      �ü�����x����
     * @param  integer $y      �ü�����y����
     * @param  integer $width  ͼƬ������
     * @param  integer $height ͼƬ����߶�
     * @return Object          ��ǰͼƬ��������
     */
    public function crop($w, $h, $x = 0, $y = 0, $width = null, $height = null){

        $this->img->crop($w, $h, $x, $y, $width, $height);
        return $this;
    }

    /**
     * ��������ͼ
     * @param  integer $width  ����ͼ�����
     * @param  integer $height ����ͼ���߶�
     * @param  integer $type   ����ͼ�ü�����
     * @return Object          ��ǰͼƬ��������
     */
    public function thumb($width, $height, $type = THINKIMAGE_THUMB_SCALE){

        $this->img->thumb($width, $height, $type);
        return $this;
    }

    /**
     * ���ˮӡ
     * @param  string  $source ˮӡͼƬ·��
     * @param  integer $locate ˮӡλ��
     * @param  integer $alpha  ˮӡ͸����
     * @return Object          ��ǰͼƬ��������
     */
    public function water($source, $locate = THINKIMAGE_WATER_SOUTHEAST){

        $this->img->water($source, $locate);
        return $this;
    }

    /**
     * ͼ���������
     * @param  string  $text   ��ӵ�����
     * @param  string  $font   ����·��
     * @param  integer $size   �ֺ�
     * @param  string  $color  ������ɫ
     * @param  integer $locate ����д��λ��
     * @param  integer $offset ������Ե�ǰλ�õ�ƫ����
     * @param  integer $angle  ������б�Ƕ�
     * @return Object          ��ǰͼƬ��������
     */
    public function text($text, $font, $size, $color = '#00000000',
                         $locate = THINKIMAGE_WATER_SOUTHEAST, $offset = 0, $angle = 0){

        $this->img->text($text, $font, $size, $color, $locate, $offset, $angle);
        return $this;
    }
}

class ImageGd{

    /**
     * ͼ����Դ����
     * @var resource
     */
    private $img;

    /**
     * ͼ����Ϣ������width,height,type,mime,size
     * @var array
     */
    private $info;

    /**
     * ���췽���������ڴ�һ��ͼ��
     * @param string $imgname ͼ��·��
     */
    public function __construct($imgname = null) {

        $imgname && $this->open($imgname);

    }

    /**
     * ��һ��ͼ��
     * @param  string $imgname ͼ��·��
     */
    public function open($imgname){

        //���ͼ���ļ�
        if(!is_file($imgname)) throw new Exception('�����ڵ�ͼ���ļ�');

        //��ȡͼ����Ϣ
        $info = getimagesize($imgname);

        //���ͼ��Ϸ���
        if(false === $info || (IMAGETYPE_GIF === $info[2] && empty($info['bits']))){
            throw new Exception('�Ƿ�ͼ���ļ�');
        }

        //����ͼ����Ϣ
        $this->info = array(
            'width'  => $info[0],
            'height' => $info[1],
            'type'   => image_type_to_extension($info[2], false),
            'mime'   => $info['mime'],
        );

        //�����Ѵ��ڵ�ͼ��
        empty($this->img) || imagedestroy($this->img);

        //��ͼ��
        if('gif' == $this->info['type']){

            require_once 'GIF.class.php';
            $this->gif = new GIF($imgname);
            $this->img = imagecreatefromstring($this->gif->image());

        } else {
            $fun = "imagecreatefrom{$this->info['type']}";
            $this->img = $fun($imgname);
        }
    }

    /**
     * ����ͼ��
     * @param  string  $imgname   ͼ�񱣴�����
     * @param  string  $type      ͼ������
     * @param  boolean $interlace �Ƿ��JPEG����ͼ�����ø���ɨ��
     */
    public function save($imgname, $type = null, $interlace = true){

        if(empty($this->img)) throw new Exception('û�п��Ա������ͼ����Դ');

        //�Զ���ȡͼ������
        if(is_null($type)){
            $type = $this->info['type'];
        } else {
            $type = strtolower($type);
        }

        //JPEGͼ�����ø���ɨ��
        if('jpeg' == $type || 'jpg' == $type){
            $type = 'jpeg';
            imageinterlace($this->img, $interlace);
        }

        //����ͼ��
        if('gif' == $type && !empty($this->gif)){
            $this->gif->save($imgname);
        } else {
            $fun = "image{$type}";
            $fun($this->img, $imgname);
        }
    }

    /**
     * ����ͼ����
     * @return integer ͼ����
     */
    public function width(){
        if(empty($this->img)) throw new Exception('û��ָ��ͼ����Դ');
        return $this->info['width'];
    }

    /**
     * ����ͼ��߶�
     * @return integer ͼ��߶�
     */
    public function height(){
        if(empty($this->img)) throw new Exception('û��ָ��ͼ����Դ');
        return $this->info['height'];
    }

    /**
     * ����ͼ������
     * @return string ͼ������
     */
    public function type(){
        if(empty($this->img)) throw new Exception('û��ָ��ͼ����Դ');
        return $this->info['type'];
    }

    /**
     * ����ͼ��MIME����
     * @return string ͼ��MIME����
     */
    public function mime(){
        if(empty($this->img)) throw new Exception('û��ָ��ͼ����Դ');
        return $this->info['mime'];
    }

    /**
     * ����ͼ��ߴ����� 0 - ͼ���ȣ�1 - ͼ��߶�
     * @return array ͼ��ߴ�
     */
    public function size(){
        if(empty($this->img)) throw new Exception('û��ָ��ͼ����Դ');
        return array($this->info['width'], $this->info['height']);
    }

    /**
     * �ü�ͼ��
     * @param  integer $w      �ü�������
     * @param  integer $h      �ü�����߶�
     * @param  integer $x      �ü�����x����
     * @param  integer $y      �ü�����y����
     * @param  integer $width  ͼ�񱣴���
     * @param  integer $height ͼ�񱣴�߶�
     */
    public function crop($w, $h, $x = 0, $y = 0, $width = null, $height = null){

        if(empty($this->img)) throw new Exception('û�п��Ա��ü���ͼ����Դ');

        //���ñ���ߴ�
        empty($width)  && $width  = $w;
        empty($height) && $height = $h;

        do {
            //������ͼ��
            $img = imagecreatetruecolor($width, $height);
            // ����Ĭ����ɫ
            $color = imagecolorallocate($img, 255, 255, 255);
            imagefill($img, 0, 0, $color);

            //�ü�
            imagecopyresampled($img, $this->img, 0, 0, $x, $y, $width, $height, $w, $h);
            imagedestroy($this->img); //����ԭͼ

            //������ͼ��
            $this->img = $img;
        } while(!empty($this->gif) && $this->gifNext());
        $this->info['width']  = $width;
        $this->info['height'] = $height;
    }

    /**
     * ��������ͼ
     * @param  integer $width  ����ͼ�����
     * @param  integer $height ����ͼ���߶�
     * @param  integer $type   ����ͼ�ü�����
     */
    public function thumb($width, $height, $type = THINKIMAGE_THUMB_SCALE){

        if(empty($this->img)) throw new Exception('û�п��Ա����Ե�ͼ����Դ');

        //ԭͼ��Ⱥ͸߶�
        $w = $this->info['width'];
        $h = $this->info['height'];

        /* ��������ͼ���ɵı�Ҫ���� */
        switch ($type) {

            /* �ȱ������� */
            case THINKIMAGE_THUMB_SCALING:
                //ԭͼ�ߴ�С������ͼ�ߴ��򲻽�������
                if($w < $width && $h < $height) return;

                //�������ű���
                $scale = min($width/$w, $height/$h);

                //��������ͼ�����꼰��Ⱥ͸߶�
                $x = $y = 0;
                $width  = $w * $scale;
                $height = $h * $scale;
                break;

            /* ���вü� */
            case THINKIMAGE_THUMB_CENTER:
                //�������ű���
                $scale = max($width/$w, $height/$h);

                //��������ͼ�����꼰��Ⱥ͸߶�
                $w = $width/$scale;
                $h = $height/$scale;
                $x = ($this->info['width'] - $w)/2;
                $y = ($this->info['height'] - $h)/2;
                break;

            /* ���Ͻǲü� */
            case THINKIMAGE_THUMB_NORTHWEST:
                //�������ű���
                $scale = max($width/$w, $height/$h);

                //��������ͼ�����꼰��Ⱥ͸߶�
                $x = $y = 0;
                $w = $width/$scale;
                $h = $height/$scale;
                break;

            /* ���½ǲü� */
            case THINKIMAGE_THUMB_SOUTHEAST:
                //�������ű���
                $scale = max($width/$w, $height/$h);

                //��������ͼ�����꼰��Ⱥ͸߶�
                $w = $width/$scale;
                $h = $height/$scale;
                $x = $this->info['width'] - $w;
                $y = $this->info['height'] - $h;
                break;

            /* ��� */
            case THINKIMAGE_THUMB_FILLED:
                //�������ű���
                if($w < $width && $h < $height){
                    $scale = 1;
                } else {
                    $scale = min($width/$w, $height/$h);
                }

                //��������ͼ�����꼰��Ⱥ͸߶�
                $neww = $w * $scale;
                $newh = $h * $scale;
                $posx = ($width  - $w * $scale)/2;
                $posy = ($height - $h * $scale)/2;

                do{
                    //������ͼ��
                    $img = imagecreatetruecolor($width, $height);
                    // ����Ĭ����ɫ
                    $color = imagecolorallocate($img, 255, 255, 255);
                    imagefill($img, 0, 0, $color);
                    //�ü�
                    imagecopyresampled($img, $this->img, $posx, $posy, $x, $y, $neww, $newh, $w, $h);
                    imagedestroy($this->img); //����ԭͼ
                    $this->img = $img;
                } while(!empty($this->gif) && $this->gifNext());

                $this->info['width']  = $width;
                $this->info['height'] = $height;
                return;
            /* �̶� */
            case THINKIMAGE_THUMB_FIXED:
                $x = $y = 0;
                break;

            default:
                throw new Exception('��֧�ֵ�����ͼ�ü�����');

        }
        /* �ü�ͼ�� */
        $this->crop($w, $h, $x, $y, $width, $height);
    }

    /**
     * ���ˮӡ
     * @param  string  $source ˮӡͼƬ·��
     * @param  integer $locate ˮӡλ��
     * @param  integer $alpha  ˮӡ͸����
     */
    public function water($source, $locate = THINKIMAGE_WATER_SOUTHEAST){
        //��Դ���
        if(empty($this->img)) throw new Exception('û�п��Ա����ˮӡ��ͼ����Դ');
        if(!is_file($source)) throw new Exception('ˮӡͼ�񲻴���');

        //��ȡˮӡͼ����Ϣ
        $info = getimagesize($source);
        if(false === $info || (IMAGETYPE_GIF === $info[2] && empty($info['bits']))){
            throw new Exception('�Ƿ�ˮӡ�ļ�');
        }

        //����ˮӡͼ����Դ
        $fun   = 'imagecreatefrom' . image_type_to_extension($info[2], false);
        $water = $fun($source);

        //�趨ˮӡͼ��Ļ�ɫģʽ
        imagealphablending($water, true);

        /* �趨ˮӡλ�� */
        switch ($locate) {

            /* ���½�ˮӡ */
            case THINKIMAGE_WATER_SOUTHEAST:
                $x = $this->info['width'] - $info[0];
                $y = $this->info['height'] - $info[1];
                break;

            /* ���½�ˮӡ */
            case THINKIMAGE_WATER_SOUTHWEST:
                $x = 0;
                $y = $this->info['height'] - $info[1];
                break;

            /* ���Ͻ�ˮӡ */
            case THINKIMAGE_WATER_NORTHWEST:
                $x = $y = 0;
                break;

            /* ���Ͻ�ˮӡ */
            case THINKIMAGE_WATER_NORTHEAST:
                $x = $this->info['width'] - $info[0];
                $y = 0;
                break;

            /* ����ˮӡ */
            case THINKIMAGE_WATER_CENTER:
                $x = ($this->info['width'] - $info[0])/2;
                $y = ($this->info['height'] - $info[1])/2;
                break;

            /* �¾���ˮӡ */
            case THINKIMAGE_WATER_SOUTH:
                $x = ($this->info['width'] - $info[0])/2;
                $y = $this->info['height'] - $info[1];
                break;

            /* �Ҿ���ˮӡ */
            case THINKIMAGE_WATER_EAST:
                $x = $this->info['width'] - $info[0];
                $y = ($this->info['height'] - $info[1])/2;
                break;

            /* �Ͼ���ˮӡ */
            case THINKIMAGE_WATER_NORTH:
                $x = ($this->info['width'] - $info[0])/2;
                $y = 0;
                break;

            /* �����ˮӡ */
            case THINKIMAGE_WATER_WEST:
                $x = 0;
                $y = ($this->info['height'] - $info[1])/2;
                break;

            default:
                /* �Զ���ˮӡ���� */
                if(is_array($locate)){
                    list($x, $y) = $locate;
                } else {
                    throw new Exception('��֧�ֵ�ˮӡλ������');
                }
        }

        do{
            //���ˮӡ
            $src = imagecreatetruecolor($info[0], $info[1]);
            // ����Ĭ����ɫ
            $color = imagecolorallocate($src, 255, 255, 255);
            imagefill($src, 0, 0, $color);

            imagecopy($src, $this->img, 0, 0, $x, $y, $info[0], $info[1]);
            imagecopy($src, $water, 0, 0, 0, 0, $info[0], $info[1]);
            imagecopymerge($this->img, $src, $x, $y, 0, 0, $info[0], $info[1], 100);

            //������ʱͼƬ��Դ
            imagedestroy($src);
        } while(!empty($this->gif) && $this->gifNext());
        //����ˮӡ��Դ
        imagedestroy($water);
    }

    /**
     * ͼ���������
     * @param  string  $text   ��ӵ�����
     * @param  string  $font   ����·��
     * @param  integer $size   �ֺ�
     * @param  string  $color  ������ɫ
     * @param  integer $locate ����д��λ��
     * @param  integer $offset ������Ե�ǰλ�õ�ƫ����
     * @param  integer $angle  ������б�Ƕ�
     */
    public function text($text, $font, $size, $color = '#00000000',
                         $locate = THINKIMAGE_WATER_SOUTHEAST, $offset = 0, $angle = 0){

        //��Դ���
        if(empty($this->img)) throw new Exception('û�п��Ա�д�����ֵ�ͼ����Դ');
        if(!is_file($font)) throw new Exception("�����ڵ������ļ���{$font}");

        //��ȡ������Ϣ
        $info = imagettfbbox($size, $angle, $font, $text);
        $minx = min($info[0], $info[2], $info[4], $info[6]);
        $maxx = max($info[0], $info[2], $info[4], $info[6]);
        $miny = min($info[1], $info[3], $info[5], $info[7]);
        $maxy = max($info[1], $info[3], $info[5], $info[7]);

        /* �������ֳ�ʼ����ͳߴ� */
        $x = $minx;
        $y = abs($miny);
        $w = $maxx - $minx;
        $h = $maxy - $miny;

        /* �趨����λ�� */
        switch ($locate) {

            /* ���½����� */
            case THINKIMAGE_WATER_SOUTHEAST:
                $x += $this->info['width']  - $w;
                $y += $this->info['height'] - $h;
                break;

            /* ���½����� */
            case THINKIMAGE_WATER_SOUTHWEST:
                $y += $this->info['height'] - $h;
                break;

            /* ���Ͻ����� */
            case THINKIMAGE_WATER_NORTHWEST:
                // ��ʼ���꼴Ϊ���Ͻ����꣬�������
                break;

            /* ���Ͻ����� */
            case THINKIMAGE_WATER_NORTHEAST:
                $x += $this->info['width'] - $w;
                break;

            /* �������� */
            case THINKIMAGE_WATER_CENTER:
                $x += ($this->info['width']  - $w)/2;
                $y += ($this->info['height'] - $h)/2;
                break;

            /* �¾������� */
            case THINKIMAGE_WATER_SOUTH:
                $x += ($this->info['width'] - $w)/2;
                $y += $this->info['height'] - $h;
                break;

            /* �Ҿ������� */
            case THINKIMAGE_WATER_EAST:
                $x += $this->info['width'] - $w;
                $y += ($this->info['height'] - $h)/2;
                break;

            /* �Ͼ������� */
            case THINKIMAGE_WATER_NORTH:
                $x += ($this->info['width'] - $w)/2;
                break;

            /* ��������� */
            case THINKIMAGE_WATER_WEST:
                $y += ($this->info['height'] - $h)/2;
                break;

            default:
                /* �Զ����������� */
                if(is_array($locate)){

                    list($posx, $posy) = $locate;
                    $x += $posx;
                    $y += $posy;

                } else {
                    throw new Exception('��֧�ֵ�����λ������');
                }
        }

        /* ����ƫ���� */
        if(is_array($offset)){
            $offset = array_map('intval', $offset);
            list($ox, $oy) = $offset;
        } else{
            $offset = intval($offset);
            $ox = $oy = $offset;
        }

        /* ������ɫ */
        if(is_string($color) && 0 === strpos($color, '#')){
            $color = str_split(substr($color, 1), 2);
            $color = array_map('hexdec', $color);
            if(empty($color[3]) || $color[3] > 127){
                $color[3] = 0;
            }
        } elseif (!is_array($color)) {
            throw new Exception('�������ɫֵ');
        }

        do{
            /* д������ */
            $col = imagecolorallocatealpha($this->img, $color[0], $color[1], $color[2], $color[3]);
            imagettftext($this->img, $size, $angle, $x + $ox, $y + $oy, $col, $font, $text);
        } while(!empty($this->gif) && $this->gifNext());

    }

    /* �л���GIF����һ֡�����浱ǰ֡���ڲ�ʹ�� */
    private function gifNext(){

        ob_start();
        ob_implicit_flush(0);
        imagegif($this->img);
        $img = ob_get_clean();

        $this->gif->image($img);
        $next = $this->gif->nextImage();

        if($next){
            $this->img = imagecreatefromstring($next);
            return $next;
        } else {
            $this->img = imagecreatefromstring($this->gif->image());
            return false;
        }
    }

    /**
     * ������������������ͼ����Դ
     */
    public function __destruct() {
        empty($this->img) || imagedestroy($this->img);
    }

}