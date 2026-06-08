<?php
class Controller {
    public function model ($model) {
        require_once "../App/Models/" . $model . ".php";
        return new $model();
    }
    public function view ($path_to_view, $data = []) {
        extract($data);
        require_once "../App/Views/" . $path_to_view . ".php";
    }
}
?>