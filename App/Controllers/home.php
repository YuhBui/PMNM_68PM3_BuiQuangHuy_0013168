<?php
class home 
{
    public function index()
    {
        //require_once '../App/Views/home/index.php';
        require_once '../App/Views/layout/masterlayout.php';
    }

    public function login()
    {
        require_once '../App/Views/home/login.php';
    }
}
?>