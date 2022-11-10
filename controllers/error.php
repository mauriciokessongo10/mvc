<?php
    class Erro extends Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        function index(){
            $this->view->msg = 'This message does not exist';
            $this->view->render('help/index');
        }


    }