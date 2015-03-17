<?php

class KmflModel extends Model {
	
	function insert_one($data){
		return $this->data($data)->add();
	}
	
}

?>