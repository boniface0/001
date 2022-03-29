<?php
$id = $_POST["y"];
include("css/conn.php");
$select ="delete from login where up_id='$id'";
$qr = mysqli_query($conn,$select);
 if($qr){
     echo"deleted";
 }else{
     echo "canceled";
 }
?>