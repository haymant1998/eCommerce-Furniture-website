<?php

include("includes/db.php");
include("functions/functions.php");
include("header.php");
if(!isset($_SESSION['customer_email']))
{
  echo "<script>window.open('../checkout.php','_self')</script>";
}
$customer_name = "";
 ?>



    <!--Content starts-->
    <div class="content_wrapper">
        <div id="left_sidebar">
            <div id="sidebar_title"> Manage Account : </div>
            <ul id="cats">
              <?php
                if(isset($_SESSION['customer_email'])){
                  $customer_session=$_SESSION['customer_email'];
                  $get_customer_pic="select * from customers where customer_email='$customer_session'";
                  $run_customer=mysqli_query($con,$get_customer_pic);
                  $row_customer=mysqli_fetch_array($run_customer);
                  $customer_pic=$row_customer['customer_image'];
                  $customer_name=$row_customer['customer_name'];
                  echo "<img src='customer_photos/$customer_pic' width='150' height='150' >";
                }
               ?>
              <li><a href="my_account.php?my_orders">My Orders</a></li>
              <li><a href="my_account.php?edit_account">Edit Account</a></li>
              <li><a href="my_account.php?change_pass">Change Password</a></li>
              <li><a href="my_account.php?delete_account">Delete Account</a></li>
              <li><a href="../logout.php">Logout</a></li>

            </ul>

        </div>
        <div id="right_content">
          <?php cart(); ?>
            <div id="headline">
                <div id="headline_content">

                      <?php

                      if(!isset($_SESSION['customer_email'])){
                        echo "<b>Welcome: Guest  </b>";
                          echo "<a href='../checkout.php' style='color:rgb(223, 165, 51);'> Login</a>";
                      }
                        else {
                          echo "<b>Welcome: "."</b>"."<b style='color:yellow;'>".$customer_name."</b>";
                          
                        }

                       ?>
                    </span>



                </div>
            </div>
            <!--Headline ends her-->

            <div>
             
              <?php getDefault(); ?>
              <?php

                if(isset($_GET['my_orders']))
                {
                  include ("my_orders.php");
                }
                if(isset($_GET['edit_account']))
                {
                  include ("edit_account.php");
                }
                if(isset($_GET['change_pass']))
                {
                  include ("change_pass.php");
                }
                if(isset($_GET['delete_account']))
                {
                  include ("delete_account.php");
                }
               ?>

            </div>


        </div>





    </div>
    <!--Content ends-->


  <?php include("footer.php"); ?>
