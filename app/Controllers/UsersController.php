<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Help\Upload;

class UsersController{
   private $conn;
   public function __construct($db){
       $this->conn = $db->getConnect();
   }

   public function index(){
       $users = (new UserModel())::all($this->conn);
       include_once 'views/users.php';
   }

   public function addForm(){
       include_once 'views/addUser.php';
   }

   public function add(){
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $upload = new Upload();
       $filePath = $upload->getFilePath();
       if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($password) !== "") {
           $user = new UserModel($name, $email, $gender, $password, $filePath);
           $user->add($this->conn);
       }
       header('Location: ?controller=users');
   }

    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            (new UserModel())::delete($this->conn, $id);
        }
        header('Location: ?controller=users');
    }

    public function update() {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $upload = new Upload();
        $filePath = $upload->getFilePath();
        if($upload->isUploaded()==false){
            $filePath = $_POST['filepath'];
        }
        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($password) !== "") {
            (new UserModel())::update($this->conn, $id, $name, $email, $gender, $password, $filePath);
        }
        header('Location: ?controller=users');
    }

    public function show(){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            $user = (new UserModel())::byId($this->conn, $id);
        }
        include_once 'views/showUser.php';
    }

}
