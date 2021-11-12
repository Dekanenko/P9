<?php
class UsersController{
   private $conn;
   public function __construct($db){
       $this->conn = $db->getConnect();
   }

   public function index(){
       include_once 'app/Models/UserModel.php';
       $users = (new User())::all($this->conn);

       include_once 'views/users.php';
   }

   public function addForm(){
       include_once 'views/addUser.php';
   }

   public function add(){
       include_once 'app/Models/UserModel.php';
       include_once 'app/Controllers/uploadPhoto.php';
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($password) !== "") {
           $user = new User($name, $email, $gender, $password, $filePath);
           $user->add($this->conn);
       }
       header('Location: ?controller=users');
   }

    public function delete() {
        include_once 'app/Models/UserModel.php';
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            (new User())::delete($this->conn, $id);
        }
        header('Location: ?controller=users');
    }

    public function update() {
        include_once 'app/Models/UserModel.php';
        include_once 'app/Controllers/uploadPhoto.php';
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($name) !== "" && trim($email) !== "" && trim($gender) !== "" && trim($password) !== "") {
            (new User())::update($this->conn, $id, $name, $email, $gender, $password, $filePath);
        }
        header('Location: ?controller=users');
    }

    public function show(){
        include_once 'app/Models/UserModel.php';
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (trim($id) !== "" && is_numeric($id)) {
            $user = (new User())::byId($this->conn, $id);
        }
        include_once 'views/showUser.php';
    }

 
}
