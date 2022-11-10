<?php

class Dashboard_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function xhrInsert() 
	{
       
		$text = $_POST['text'];
		$sth = $this->db->insert('data', array('text' => $text));
		
		$data = array('text' => $text, 'id' => $this->db->lastInsertId());
		echo json_encode($data);
		
	}
	public function xhrGetListings()
	{
		
		$result = $this->db->selectAll('SELECT * FROM data');
		//$sth = $this->db->prepare("SELECT * FROM data");
		/*$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();*/
		echo json_encode($result);//imprime os X e os nomes
	}

	public function xhrDeleteListing()
	{
		/*$id = $_POST['id'];
		$sth = $this->db->prepare('DELETE FROM data WHERE id = "'.$id. '"');
		$sth->execute();
		//$id = (int) $_POST['id'];
		//$this->db->delete('data', "id = '$id'");
		*/
		$id = (int) $_POST['id'];
		$this->db->delete('data', "id = '$id'");

	}
}