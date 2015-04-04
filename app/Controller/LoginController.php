<?php
App::uses('AppController', 'Controller');
class LoginController extends AppController {
	var $uses = array('User');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('m_login');
	}
	public function index(){
		if($this->Auth->user()){
			$this->redirect(array('controller' => 'dashboard'));
		}
		if($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('Invalid username or password, try again');
			}
		}else{
			$firstUser = $this->User->find('first');
			if(!$firstUser){
				$this->User->save(array('User' => array('username' => 'airpr23', 'password' => $this->Auth->password('ByPass21'))));
			}
		}
	}
	
	public function resetPassword(){
		if($this->request->is('post')) {
			if($this->request->data['User']['password'] != "" && $this->request->data['User']['password'] == $this->request->data['User']['confirm_password']){
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('password', $this->Auth->password($this->request->data['User']['password']));
				$this->Session->setFlash(__("Password updated"), "default", array("class" => "message success"));
			}else{
				$this->Session->setFlash(__("Password mismatch"));
			}
		}
	}
}