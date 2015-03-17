<?php

class AdminLogModel extends Model {
	
	function insert_one($data){
		return $this->data($data)->add();
	}
}

?>