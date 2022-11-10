<?php

class Login_Model extends Model{

    public function __construct()
    {
        parent::__construct();
        //echo sha256('jesse');
    }
    public function run()
    {

        $sth = $this->db->prepare("SELECT id, role FROM users WHERE 
        login = :login AND password = :password");
        $sth->execute(array(
            ':login' => $_POST['login'],
            ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
        ));
        //$data = $sth->fetchAll();
        $data = $sth->fetch();

        $count = $sth->rowCount();
        if ($count > 0){
            //login
            Session::init();
            Session::set('role', $data['role']);
            Session::set('loggedIn', true);
            header('location: ../dashboard');
            } else {
        //show an error
            header('location: ../login');
            }
    
        //print_r($data);

    }
}