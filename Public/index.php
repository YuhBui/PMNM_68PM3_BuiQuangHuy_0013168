<?php 
session_start();
require_once "../App/Core/Controller.php";

require_once "../App/middleware.php";
$middleware = new middleware();
$middleware->checklogin();
$app = new App();
?>