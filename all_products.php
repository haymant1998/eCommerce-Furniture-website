<?php
include("includes/db.php");
include("functions/functions.php");
include("header.php");
?>

    <!--Content starts-->
    <div class="content_wrapper">
        <div id="left_sidebar">            
            <ul id="cats">
              <h2 id="sidebar_title"> Categories </h2>
              <?php
                  getCats();
               ?>
            </ul>

            <ul id="cats">
              <h2 id="sidebar_title"> Brands </h2>
              <?php getBrands(); ?>

            </ul>

        </div>
        <div id="right_content">
          <?php cart(); ?>
          <div id="headline">
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
             <div id="products_box">
                <?php getPro(); getCatpro(); getBrandPro(); ?>
            </div>


        </div>





    </div>
    <!--Content ends-->


<?php include("footer.php"); ?>
