<?php

namespace App\Models;

class UserModel {
   private $name;
   private $email;
   private $gender;
   private $password;
   private $path_to_img;

    public function __construct($name = '', $email = '',  $gender = '', $password = '', $path_to_img = ''){
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
        $this->password = $password;
        $this->path_to_img = $path_to_img;
    }

    public function add($conn) {
        $sql = "INSERT INTO users (email, name, gender, password, path_to_img) VALUES ('$this->email', '$this->name', '$this->gender', '$this->password', '$this->path_to_img')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

   public static function all($conn) {
       $sql = "SELECT * FROM users";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
           $arr = [];
           while ( $db_field = $result->fetch_assoc() ) {
               $arr[] = $db_field;
           }
           return $arr;
       } else {
           return [];
       }
   }


   public static function update($conn, $id, $name, $email, $gender, $password, $filePath) {
       $sql = "UPDATE users SET name = '$name', email = '$email', gender = '$gender', password = '$password', path_to_img = '$filePath' WHERE id = $id";
       $res = mysqli_query($conn, $sql);
       if ($res) {     
           return true;       
       }
   }

    public static function delete($conn, $id) {
        $sql = "DELETE FROM users WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
    }

    public static function byid($conn, $id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if ($res->num_rows > 0) {
            $arr = $res->fetch_assoc();
            return $arr;
        }else{
            return [];
        }
    }
 
}
