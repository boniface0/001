<?php
include("css/conn.php");
if(isset($_GET['id'])){
    $up_id = $_GET['id'];
    $sql = "select * from login where up_id ='$up_id'";
    $qr = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($qr);
    echo 
        $filepath = 'image/' . $result['up_file'];
        if(file_exists($filepath)){
             header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('image/' .  $result['up_file']));
            readfile('image/' .  $result['up_file']);
        }else{
            echo "file doesnt exist";
        }
}

?>