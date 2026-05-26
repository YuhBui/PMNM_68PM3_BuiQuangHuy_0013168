<?php
class Controller {
    public function model ($model) {
        require_once "../App/Models/" . $model . ".php";
        return new $model();
    }
    public function view ($view, $data = []) {
        require_once "../App/Views/" . $viewName . ".php";
    }
}
?>