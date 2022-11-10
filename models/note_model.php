<?php

class Note_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function noteList()
	{
		return $this->db->selectAll('SELECT * FROM note WHERE id = :id', 
				array('id' => $_SESSION['id']));
	}
	
	public function noteSingleList($noteid)
	{
		return $this->db->selectOne('SELECT * FROM note WHERE id = :id AND noteid = :noteid', 
			array('id' => $_SESSION['id'], 'noteid' => $noteid));
	}
	
	public function create($data)
	{
		$this->db->insert('note', array(
			'title' => $data['title'],
			'id' => $_SESSION['id'],
			'content' => $data['content'],
			'date_added' => date('Y-m-d H:i:s') // use GMT aka UTC 0:00
		));
	}
	
	public function editSave($data)
	{
		$this->db->update('note', $data, 
				"`noteid` = '{$data['noteid']}' AND id = '{$_SESSION['id']}'");
	}
	
	public function delete($id)
	{
		$this->db->delete('note', "`noteid` = {$id} AND id = '{$_SESSION['id']}'");
	}
}