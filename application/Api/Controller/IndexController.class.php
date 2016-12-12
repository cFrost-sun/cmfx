<?php
/**
 * Created by PhpStorm.
 * User: cFrost
 * Date: 2016/12/12
 * Time: 21:48
 */

namespace Api\Controller;


use Common\Response\ApiResponse;
use Think\Controller\RestController;

class IndexController extends RestController {

    protected $posts_model;
    protected $term_relationships_model;
    protected $terms_model;

    function _initialize() {
        parent::_initialize();
        $this->posts_model = D("Portal/Posts");
        $this->terms_model = D("Portal/Terms");
        $this->term_relationships_model = D("Portal/TermRelationships");
    }

    public function activity() {
        switch ($this->_method) {
            case 'get': // get请求处理代码
                $posts = $this->posts_model
                    ->field('id,post_date,post_content,post_title,post_excerpt,istop,recommended,smeta')
                    ->join('dn_term_relationships ON dn_term_relationships.object_id = dn_posts.id')
                    ->join('dn_terms ON dn_terms.term_id = dn_term_relationships.term_id')
                    ->where('dn_terms.term_id = 3')
                    ->select();
                $this->response(new ApiResponse($posts), 'json');
                break;
            default: $this->response('', 'json'); break;
        }
    }
}