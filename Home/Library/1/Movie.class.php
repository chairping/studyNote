<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-1-31
 * Time: 下午11:19
 */

namespace Home\Library;


class Movie {
    public static $CHILDRENDS = 2;
    public static $REEGULAR = 0;
    public static $NEW_RELEASS = 1;

    private $_title;
    private $_priceCode;

    public function __construct($title , $priceCode) {
        $this->_title = $title;
        $this->_priceCode = $priceCode;
    }

    public function getPriceCode() {
        return $this->_priceCode;
    }

    public function setPriceCode($arg) {
        $this->_priceCode = $arg;
    }

    public function getTitle() {
        return $this->_title;
    }
}