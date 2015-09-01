<?php

class Model_Contact extends Model_Database
{
	private $link = null;
	private $total = 0;
	private $total_friends = 0;

    public function getList($filter = null, $order = null, $per_page = null)
    {
        $count = DB::query(Database::SELECT, 'SELECT count(*) as count FROM contacts ' . ($filter ? 'WHERE c_last_name = :last_name' : ''))
			->param(':last_name', $filter)->execute();
		
		$this->total = $count[0]['count'];
		
		$pagination = new Pagination(array(
			'total_items'=>$count[0]['count'],
			'items_per_page' => $per_page,
		));			
		
		$count = DB::query(Database::SELECT, 'SELECT count(*) as count FROM contacts ' . ($filter ? 'WHERE c_last_name = :last_name AND c_friend = 1' : 'WHERE c_friend = 1'))
			->param(':last_name', $filter)->execute();
		
		$this->total_friends = $count[0]['count'];
		
		$data = DB::query(Database::SELECT, 'SELECT * FROM contacts ' . ($filter ? 'WHERE c_last_name = :last_name' : '') .
			($order ? 'ORDER BY ' . $order . ' DESC' : '') . ' LIMIT ' . $pagination->offset . ',' . $pagination->items_per_page)
			->param(':last_name', $filter)
			->execute();
		
		$this->link = $pagination->render();
        return $data;
    }
	
	public function delete_all($filter = null, $per_page = null)
    {
        $count = DB::query(Database::SELECT, 'SELECT count(*) as count FROM contacts ' . ($filter ? 'WHERE c_last_name = :last_name' : ''))
			->param(':last_name', $filter)->execute();
					
		$pagination = new Pagination(array(
			'total_items'=>$count[0]['count'],
			'items_per_page' => $per_page,
		));			
		
		$data = DB::query(Database::SELECT, 'SELECT c_id FROM contacts ' . ($filter ? 'WHERE c_last_name = :last_name' : '') . ' LIMIT ' . $pagination->offset . ',' . $pagination->items_per_page)
			->param(':last_name', $filter)
			->execute();
		
		foreach ($data as $d) {
			$this->delete($d['c_id']);
		}
		
        return 'Deleted';
    }
	
	public function delete($id) {
		$count = DB::query(Database::SELECT, 'SELECT count(*) as count FROM contacts WHERE c_id = :id')
			->param(':id', $id)->execute();
			
		if ($count[0]['count'] == 0) {
			return 'No contact with this ID';
		} else {
			DB::query(Database::DELETE, 'DELETE FROM contacts WHERE c_id = :id')
				->param(':id', $id)->execute();
			return 'Contact deleted';
		}
	}
	
	public function add($data) {
		$data = DB::query(Database::INSERT, 'INSERT INTO contacts (c_first_name, c_last_name, c_phone, c_email, c_adress, c_city, c_zip, c_friend) 
			VALUES (:firstname, :lastname, :phone, :email, :address, :city, :zip, :friend)')
			->param(':firstname', $data['first_name'])
			->param(':lastname', $data['last_name'])
			->param(':phone', $data['phone'])
			->param(':email', $data['email'])
			->param(':address', $data['address'])
			->param(':city', $data['city'])
			->param(':zip', $data['zip'])
			->param(':friend', $data['is_friend'])
			->execute();
		
		return 'Contact added';
	}
	
	public function edit($data) {
		$data = DB::query(Database::INSERT, 'UPDATE contacts SET 
			c_first_name = :firstname, c_last_name = :lastname, c_phone = :phone, 
			c_email = :email, c_adress = :address, c_city = :city, 
			c_zip = :zip, c_friend = :friend
			WHERE c_id = :id')
			->param(':firstname', $data['first_name'])
			->param(':lastname', $data['last_name'])
			->param(':phone', $data['phone'])
			->param(':email', $data['email'])
			->param(':address', $data['address'])
			->param(':city', $data['city'])
			->param(':zip', $data['zip'])
			->param(':friend', $data['is_friend'])
			->param(':id', $data['id'])
			->execute();
		
		return 'Contact edited';
	}
	
	public function get($id) {
		$data = DB::query(Database::SELECT, 'SELECT * FROM contacts WHERE c_id = :id')
			->param(':id', $id)
			->execute();
		
		return $data[0];
	}
	
	public function getLinks() {
		return $this->link;
	}
	
	public function getTotal() {
		return $this->total;
	}
	
	public function getTotalFriends() {
		return $this->total_friends;
	}
}

?>