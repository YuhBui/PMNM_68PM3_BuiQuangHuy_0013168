<?php

include "../App/Controllers/sinhvien_ctrl.php";

$ctrl = new Sinhvien_ctrl();

$rs = $ctrl->getAll();

var_dump($rs);

?>