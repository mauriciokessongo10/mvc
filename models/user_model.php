<?php

class User_Model extends Model {

	public function __construct() {
		parent::__construct();
	}

    public function userList()
	{
		return $this->db->selectAll('SELECT id, login, role FROM users');

		/*$sth = $this->db->prepare('SELECT userid, login, role FROM user');
		$sth->execute();
		return $sth->fetchAll();*/
	}

    public function userSingleList($id)
    {
		/*$sth =$this->db->prepare("SELECT * FROM users WHERE id = 31");
		$sth->execute(array(':id' => $id));
		return $sth->fetch();
		*/

		return $this->db->selectOne('SELECT id, login, role FROM users WHERE id = :id', array(':id' => $id));

		/*$sth = $this->db->prepare('SELECT id, login, role FROM users WHERE id = :id');
		$sth->execute(array(':id' => $id));
		$sth->fetch();*/

    }

    

    public function create($data)
	{
		$this->db->insert('users', array(
			'login' => $data['login'],
			'password' => Hash::create('sha256', $data['password'], HASH_PASSWORD_KEY),
			'role' => $data['role']
		));
	}

    public function editSave($data)
	{
		$postData = array(
			'login' => $data['login'],
			'password' => Hash::create('sha256', $data['password'], HASH_PASSWORD_KEY),
			'role' => $data['role']
		);
		
		$this->db->update('users', $postData, "`id` = {$data['id']}");
	}
	

    public function delete($id)
	{

		$result = $this->db->selectAll('SELECT role FROM users WHERE id = :id', array(':id' => $id));
		//$sth = $this->db->prepare('DELETE FROM users WHERE id= :id');
		//$sth->execute(array(':id' => $id));
		//$data = $sth->fetch('role');
		//$data = $sth->fetch();
		//print_r($result);
		
		if ($result[0]['role'] == 'owner')
		{
			return false;
		}
		$this->db->delete('users', "id = $id");
		
    }

}

/*
<?php

		/*$sth = $this->db->prepare('DELETE FROM user WHERE userid = :userid');
		$sth->execute(array(
			':userid' => $userid
		));
	}
}
*/