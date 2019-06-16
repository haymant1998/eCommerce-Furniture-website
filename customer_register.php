<?php
include("includes/db.php");
include("functions/functions.php");
include("header.php");
?>

</head>

    <!--Content starts-->
   
        <div id="right_content_2">
          <?php cart(); ?>
            <div id="headline">
                <div id="headline_content">
                    <b>Welcome Guest</b>
                    <b style="color:yellow;">Shopping Cart</b>
                    <span>-  Total Items: <?php items(); ?> - Total Price: $ <?php total_price(); ?>
                    <a class="cart_img"  href="cart.php" style="float:right;margin-left: 5px;"><img src="images/Cart-Icon.png" width="30px" height="30px"></a></span>
                    



                </div>
            </div>
            <!--Headline ends her-->

                <div class="container">
                <form id="register_form" action="customer_register.php" method="post" enctype="multipart/form-data"/>
                <div class="row">
                  <div class="col-25">
                    <label for="fname">Customer Name</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_name" required placeholder="Your name..">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer E-mail</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_email" required placeholder="Your email Address..">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Password</label>
                  </div>
                  <div class="col-75">
                    <input type="password" name="c_pass" required placeholder="Choose your password..">
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="country">Country</label>
                  </div>
                  <div class="col-75">
                    <select name="c_country">
                            <option>Select a Country</option>
                            <option>Canada</option>
                            <option>United States of America</option>
                            <option>India</option>
                            <option>Mexico</option>
                            <option>Panama</option>
                          </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer City</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_city" required placeholder="Enter your city..">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Mobile No.</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_contact" required placeholder="Your Mobile No..">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Address</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_address" required placeholder="Your Address..">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Image</label>
                  </div>
                  <div class="col-75">
                    <input type="file" name="c_image" required placeholder="Your Address..">
                  </div>
                </div>
                
                <div class="row">
                  <input type="submit" name="register" value="Submit">
                </div>
                </form>
              </div>

            
        </div>





    </div>
    <!--Content ends-->


    <?php include("footer.php"); ?>
    
    <!-- Footer of site Ends Here-->
  </div>
  <!--Main Container ends -->
</body>
</html>
<?php

if(isset($_POST['register'])){
  $c_name=$_POST['c_name'];
  $c_email=$_POST['c_email'];
  $c_pass=$_POST['c_pass'];
  $c_country=$_POST['c_country'];
  $c_city=$_POST['c_city'];
  $c_contact=$_POST['c_contact'];
  $c_address=$_POST['c_address'];
  $c_image=$_FILES['c_image']['name'];
  $c_image_tmp=$_FILES['c_image']['tmp_name'];
  $c_ip=getRealIpAddr();

  $insert_customer="insert into customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) values ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image','$c_ip')";
  $run_customer=mysqli_query($con,$insert_customer);
  move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");
  $sel_cart="select * from cart where ip_add='$c_ip'";
  $run_cart=mysqli_query($con,$sel_cart);
  $check_cart=mysqli_num_rows($run_cart);
  if($check_cart>0){
    $_SESSION['customer_email']=$c_email;
    echo "<script>alert('Account created successfully, Thank You !!')</script>";
    echo "<script>window.open('all_products.php','_self')</script>";
  }
  else {
    {
      $_SESSION['customer_email']=$c_email;
      echo "<script>alert('Account created successfully, Thank You !!')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }
}


 ?>
