<!DOCTYPE html>
<html>
  <head>
      <title>Payment Options</title>
  </head>
  <body>
    <?php
    include("includes/db.php");
    ?>
    <?php
    $ip=getRealIpAddr();
    $get_customer="select * from customers where customer_ip='$ip'";
    $run_customer=mysqli_query($con,$get_customer);
    $customer=mysqli_fetch_array($run_customer);
    $customer_id=$customer['customer_id'];
     ?>

<div align="center" style="padding:0px;width: 120%;">

  <h2>Payment Options for you.</h2><hr>
<b>Pay with </b><br><a href="http://www.paypal.com"><img src="images/paypal.png" width="200" height="80"></a> <b> <br> Or <a href="order.php?c_id=<?php echo $customer_id; ?>">Cash On Delivery</a></b>
<br>
<b> If you selected "Pay Offline" option, then please check your email or account to find the Invoice No. for your order.</b>
</div>
</body>
</html>
