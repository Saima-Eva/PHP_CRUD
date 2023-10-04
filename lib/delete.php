<?php

include "connection.php";

if(isset($_GET['id'])){
    //echo $_GET['id'];
    $delete_id = $_GET['id'];

    $deleteSql ="DELETE FROM student_info WHERE id = $delete_id";

    if($conn -> query($deleteSql)){
        header("location:../index.php");
    }
    else{
        die($conn -> error);
    }
}   
else{
    header("location:../index.php");
}



?>