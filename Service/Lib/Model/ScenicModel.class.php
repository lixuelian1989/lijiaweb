<?php
class ScenicModel extends RelationModel{
	protected  $_link=array(
		'View'=> array(
			'mapping_type'=>HAS_MANY,
			'class_name'=>'View',
			'foreign_key'=>'sce_id',
			'mapping_name'=>'views',
			//'condition'=>array('status'=>1),
			'mapping_fields'=>'view_name,view_x,view_y,view_longitude,view_latitude,id view_id',
		),
	);
}