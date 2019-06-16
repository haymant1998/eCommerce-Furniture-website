<?php
include ("includes/db.php");

//Getting the customer Id
$c=$_SESSION['customer_email'];
$get_c="select * from customers where customer_email='$c'";
$run_c=mysqli_query($db,$get_c);
$row_c=mysqli_fetch_array($run_c);
$customer_id=$row_c['customer_id'];





 ?>
<h1><center>All Order Details</center></h1>
<table width="750" align="center" bgcolor="rgb(167, 225, 233)">
  <tr>
    <th>Order No.</th>
    <th>Due Amount</th>
    <th>Invoice No.</th>
    <th>Total products</th>
    <th>Order Date</th>
    <th>Paid/Unpaid</th>
    <th>Status</th>
  </tr>
  <?php
    $get_orders="select * from customer_orders where customer_id='$customer_id'";
    $run_orders=mysqli_query($con,$get_orders);
    $i=0;
    while($row_orders=mysqli_fetch_array($run_orders)){
      $order_id=$row_orders['order_id'];
      $due_amount=$row_orders['due_amount'];
      $invoice_no=$row_orders['invoice_no'];
      $products=$row_orders['total_products'];
      $date=$row_orders['order_date'];
      $status=$row_orders['order_status'];
      $i++;
      if($status=='Pending'){
        $status='Unpaid';
      }
      else {
        $status='Paid';
      }
      echo "
        <tr align='center'>
          <td>$i</td>
          <td>$due_amount</td>
          <td>$invoice_no</td>
          <td>$products</td>
          <td>$date</td>
          <td>$status</td>
          <td><a href='confirm.php?order_id=$order_id'>Confirm if Paid</a></td>
        </tr>


      ";
    }



   ?>


</table>
