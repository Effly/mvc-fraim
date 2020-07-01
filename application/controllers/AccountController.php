<?php

namespace application\controllers;
use application\core\Controller;

class AccountController extends Controller{
    public function loginAction(){
        echo 'страница входа';
        $this->view->render('контакты');
    }
    public function registerAction(){
        echo 'страница реги';
    }
    
}


?>