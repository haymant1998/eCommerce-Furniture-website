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
    th,tr{border:3px groove black;}
  </style>
</head>
<body>
  <table width="794" align="center" bgcolor="#E8AE68">
    <tr align="center">
      <td colspan="6"><h2>View All Orders</h2></td>
    </tr>
    <tr align="center">
        <th>Order No.</th>
        <th>Customer</th>
        <th>Invoice No.</th>
        <th>Product ID</th>
        <th>QTY</th>
        <th>STATUS</th>
        <th>Delete</th>
    </tr>
    <?php
      include ("includes/db.php");
      $get_orders="select * from pending_order";
      $run_orders=mysqli_query($con,$get_orders);
      $i=0;
      while($row_orders=mysqli_fetch_array($run_orders)){
        $order_id=$row_orders['order_id'];
        $c_id=$row_orders['customer_id'];
        $invoice=$row_orders['invoice_no'];
        $p_id=$row_orders['product_id'];
        $qty=$row_orders['qty'];
        $status=$row_orders['order_status'];
        $i++;
        $c_email="select customer_email from customers where customer_id='$c_id'";
        $run_customer=mysqli_query($con,$c_email);
        $customer_email=mysqli_fetch_array($run_customer);
        $cs_email=$customer_email['customer_email'];
     ?>
    <tr align="center">
      <td><?php echo $i; ?></td>
      <td><?php echo $cs_email; ?></td>
      <td><?php echo $invoice; ?></td>
      <td><?php echo $p_id; ?></td>
      <td><?php echo $qty;; ?></td>
      <td><?php echo $status; ?></td>
      <td><a href="delete_order.php?delete_order=<?php echo $order_id; ?>">Delete</a></td>
    </tr>
  <?php } ?>
  </table>
</body>
</html>
<?php } ?>
