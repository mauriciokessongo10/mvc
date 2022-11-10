<?php
    class Login extends Controller
    {
        function __construct()
        {
            parent::__construct(); 
        }

        function index(){
            //echo Hash::create('md5', 'test','HASH_KEY');
            //echo Hash::create('md5', 'test', HASH_KEY);
            $this->view->render('login/index');
           // $this->view->msg = 'This message does not exist';
        
        }

        function run()
        {
            $this->model->run();
        }

    }
        

