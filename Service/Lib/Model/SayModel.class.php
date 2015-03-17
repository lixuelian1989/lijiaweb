<?php
class SayModel extends RelationModel{
	protected $_link=array(
	
		'Member'=> array(
			'mapping_type'=>BELONGS_TO,
			'class_name'=>'Member',
			'foreign_key'=>'uid',
			'as_fields'=>'nickname,avatar',
		),
	);
}