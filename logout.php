<?php
   
   session_start();

   if(isset($_SESSION['auth'])){
    session_destroy();
   }
   else{
    header("location:login.php");
   }

?>