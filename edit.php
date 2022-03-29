<?php
include("css/conn.php");
$id = $_POST['value_id'];
$select = "select * from login where up_id='$id'";
$qr = mysqli_query($conn,$select);
$count = mysqli_num_rows($qr);
$result = mysqli_fetch_array($qr);
?>
 <div class="modal-content2">
 <div class="card-header">
    edit document information
    <a  id="close" onclick="edit2()">x</a>
  </div>
  <form action="document.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="$">Document name</label>
      <input type="text" placeholder="<?php echo $result['up_name'];?>" class="form-control">
    </div>
    <div class="form-group">
      <label for="$">Document name</label>
      <input type="text" placeholder="<?php echo $result['up_dec'];?>" class="form-control">
    </div>
    <div class="form-group">
      <label for="$">Document name</label>
      <input type="file"  class="form-control">
    </div>
    <div class="form-group">
     <input type="submit" name="edit" id="em" class="btn btn-success">
    </div>
  </form>
 
 </div>
<style>
#em{
margin-left:240px;
}
</style>
<?php
?>