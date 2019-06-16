<?php
//session_start();
if(!isset($_SESSION['admin_email'])){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
 ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title></title>
  <style type="text/css">
  tr,th{ border:3px groove black;}
  </style>
</head>
<body>
  <table width="794" align="center" bgcolor="pink" border="2">
    <tr align="center">
      <td colspan="4"><h2 style="text-decoration:underline;color:green;font-size:25px;">View All Brands</h2></td>
    </tr>
    <tr>
      <th>Brand ID</th>
      <th>Brand Title</th>
      <th>Delete</th>
      <th>Edit</th>
    </tr>
    <?php
      include ("includes/db.php");
      $get_brands="select * from brands";
      $run_brands=mysqli_query($con,$get_brands);
      while($row_brands=mysqli_fetch_array($run_brands)){
        $brand_id=$row_brands['brand_id'];
        $brand_title=$row_brands['brand_title'];
    ?>
    <tr align="center">
      <td><?php echo $brand_id; ?></td>
      <td><?php echo $brand_title; ?></td>
      <td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
      <td><a href="index.php?delete_brand=<?php echo $brand_id; ?>">Delete</a></td>
    </tr>
  <?php } ?>
  </table>
</body>
</html>
<?php } ?>
