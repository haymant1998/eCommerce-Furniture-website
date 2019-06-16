<?php
@session_start();
include("includes/db.php");
if(isset($_GET['edit_account'])){
  $customer_email=$_SESSION['customer_email'];
  $get_customer="select * from customers where customer_email='$customer_email'";
  $run_customer=mysqli_query($con,$get_customer);
  $row=mysqli_fetch_array($run_customer);
  $id=$row['customer_id'];
  $name=$row['customer_name'];
  $email=$row['customer_email'];
  $pass=$row['customer_pass'];
  $country=$row['customer_country'];
  $city=$row['customer_city'];
  $contact=$row['customer_contact'];
  $address=$row['customer_address'];
  $image=$row['customer_image'];
}
 ?>

      
        <div class="container">
          <h2 align="center">Update your account:</h2>
                <form id="register_form" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-25">
                    <label for="fname">Customer Name</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_name" value="<?php echo $name; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer E-mail</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_email" value="<?php echo $email; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Password</label>
                  </div>
                  <div class="col-75">
                    <input type="password" name="c_pass" value="<?php echo $pass; ?>">
                  </div>
                </div>

                <div class="row">
                  <div class="col-25">
                    <label for="country">Country</label>
                  </div>
                  <div class="col-75">
                    <select name="c_country" disabled>
                            <option value="<?php echo $country; ?>"><?php echo $country; ?></option>
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
                    <input type="text" name="c_city" value="<?php echo $city; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Mobile No.</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_contact" value="<?php echo $contact; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Address</label>
                  </div>
                  <div class="col-75">
                    <input type="text" name="c_address" value="<?php echo $address; ?>">
                  </div>
                </div>
                <div class="row">
                  <div class="col-25">
                    <label for="lname">Customer Image</label>
                  </div>
                  <div class="col-75">
                    <input type="file" name="c_image" size="60"><img src="customer_photos/<?php echo $image; ?>" width="60" height="60">
                  </div>
                </div>
                
                <div class="row">
                  <input type="submit" name="update_account" value="Submit">
                </div>
                </form>
              </div>
 


<?php
  if(isset($_POST['update_account'])){
    $update_id=$id;
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_tmp=$_FILES['c_image']['tmp_name'];
    move_uploaded_file($c_image_tmp,"customer_photos/$c_image");
    $update_c="update customers set customer_name='$c_name',customer_email='$c_email',customer_pass='$c_pass',customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address',customer_image='$c_image' where customer_id='$update_id'";
    $run_c=mysqli_query($con,$update_c);
    if($run_c){
      echo "<script>alert('Your account has been updated.')</script>";
      echo "<script>window.open('my_account.php','_self')</script>";
    }
  }
?>
