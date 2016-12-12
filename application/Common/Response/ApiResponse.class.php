<?php

namespace Common\Response;
use Common\util\DateTool;

/**
 * Created by PhpStorm.
 * User: cFrost
 * Date: 2016/12/10
 * Time: 16:38
 */
class ApiResponse {
    public $data;
    public $dataSize;
    public $returnDate;

    public function __construct($data) {
        if (is_array($data)) {
            $this->data = $data;
        } else {
            $this->data = array($data);
        }

        $this->dataSize = sizeof($this->data);
        $this->returnDate = DateTool::sysDate();
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
}