<?php

include("includes/db.php");
include("functions/functions.php");
//Getting customer
if(isset($_GET['c_id'])){
  $customer_id=$_GET['c_id'];
  $c_email="select * from customers where customer_id='$customer_id'";
  $run_email=mysqli_query($con,$c_email);
  $r_email=mysqli_fetch_array($run_email);
  $customer_email=$r_email['customer_email'];
  $customer_name=$r_email['customer_name'];
}

//Getting product price and quantity of items
$ip_add=getRealIpAddr();
$total=0;
$ip_add=getRealIpAddr();
$sel_price="select * from cart where ip_add='$ip_add'";
$run_price=mysqli_query($db,$sel_price);
$status='Pending';
$invoice_no=mt_rand(1,1000);//Generate Random no. for invoice no. between 1 to 1000
$i=0;
$count_pro=mysqli_num_rows($run_price);
while($record=mysqli_fetch_array($run_price)){
  $pro_id=$record['p_id'];

  $pro_price="select * from products where product_id='$pro_id'";
  $run_pro_price=mysqli_query($db,$pro_price);

  while($p_price=mysqli_fetch_array($run_pro_price)){
    $product_name=$p_price['product_title'];
    $product_price=array($p_price['product_price']);
    $values=array_sum($product_price);
    $total=$total+$values;
    $i++;
  }
}
//Getting Quantity from the Cart
$get_cart="select * from cart";
$run_cart=mysqli_query($con,$get_cart);
$get_qty=mysqli_fetch_array($run_cart);
$qty=$get_qty['qty'];
if($qty==0) {
  $qty=1;
  $sub_total=$total;
}
else {
  $qty=$qty;
  $sub_total=$total*$qty;
}
$insert_order="insert into customer_orders (customer_id,due_amount,invoice_no,total_products,order_date,order_status) values ('$customer_id','$sub_total','$invoice_no','$count_pro',NOW(),'$status')";
$run_order=mysqli_query($con,$insert_order);

  $empty_cart="delete from cart where ip_add='$ip_add'";
  $run_empty=mysqli_query($con,$empty_cart);
  $insert_to_pending_orders="insert into pending_order (customer_id,invoice_no,product_id,qty,order_status) values ('$customer_id','$invoice_no','$pro_id','$qty','$status')";
  $run_pending_order=mysqli_query($con,$insert_to_pending_orders);

  $from="admin@mysite.com";
  $subject="Order Details";
  $message="
    <html>
    <p>Hello $customer_name, You have ordered following products on our website, Please find your order details below and pay the dues as soon as possible.</p>
      <table width='600' align='center' bgcolor='#E3A587' border='2'>
        <tr><td><h2>Your order Details from mysite.com</h2></td></tr>
        <tr>
          <th><b>S.N</b></th>
          <th><b>Product Name</b></th>
          <th><b>Quantity</b></th>
          <th><b>Total Price</b></th>
          <th><b>Invoice No.</b></th>
        </tr>
        <tr>
          <td>$i</td>
          <td>$product_name</td>
          <td>$qty</td>
          <td>$sub_total</td>
          <td>$invoice_no</td>
        </tr>
      </table>
      <h3>Please go to your account and pay the dues.</h3>
      <h2><a href='mysite.com'>Click here</a> to login to yout account.</h2>
      <h3>Thank you for ordering on www.mysite.com</h3>
    </html



  ";
  mail($customer_email,$subject,$message,$from);
  echo "<script>alert('Your order has been placed successfully. Your order details have been sent to $customer_email.')</script>";
  echo "<script>window.open('customer/my_account.php','_self')</script>";
 ?>
