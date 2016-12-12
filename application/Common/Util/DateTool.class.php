<?php
namespace Common\util;
/**
 * Created by PhpStorm.
 * User: cFrost
 * Date: 2016/12/10
 * Time: 17:00
 */
class DateTool {

    public static function sysDate() {
        return round(microtime(true) * 1000);
    }
}