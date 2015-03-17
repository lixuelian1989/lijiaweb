<?php
class LogModel extends RelationModel{
	
	protected  $_link=array(
		'Scenic'=> array(
			'mapping_type'=>BELONGS_TO,
			'class_name'=>'Scenic',
			'foreign_key'=>'sce_id',
			'as_fields'=>'sce_img,sce_detail,sce_name',
		),
	);
	
}