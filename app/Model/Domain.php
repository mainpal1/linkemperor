<?php
/**
 * @author : Main Pal
 * This Class Defines the Domain Model.
 */
class Domain extends AppModel {
	public $useTable = "domain";
	
	public $validate = array(
		'domain_id' => array(
			'rule' => 'isUnique',
			'message' => 'This domain is already there in the Database'
		)
	);
}