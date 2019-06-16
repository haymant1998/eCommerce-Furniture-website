<?php
//session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
 ?>
<?php
include ("includes/db.php");
if (isset($_GET['edit_brand'])){
  $brand_id=$_GET['edit_brand'];
  $edit_brand="select * from brands where brand_id='$brand_id'";
  $run_edit=mysqli_query($con,$edit_brand);
  $row_edit=mysqli_fetch_array($run_edit);
  $brand_title=$row_edit['brand_title'];
  $brand_edit_id=$row_edit['brand_id'];
}
 ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title></title>
  <style type="text/css">
  form {margin:15%;}
  </style>
</head>
<body>
  <form action="" method="post">
    <b>Edit this Brand </b>
    <input type="text" name="brand_title1" value="<?php echo $brand_title; ?>"/>
    <input type="submit"  name="update_brand" value="Update Brand" />
  </form>

</body>
</html>
<?php
if(isset($_POST['update_brand'])){
  $brand_title123=$_POST['brand_title1'];
  $update_brand="update Brands set brand_title='$brand_title123' where brand_id='$brand_edit_id'";
  $run_update=mysqli_query($con,$update_brand);
  if($run_update){
    echo "<script>alert('Brand has been updated successfully.')</script>";
    echo "<script>window.open('index.php?view_brands','_self')</script>";
  }
}


 ?>
<?php } ?>
