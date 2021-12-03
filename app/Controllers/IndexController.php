<?php

namespace App\Controllers;
use App\Models\IndexModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class IndexController{
   private $conn;
   
   public function __construct($db){
        $this->conn = $db->getConnect();
   }

   public function index(){
       include_once 'views/home.php';
   }

    public function contact(){
        include_once 'views/contact.php';
    }

    public function auth(){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (trim($email) !== "" && trim($password) !== "") {
            (new IndexModel())::check($this->conn, $email, $password);
        }
   }

   public function logout(){
    session_start();
    session_unset();
    session_destroy();
    header('Location: ?controller=index');
  }

  public function send(){
      $to = "testp10cs@gmail.com";
      $subject = "My subject";
      $txt = "Hello world!";
      $headers = "From: webmaster@gmail.com" . "\r\n";
      mail($to,$subject,$txt,$headers);
      header('Location: ?controller=index&action=contact');
  }
}
