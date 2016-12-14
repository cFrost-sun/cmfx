<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
namespace Demo\Controller;

use Common\Controller\HomebaseController;

class ActivityController extends HomebaseController {

    protected $posts_model;
    protected $term_relationships_model;
    protected $terms_model;

    function _initialize() {
        parent::_initialize();
        $this->posts_model = D("Demo/Posts");
        $this->terms_model = D("Demo/Terms");
        $this->term_relationships_model = D("Demo/TermRelationships");
    }
    
    //文章内页
    public function index() {
        $article_id=I('get.id',0,'intval');
        $term_id=4;

        $activity = $this->posts_model
            ->field('id,post_date,post_content,post_title,post_excerpt,istop,recommended,smeta')
            ->join('dn_term_relationships ON dn_term_relationships.object_id = dn_posts.id')
            ->join('dn_terms ON dn_terms.term_id = dn_term_relationships.term_id')
            ->where('dn_terms.term_id = '. $term_id .' and dn_posts.id = '.$article_id)
            ->select();

        $this->assign("activity",$activity[0]);
        $this->assign("abc",'哈哈哈哈');
        $this->display(":activity");
    }
}
