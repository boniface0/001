<?php
include("css/conn.php");
  if(isset($_POST["btn"])){
      $u_name = $_POST["up_name"];
      $up_desc = $_POST["up_desc"];
      $upload = $_FILES["up_file"]["name"];
      $destination = 'image/' .$upload;
      ///getting file extension
      $extension = pathinfo($upload, PATHINFO_EXTENSION);
      ///tempolary file save in a server
      $file = $_FILES['up_file']['tmp_name'];
       
       $size = $_FILES['up_file']['size'];
       move_uploaded_file($file, $destination);
    $sql = "insert into login(up_name,up_dec,up_file) values('$u_name','$up_desc','$upload')";
    $qr = mysqli_query($conn,$sql);

  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartcode</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .btn2{
    position: absolute;
    bottom: 10px;
    right: 30px;
}
.main{
    margin-top:60px !important;
}
.cont{
    text-align:center;
    display:flex;
    padding:20px;
}
.main a{
  text-decoration:none;

}
.cont h4{
    padding-left:40px;
    font-size:20px;
    text-transform:capitalize;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
.left{
  position: absolute;
  color:white;
  text-decoration:none;
  top:20px;
  right:20px;
  padding:5px;
  border:1px solid white;
  border-radius:5px;
}

.buc{
   text-align:center;
   display:flex;
   padding-left:20px;
}
.buc h4{
    font-size:20px;
    padding-left:40px;
}
.buc .h2{
    padding-left:200px;
}
.buc .h3{
    padding-left:200px;
}
.bn{
    border-left:2px solid black;
    border-bottom:1px solid blue;
}
.split-doc{
    margin-top:50px;
}
.split-doc .table th{
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
@media screen  and (max-width: 600px){
  .modal2{
    left: 20px !important;
  }
}
.modal2{
  position:fixed;
  top:20px;
  width:600px;
  left:200px;
  display:none;
  z-index: 7;
  animation-name:animatetop;
  animation-duration:0.4s;
  background-color:rgb(3,3,4);
  background-color:rgba(1,2,1,0.4);
  border:1px solid #888;
  border-radius:10px;
  padding:10px;
}
.modal2 .card-header{
  background-color:blue;
  color:white;
  text-transform:capitalize;

}
.modal2 .modal-content2{
  background-color:#fefefe;
  position: relative;
  box-shadow:0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
@keyframes animatetop {
  from{top:-600px;opacity: 0;}
  top {top:20px;opacity:1}
}
#close{
  color:red;
  margin-left:250px;
  font-size:40px;
  cursor: pointer;
}
.table-body td{
  font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}
   </style>
</head>
<body>
<div class="header2">
	<h3>smartcode center</h3>
  
</div>
<div class="main">
<a href="index.html"  class="left bg-success">Home</a> 
</div>
<div class="div">
<a  class="btn btn-success  btn2"  data-toggle="modal" data-target="#modalContactForm">upload</a>
    
</div>
<div class="split-doc">
   <div class="container-fluid">
       <table class="table">
         <div class="table-header">
           <tr>
            <th >Document name</th>
            <th>Document description</th>
            <th class="text-danger">Action</th>
           </tr>
         </div>
         <div class="table-body">
           <?php
                $sql = "select * from login";
                $qr = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($qr);
                if($count>0){
                while($row = mysqli_fetch_array($qr)){
                    ?>
                     <tr>
                      <td><?php echo $row["up_name"]; ?></td>
                      <td><?php echo $row["up_dec"]; ?></td>
                      <td><a href="download.php?id=<?php echo $row['up_id']; ?>">download</a></td>
                      <td><input type="hidden" id="file" value="<?php echo $row['up_id']; ?>"><a class="btn btn-success" id="bnt3" onclick="edit(<?php echo $row['up_id'];?>,this)">edit</a></td>
                    <td><a class="btn btn-danger" id="bnt4" onclick="delet(<?php echo $row['up_id'];?>,this)">delete</a></td>
                     </tr>
                    <?php
                }
                }

           ?>
         </div>
       </table>
   </div>
</div>
<div class="modal2" id="modal">

</div>

<!-- add document details --->
<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add New Document </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
          <form action="document.php" method="post" enctype="multipart/form-data"> 
        
          <div class="col-md-12">
               <div class="form">
                   <form action="document.php" method="post" enctype="multipart/form-data">
                   <div class="form-group">
                       <label for="">upload name</label>
                       <input type="text" name="up_name" class="form-control" id="upl_name">
                   </div>
                   <div class="form-group">
                       <label for="">upload description</label>
                       <input type="text" name="up_desc" class="form-control" id="upl_dec">
                   </div>
                   <div class="form-group">
                       <label for="">files</label>
                       <input type="file" name="up_file" class="form-control" id="upl_name">
                   </div>
                   <div class="form-group">
                       <input type="submit" class="btn btn-primary" name="btn" value="upload" id="bnnn">
                   </div>
                   </form>
               </div>
            </div>
         </form>
    </div>
  </div>
</div>
<?php
if(isset($_POST['edit'])){
  ?>
  <script>
  alert("goood");
  </script>
  <?php
}
?>

<script src="js/jquery.min.js"></script>
 <script src="js/popper.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/style.js"></script> 
 <script>
    let edit = (x,y)=>{
      let modal2  = document.getElementById("modal");
      let value_id  = x;
      $.ajax({
        method:"POST",
        url:"edit.php",
        data:{value_id:value_id},
        success: function(data){
          modal2.innerHTML= data.trim();
          modal2.style.display="block";
        }
      })
    }
    let edit2 = ()=>{
      let modal2  = document.getElementById("modal");
      modal2.style.display="none";
    }
    let delet = (y,z)=>{
      let val = y;
      $.ajax({
        method:"POST",
        url:"delete.php",
        data:{y:y},
        success: function(data){
          if(data.trim() === "deleted"){
            location.reload();
          }
        }
      })
    }
    
 </script>
</body>
</html>