<?php
namespace Demo\Model;

use Common\Model\CommonModel;

class TermRelationshipsModel extends CommonModel {
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}

}