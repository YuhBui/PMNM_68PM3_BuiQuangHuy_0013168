<?php
require_once "../App/Core/Controller.php";

class home extends Controller
{
    public function index() {
        $this->view("layout/masterlayout", ['viewName' => 'home/index']);
    }

    public function login() {   
        $this->view("home/login");
    }
}
?>