<?php
session_start();
include("includes/db.php");
if(isset($_GET['order_id'])){
  $order_id=$_GET['order_id'];
}
 ?>
 <!DOCTYPE HTML>
 <html>
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <title></title>
 </head>
 <body bgcolor="black">
   <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post">
     <table width="500" align="center" border="2" bgcolor="grey">
       <tr align="center">
         <td colspan="5"><h2>Please Confirm your payment.</h2></td>
       </tr>
       <tr>
         <td align="right">Invoice No.</td>
         <td><input type="text" name="invoice_no"/></td>
       </tr>
       <tr>
         <td align="right">Amount Sent: </td>
         <td><input type="text" name="amount"/></td>
       </tr>

       <tr>
         <td align="right">Select Payment Mode: </td>
         <td><select name="payment_method">
           <option>Select Payment</option>
           <option>Bank Transfer</option>
           <option>Easypay/UBL Transfer</option>
           <option>Western Union</option>
           <option>Paypal</option>
         </select>
         </td>
       </tr>
       <tr>
         <td align="right">Transaction Reference ID:</td>
         <td><input type="text" name="tr"/></td>
       </tr>
       <tr>
         <td align="right">Easypay/UBLOMNI Code:  </td>
         <td><input type="text" name="code"/></td>
       </tr>
       <tr>
         <td align="right">Payment Date: </td>
         <td><input type="text" name="date"/></td>
       </tr>
       <tr align="center">
         <td colspan="5"><input type="submit" name="confirm" value="Confirm Payment"/></td>
       </tr>
     </table>
   </form>
 </body>
 </html>
<?php
if(isset($_POST['confirm'])){
  $update_id=$_GET['update_id'];
  $invoice=$_POST['invoice_no'];
  $amount=$_POST['amount'];
  $payment_method=$_POST['payment_method'];
  $ref_no=$_POST['tr'];
  $code=$_POST['code'];
  $date=$_POST['date'];
  $complete='Complete';
  $insert_payment="insert into payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) values ('$invoice','$amount','$payment_method','$ref_no','$code','$date')";
  $run_payment=mysqli_query($con,$insert_payment);
  if($run_payment){
    echo "<h2 style='text-align:center;color:white;'>Payment received, your order will be completed within 24 hours.</h2>";
  }
  $update_order="update customer_orders set order_status='$complete' where order_id='$update_id'";
  $run_order=mysqli_query($con,$update_order);
  $update_pending_order="update pending_order set order_status='$complete' where order_id='$update_id'";
  $run_pending_orders=mysqli_query($con,$update_pending_order);
}
?>
