<?php

namespace Common\Response;
use Common\util\DateTool;

/**
 * Created by PhpStorm.
 * User: cFrost
 * Date: 2016/12/10
 * Time: 16:38
 */
class ApiPageResponse extends ApiResponse {
    public $pageIndex;
    public $pageSize;
    public $total;
}