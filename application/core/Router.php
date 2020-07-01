<?php

namespace application\core;


class Router {
    protected $routes = [];
    protected $params = [];


    public function __construct(){
        $arr = require 'application/config/routes.php';
        //debug($arr);

        foreach($arr as $key => $val){
            $this->add($key,$val);
        }
        //debug($this->routes);
    }


    public function add($route, $params){
        $route = '#^'.$route.'#';
        $this->routes[$route] = $params;
        
    }



    public function match(){
        
        //debug($_SERVER);
        $url = trim($_SERVER['REQUEST_URI'],'/');
       
        
        foreach($this->routes as $route => $params){

            if (preg_match($route, $url, $matches)){
                //var_dump($params);
                $this->params = $params;
                return true;
            }
        }

        return false;
    }
    public function run(){
        //$this->match();
        if($this->match()){
            $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            
            if(class_exists($path)){

                $action = $this->params['action'].'Action';
                if(method_exists($path, $action)){
                    $controller = new $path($this->params) ;
                    $controller->$action() ;
                } else {
                    echo 'Action not found'.$action;
                }

            } else {
                echo 'controller not found '.$path;

            }
           
        } else echo'ne naideno';
        //echo ' start';
    }

    


}