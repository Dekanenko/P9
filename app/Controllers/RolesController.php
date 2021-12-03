<?php

namespace App\Controllers;
use App\Models\RoleModel;

class RolesController{
   private $conn;
   public function __construct($db){
       $this->conn = $db->getConnect();
   }

   public function index(){
       $roles = (new RoleModel())::all($this->conn);
       include_once 'views/roles.php';
   }

   public function addForm(){
    include_once 'views/addRole.php';
}

    public function add(){
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        echo $title;
        if (trim($title) !== "") {
            $role = new RoleModel($title);
            $role->add($this->conn);
        }
        header('Location: ?controller=roles');
    }
 
    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            (new RoleModel())::delete($this->conn, $id);
        }
        header('Location: ?controller=roles');
    }

    public function update() {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($title) !== "") {
            (new RoleModel())::update($this->conn, $id, $title);
        }
        header('Location: ?controller=roles');
    }

    public function show(){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            $role = (new RoleModel())::byId($this->conn, $id);

        }
        include_once 'views/showRole.php';
    }
}
