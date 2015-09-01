<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contacts extends Controller {

	public function before() {
		parent::before();
		$this->view = View::factory('list');
	}
	
	public function after() {
		parent::after();
		$this->response->body($this->view);
	}
	
	public function action_index()
	{
		$per_page = isSet($_GET['cpp']) && in_array($_GET['cpp'], array(1,5,10,20,25)) ? $_GET['cpp'] : 5;
		$order_view = isSet($_GET['sort']) && in_array($_GET['sort'], array(1)) ? $_GET['sort'] : null;
		
		switch ($order_view) {
			case 1 : $order = 'c_last_name'; break;
			default : $order = null;
		}
		
		$filter = isSet($_GET['ln_filter']) && HTML::chars($_GET['ln_filter']) != '' ? HTML::chars($_GET['ln_filter']) : null;
		
		$list = new Model_Contact();
		
		$this->view->contacts = $list->getList($filter, $order, $per_page);
		$this->view->per_page = $per_page;
		$this->view->order_view = $order_view;
		$this->view->filter = $filter;
		
		$this->view->total = $list->getTotal();
		$this->view->total_friends = $list->getTotalFriends();		
		$this->view->pagination = $list->getLinks();
		
		$msg = Session::instance()->get('msg');
		
		if ($msg != '') {
			$this->view->msg = $msg;
			Session::instance()->set('msg', null);
		}
		
	}
	
	public function action_delete_all()
	{
		if (isSet($_GET['accept']) && $_GET['accept'] == 1) {
			$per_page = isSet($_GET['cpp']) && in_array($_GET['cpp'], array(1,5,10,20,25)) ? $_GET['cpp'] : 5;
			$filter = isSet($_GET['ln_filter']) && HTML::chars($_GET['ln_filter']) != '' ? HTML::chars($_GET['ln_filter']) : null;
		
			$list = new Model_Contact();
			$list->delete_all($filter, $per_page);	
			
			Session::instance()->set('msg', 'Deleted');
		} else {
			Session::instance()->set('msg', 'Turn on JS to do this');
		}
		
		$this->redirect('contacts/' . URL::query());	
	}
	
	public function action_delete()
	{
		if (isSet($_GET['accept']) && $_GET['accept'] == 1) {
			if (isSet($_GET['id']) && is_numeric($_GET['id'])) {
				$contact = new Model_Contact();
				$msg = $contact->delete($_GET['id']);
				Session::instance()->set('msg', $msg);
			}
		} else {
			Session::instance()->set('msg', 'Turn on JS to do this');
		}
		
		$this->redirect('contacts/' . URL::query(array('id' => null)));	
	}
	
	public function action_insert()
	{
		
		$data = Validation::factory($this->request->post());
		
		$data
			->rule('first_name', 'not_empty')
			->rule('last_name', 'not_empty')
			->rule('phone', 'not_empty')
			->rule('phone', 'phone')
			->rule('email', 'not_empty')
			->rule('email', 'email')
			->rule('address', 'not_empty')
			->rule('address', 'max_length', array(':value', '200'))
			->rule('city', 'not_empty')
			->rule('city', 'max_length', array(':value', '200'))
			->rule('zip', 'not_empty')
			->rule('zip', 'max_length', array(':value', '6'))
			->rule('zip', 'min_length', array(':value', '6'))
			->rule('is_friend', 'not_empty');
			
		if ($data->check())
        {
			$contact = new Model_Contact();
			if (isSet($_POST['id']) && is_numeric($_POST['id'])) {
				$msg = $contact->edit($this->request->post());
			} else {
				$msg = $contact->add($this->request->post());
			}
			die($msg);
        }
 
        $errors = $data->errors('user');
 
		die(implode('</br>', $errors));
	}
	
	public function action_get()
	{
		if (isSet($_GET['id']) && is_numeric($_GET['id'])) {
			$contact = new Model_Contact();
			$data = $contact->get($_GET['id']);
			die(json_encode($data));
		}
		
		die('NO DATA');
	}

} // End Welcome
