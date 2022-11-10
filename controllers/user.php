<?php

class User extends Controller {

	public function __construct() {
		parent::__construct();
        //Session::init();
		Auth::handleLogin();
        /*
		$logged = Session::get('loggedIn');
        $role = Session::get('role');

        if($logged == false || $role != 'owner'){
            Session::destroy();
            header('location: ../login');
        }
		*/
	}
	
	public function index() 
	{	
		//$this->view->title = 'User';
		$this->view->userList = $this->model->userList();
		$this->view->render('user/index');
	}

    public function create()
	{
        //echo 1;
        $data = array();
		$data['login'] = $_POST['login'];
		$data['password'] = $_POST['password'];
		$data['role'] = $_POST['role'];

        //@TODO: do your error checking
        $this->model->create($data);
        header('location: ' . URL . 'user');
	
	}

	public function edit($id) 
	{
        //fetch indivisual user
		//$this->view->title = 'User: Edit';
		$this->view->user = $this->model->userSingleList($id);
		$this->view->render('user/edit');
	}

    public function editSave($id)
    {
        $data = array();
        $data['id'] = $id;
		$data['login'] = $_POST['login'];
		$data['password'] = $_POST['password'];
		$data['role'] = $_POST['role'];

        //@TODO: do your error checking
        $this->model->editSave($data);
        header('location: ' . URL . 'user');
    }
	public function delete($id)
	{
		$this->model->delete($id);
		header('location: ' . URL . 'user');
	}
}