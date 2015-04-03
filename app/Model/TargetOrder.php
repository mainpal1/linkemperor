<?php
/**
 * @author : Main Pal
 * This Class Defines the Domain Model.
 */
class TargetOrder extends AppModel {
	public $useTable = "target_order";
	
	public $validate = array(
		'target_order_id' => array(
			'rule' => 'isUnique',
			'message' => 'This target is already there in the Database'
		)
	);
}