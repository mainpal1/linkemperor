<?php
/**
 * 
 */

App::uses('AppController', 'Controller');

/**
 * 
 */
class TargetOrdersController extends AppController {
	
	private $API_KEY = "57823b2d9b1b99631e4a7cb0859b98eeb1883e40";

	public $uses = array('TargetOrder');
	
	public $components = array('Paginator');

	public function index() {
		$this->Paginator->settings = array('limit' => 10);
		$targetOrders = $this->Paginator->paginate('TargetOrder');
		$this->set('targetOrders', $targetOrders);
	}
	
	public function getAll(){
		$targetOrder = $this->request->data['TargetOrder'];
		$newTargetOrderDatas = $this->getAllTargetOrders();
		$this->log($newTargetOrderDatas);
		foreach($newTargetOrderDatas as $newTargetOrderData){
			$this->updateTargetOrder($newTargetOrderData);
		}
		$this->Session->setFlash("Done", "default", array("class" => "message success"));
		$this->redirect(array('action' => 'index'));
	}
	
	public function getAllTargetOrders(){
		$getURL = "https://app.linkemperor.com/api/v2/vendors/target_orders.json?api_key=" . $this->API_KEY;
		$map = false;
		
		$jsonResponse = $this->makeHttpGetRequest($getURL, $map);
		
		return $jsonResponse;
	}
	
	public function next(){
		$targetOrder = $this->request->data['TargetOrder'];
		$newTargetOrderDatas = $this->getNextTargetOrder();
		
		foreach($newTargetOrderDatas as $newTargetOrderData)
			$this->updateTargetOrder($newTargetOrderData);
		$this->Session->setFlash("Done", "default", array("class" => "message success"));
		$this->redirect(array('action' => 'index'));
	}
	
	private function updateTargetOrder($newTargetOrderData, $id = null){
		if($id == null){
			$this->TargetOrder->create();
		}else{
			$this->TargetOrder->id = $id;
		}
		$this->log($newTargetOrderData);
		$newTargetOrderData['target_order_id'] = $newTargetOrderData['id'];
		unset($newTargetOrderData['id']);
		return $this->TargetOrder->save(array('TargetOrder' => $newTargetOrderData)) ? true : false;
	}
	
	private function udpateTargetOrderAll($newTargetOrderDatas){
		
	}
	
	private function getNextTargetOrder($batch_size = 0) {
		$getURL = "https://app.linkemperor.com/api/v2/vendors/target_orders/next.json?api_key=" . $this->API_KEY;
		$map = false;
		if($batch_size > 0){
			$map = array();
			$map["batch_size"] = $batch_size;
		}
		
		$jsonResponse = $this->makeHttpGetRequest($getURL, $map);

		return $jsonResponse;
	}
    
	private function makeHttpGetRequest($getURL, $map){
		$jsonResponse = array();
		try {
			App::uses('HttpSocket', 'Network/Http');
			$options = array(
					'header' => array(
							'Content-Type' => 'application/json',
							'Accept' => 'application/json; charset=UTF-8'
					)
			);
			$HttpSocket = new HttpSocket();
	   
			$response = $HttpSocket->get($getURL, $map?json_encode($map):null, $options);
			
			$jsonResponse = json_decode($response, true);
		}catch(Exception $e){
			$this->log($e);
		}
		return $jsonResponse;
	}
    
	private function makeHttpPostRequest($postURL, $map){
		$jsonResponse = array();
		try {
			App::uses('HttpSocket', 'Network/Http');
			$options = array(
					'header' => array(
							'Content-Type' => 'application/json',
							'Accept' => 'application/json; charset=UTF-8'
					)
			);
			$HttpSocket = new HttpSocket();
	   
			$response = $HttpSocket->post($postURL, json_encode($map), $options);
			$this->log("MakeHttpPostRequest Response: ");
			$this->log($response);
			
			$jsonResponse = json_decode($response, true);
		}catch(Exception $e){
			$this->log($e);
		}
		return $jsonResponse;
	}
    
    public function edit($id = null){
    	if(!$this->TargetOrder->exists($id)){
    		$this->Session->setFlash(__('TargetOrder not found'));
    		$this->redirect(array('action' => 'index'));
    		return;
    	}
    	$targetOrder = $this->TargetOrder->read(null, $id);
    	if($this->request->is('post') || $this->request->is('put')){
    		$newTargetOrderData = null;
    		if(isset($this->request->data['TargetOrder']['placement_url']) && $this->request->data['TargetOrder']['placement_url'] != ''){
    			$newTargetOrderData = $this->setTargetPlacementURL($targetOrder['TargetOrder']['target_order_id'], $this->request->data['TargetOrder']['placement_url']);
    		
	    		if($this->updateTargetOrder($newTargetOrderData, $id)){
	    			$this->Session->setFlash(__('Operation successful.'), "default", array("class" => "message success"));
	    			$this->redirect(array('action' => 'index'));
	    		}else{
	    			$this->Session->setFlash(__('Target Order could not be updated, please try again'));
	    		}
    		}else{
    			$this->Session->setFlash(__('Placement URL can not be blank'));
    		}
    	}else{
    		$this->request->data = $targetOrder;
    	}
    }
    
    public function delete($id = null){
    	if(!$this->TargetOrder->exists($id)){
    		$this->Session->setFlash(__('Target Order not found'));
    		$this->redirect(array('action' => 'index'));
    		return;
    	}
    	if($this->TargetOrder->delete($id)){
    		$this->Session->setFlash(__('Target Order deleted.'), "default", array("class" => "message success"));
    		$this->redirect(array('action' => 'index'));
    	}else{
    		$this->Session->setFlash(__('Target Order could not be deleted, please try again'));
    	}
    }
    
    private function setTargetPlacementURL($id, $placement_url){
    	$postURL = "https://app.linkemperor.com/api/v2/vendors/target_orders/" . $id . ".json?api_key=" . $this->API_KEY;
    	$map = array();
    	$map['placement_url'] = $placement_url;
    	$jsonResponse = $this->makeHttpPostRequest($postURL, $map);
    	
    	return $jsonResponse;
    }
}
