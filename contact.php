<?php
$db = mysqli_connect("localhost","root","","myshop");
if(isset($_POST['contacts'])){
  //print_r($_POST);
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $u_email = $_POST['u_email'];
  $u_phone = $_POST['u_phone'];
  $u_msg = $_POST['u_msg'];
  $insertval = "INSERT INTO shopcontact (fname, lname, email, phone, msg) values ('$f_name','$l_name', '$u_email', '$u_phone', '$u_msg')";
 $run_customer = mysqli_query($db,$insertval);
  if($run_customer) {
    echo "<script>alert('Your message has been submitted successfully, Thank You !!')</script>";
    echo "<script>window.open('index.php','_self')</script>";
  }
}
include("includes/db.php");
include("functions/functions.php");
include("header.php");
?>

    

        </div>
        <div id="right_content_2">
          <?php cart(); ?>
            <div id="headline" style="padding: 8px 6px;">
                <div id="headline_content">
                    <?php
                        if(!isset($_SESSION['customer_email'])){
                          echo "<b>Welcome Guest !</b> <b style='color:yellow;'>Shopping Cart</b>";
                        }
                        else {
                          echo "<b>Welcome: " ."<span style='color:pink;'>". $_SESSION['customer_email']."</span></b>"."<b style='color:yellow;'>Your Shopping Cart</b>";
                        }
                     ?>


                    <span>-  Total Items: <?php items(); ?> - Total Price: $ <?php total_price(); ?>
                  <a class="cart_img"  href="cart.php" style="float:right;margin-left: 5px;"><img src="images/Cart-Icon.png" width="30px" height="30px"></a>
                   
                  </span>



                </div>
            </div>
            <!--Headline ends her-->

            <div>
                <section class="sections_wraps" id="sec_fifth">
                    <div class="sec_header">
                      <h2>CONTACT US</h2>
                      <p class="sub_title">Share you experience. Lets Talk!</p>
                    </div>  
                    <div class="contact_wrap contact_form">
                      <div class="form_success"></div>
                      <div class="form_errors"></div>
                      <form action="" name="contact_form" id="contact_form" method="post">
                        <div class="full_one">
                          <div class="form_field">
                            <label for="first_name">First Name:</label>
                            <input type="text" name='f_name' tabindex="1" required autofocus>
                          </div>
                          <div class="form_field">
                            <label for="last_name">Last Name:</label>
                            <input type="text" name='l_name' tabindex="1" required >
                          </div>
                        </div>
                        <div class="full_one">
                          <div class="form_field">
                            <label for="email">Email:</label>
                                <input type="email" name='u_email' tabindex="2" required>
                          </div>
                          <div class="form_field">
                            <label for="phone">Phone: (999-999-9999)</label>
                             <input placeholder="999-999-9999" type="tel" pattern="^\d{3}-\d{3}-\d{4}$" name='u_phone' tabindex="3" required>
                          </div>
                        </div>
                        
                            <div class="form_field form_full">
                              <label for="comment">Share your thoughts.....</label>
                               <textarea placeholder="Type your message here...." tabindex="5" name='u_msg' required></textarea>
                            </div>
                        <div class="form_field btn_submit">
                          <input name="contacts" type="submit" id="submit" value="Submit">
                        </div>
                      </form>
                    </div>  
                  </section>

            </div>


        </div>

<?php include("footer.php"); 



?>

