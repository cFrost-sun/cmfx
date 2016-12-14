<?php
/**
 * Created by PhpStorm.
 * User: cFrost
 * Date: 2016/12/12
 * Time: 21:48
 */

namespace Api\Controller;


use Common\Response\ApiPageResponse;
use Common\Response\ApiResponse;
use Think\Controller\RestController;

class IndexController extends RestController {

    protected $posts_model;
    protected $term_relationships_model;
    protected $terms_model;

    function _initialize() {
        parent::_initialize();
        $this->posts_model = D("Demo/Posts");
        $this->terms_model = D("Demo/Terms");
        $this->term_relationships_model = D("Demo/TermRelationships");
    }

    public function activityByPage($pageIndex, $pageSize) {
        switch ($this->_method) {
            case 'get': // get请求处理代码

                $count = $this->posts_model
                    ->where('post_class = 3 and post_status = 1')
                    ->count();
                $posts = $this->posts_model
                    ->field('id,post_date,post_content,post_title,post_excerpt,istop,recommended,smeta')
                    ->where('post_class = 3 and post_status = 1')
//                    ->join('dn_term_relationships ON dn_term_relationships.object_id = dn_posts.id')
//                    ->join('dn_terms ON dn_terms.term_id = dn_term_relationships.term_id')
//                    ->where('dn_terms.term_id = 3')
                    ->order('post_date')
                    ->page($pageIndex . ',' . $pageSize)
                    ->select();

                $ret = new ApiPageResponse($posts);
                $ret->pageIndex = $pageIndex;
                $ret->pageSize = $pageSize;
                $ret->total = $count;
                $this->response($ret, 'json');
                break;
            default:
                $this->response('', 'json');
                break;
        }
    }

    public function activityById($id) {
        switch ($this->_method) {
            case 'get': // get请求处理代码
                $query = $this->posts_model
                    ->field('id,post_date,post_content,post_title,post_excerpt,istop,recommended,smeta')
                    ->join('dn_term_relationships ON dn_term_relationships.object_id = dn_posts.id')
                    ->join('dn_terms ON dn_terms.term_id = dn_term_relationships.term_id')
                    ->where('dn_terms.term_id = 3 and dn_posts.id = '.$id)
                    ->order('post_date');

                $posts = $query
                    ->select();

                $ret = new ApiResponse($posts);
                $this->response($ret, 'json');
                break;
            default: $this->response('', 'json'); break;
        }
    }
}