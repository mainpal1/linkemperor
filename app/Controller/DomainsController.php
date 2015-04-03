<?php
/**
 * 
 */

App::uses('AppController', 'Controller');

/**
 * 
 */
class DomainsController extends AppController {
	
	private $API_KEY = "57823b2d9b1b99631e4a7cb0859b98eeb1883e40";

	public $uses = array('Domain');
	
	public $components = array('Paginator');

	public function index() {
		$domains = $this->Paginator->paginate('Domain');
		$this->set('domains', $domains);
	}
	
	public function create(){
		if($this->request->is('post') || $this->request->is('put')){
			$domain = $this->request->data['Domain'];
			$newDomainData = $this->postNewDomain($domain['domain'], $domain['needs_article']);
			if($this->updateDomain($newDomainData)){
				$this->Session->setFlash(__("Domain created"), "default", array("class" => "message success"));
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__("Domain could not be created, please try again;"));
			}
		}
	}
	
	private function updateDomain($newDomainData, $id = null){
		if($id == null){
			$this->Domain->create();
		}else{
			$this->Domain->id = $id;
		}
		$newDomainData['domain_id'] = $newDomainData['id'];
		unset($newDomainData['id']);
		return $this->Domain->save(array('Domain' => $newDomainData)) ? true : false;
	}
	
	private function postNewDomain($domain_name, $needs_article) {
		$postURL = "https://app.linkemperor.com/api/v2/vendors/domains.json?api_key=" . $this->API_KEY;
		$map = array();
		$map["domain_name"] = $domain_name;
		$map["needs_article"] = $needs_article == 1?"true":"false";
		
		$jsonResponse = $this->makeHttpRequest($postURL, $map);

		return $jsonResponse;
	}
    
	private function makeHttpRequest($postURL, $map){
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
			
			$jsonResponse = json_decode($response, true);
		}catch(Exception $e){
			$this->log($e);
		}
		return $jsonResponse;
	}
    
    public function edit($id = null){
    	if(!$this->Domain->exists($id)){
    		$this->Session->setFlash(__('Domain not found'));
    		$this->redirect(array('action' => 'index'));
    		return;
    	}
    	$domain = $this->Domain->read(null, $id);
    	if($this->request->is('post') || $this->request->is('put')){
    		$newDomainData = null;
    		if($this->request->data['Domain']['active']){
    			$newDomainData = $this->activateDomain($domain['Domain']['domain_id']);
    		}else{
    			$newDomainData = $this->deactivateDomain($domain['Domain']['domain_id']);
    		}
    		if($this->updateDomain($newDomainData, $id)){
    			$this->Session->setFlash(__('Operation successful.'), "default", array("class" => "message success"));
    			$this->redirect(array('action' => 'index'));
    		}else{
    			$this->Session->setFlash(__('Domain could not be updated, please try again'));
    		}
    	}else{
    		$this->request->data = $domain;
    	}
    }
    
    public function delete($id = null){
    	if(!$this->Domain->exists($id)){
    		$this->Session->setFlash(__('Domain not found'));
    		$this->redirect(array('action' => 'index'));
    		return;
    	}
    	if($this->Domain->delete($id)){
    		$this->Session->setFlash(__('Domain deleted.'), "default", array("class" => "message success"));
    		$this->redirect(array('action' => 'index'));
    	}else{
    		$this->Session->setFlash(__('Domain could not be deleted, please try again'));
    	}
    }
    
    private function activateDomain($id){
    	$postURL = "https://app.linkemperor.com/api/v2/vendors/domains/" . $id . "/activate.json?api_key=" . $this->API_KEY;
    	$map = array();
    	$jsonResponse = $this->makeHttpRequest($postURL, $map);
    	
    	return $jsonResponse;
    }
    
    private function deactivateDomain($id){
    	$postURL = "https://app.linkemperor.com/api/v2/vendors/domains/" . $id . "/deactivate.json?api_key=" . $this->API_KEY;
    	$map = array();
    	$jsonResponse = $this->makeHttpRequest($postURL, $map);
    	 
    	return $jsonResponse;
    }
}
