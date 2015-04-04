<?php
App::uses('AppController', 'Controller');
class LogoutController extends AppController {
	public function index(){
		$this->redirect($this->Auth->logout());
	}
}