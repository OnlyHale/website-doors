<?php
 session_start();

 if($_SESSION){
      if(isset($_SESSION['user'])) {
         unset($_SESSION['user']);
      }
  }
  header('Location: ../auth.php');
?>