<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-1-31
 * Time: 下午11:26
 */

namespace Home\Library;


class Rental {
    private $_movie;
    private $_daysRented;

    public function __construct($movie , $dayRented) {
        $this->_movie = $movie;
        $this->_daysRented = $dayRented;
    }

    public function getDaysRented() {
        return $this->_daysRented;
    }

    public function getMovie() {
        return $this->_movie;
    }
}