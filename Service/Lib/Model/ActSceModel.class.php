<?php 
class ActSceModel extends RelationModel{
	
	protected $_link=array(
			
		'Scenic'=>array(
				'mapping_type'=>BELONGS_TO,
				'class_name' =>'Scenic',
				'foreign_key'=>'sce_id',
				'condition'=>'status=1',
				'as_fields'=>'sce_img,url,sce_name',
		),
		'Active'=>array(
				'mapping_type'=>BELONGS_TO,
				'class_name' =>'Active',
				'foreign_key'=>'act_id',
				'condition'=>'status=1',
				'as_fields'=>'act_img,url:act_url,act_name',
		),
			
	);
	
	
	
}


?>