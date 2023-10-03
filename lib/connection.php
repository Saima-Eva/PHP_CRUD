<?php

$host="localhost";
$user="root";
$pass="";
$db  ="education";

$conn = new mysqli($host,$user,$pass,$db);

if($conn -> connect_error){
    die($conn -> error);
}
else{
    //echo "Database connected";
}


?>