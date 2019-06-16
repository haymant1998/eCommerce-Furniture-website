<?php
include("includes/db.php");
include("functions/functions.php");
include("header.php");
?>

    <!--Content starts-->
    <div class="content_wrapper">
        <div id="left_sidebar">
            <div id="sidebar_title"> Categories </div>
            <ul id="cats">
              <?php
                  getCats();
               ?>

            </ul>

            <div id="sidebar_title"> Brands </div>
            <ul id="cats">
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
                    <span>-  Total Items: <?php items(); ?> - Total Price: $ <?php total_price(); ?><a href="all_products.php" style="color:yellow;"> Back to Shopping</a>
                    </span>



                </div>
            </div>
            <!--Headline ends her-->

            <div id="products_box" class='cart_box'>
                <form action="cart.php" method="post" enctype="multipart/form-data">
                    <table id="table_orders" bgcolor="antiquewhite">
                        <tr align="center">
                            <td><b>Remove</b></td>
                            <td><b>Product Image</b></td>
                            <td><b>Product(s)</b></td>
                            <td><b>Quantity</b></td>
                            <td><b>Total Price</b></td>
                        </tr>
                        <?php
                        $total=0;
                        $ip_add=getRealIpAddr();
                        $sel_price="select * from cart where ip_add='$ip_add'";
                        $run_price=mysqli_query($con,$sel_price);
                        while($record=mysqli_fetch_array($run_price)){
                          $pro_id=$record['p_id'];
                          $quantity=$record['qty'];
                          $pro_price="select * from products where product_id='$pro_id'";
                          $run_pro_price=mysqli_query($con,$pro_price);
                          while($p_price=mysqli_fetch_array($run_pro_price)){
                            $product_price=array($p_price['product_price']);
                            $product_title=$p_price['product_title'];
                            $product_image=$p_price['product_img1'];
                            $only_price=($p_price['product_price'])*$quantity;
                            $values=array_sum($product_price);
                            $total=$total+($values)*$quantity;

                         ?>
                        <tr>
                            <td><input type="checkbox" name="remove[]"  value="<?php echo $pro_id; ?>"></td>
                            <td><img style="border: 3px solid #fff;border-radius: 64px;" src="admin_area/product_images/<?php echo $product_image; ?>" height="80" width="80"><br/></td>
                            <td><?php echo $product_title;  ?></td>
                            <?php if(!isset($_POST['update'])) { ?><td><input type="text" name="qty" value="<?php echo $quantity; ?>" size="3"/></td><?php } ?>
                            <?php
                                if(isset($_POST['update']))
                                {

                                  $qty=$_POST['qty'];
                                  $only_price=($p_price['product_price'])*$qty;
                                  $insert_qty="update cart set qty='$qty' where ip_add='$ip_add'";
                                  $run_qty=mysqli_query($con,$insert_qty);
                                  $total=$total*$qty;
                                  echo "<td><input type='text' name='qty' value='$qty' size='3'/></td>";
                                }

                             ?>
                            <td><?php echo "$ ".$only_price; ?></td>
                        </tr>
                      <?php }} ?>
                      <tr>
                          <td colspan="4" align="right"><b>Sub Total:</b></td>
                          <td><b><?php echo "$".$total; ?></b></td>
                      </tr>
                      <tr align="center">
                          <td colspan="3"><a id='detail_link' href='all_products.php' style='float:left;'>Continue Shopping</a></td>
                          <td><input type="submit" id="btn_update" name="update" value="Update Cart"/></td>

                          <td><a id='add_cart_link' href="checkout.php" style="text-decoration:none;" ><span>Checkout</span></a></td>

                      </tr>

                    </table>
                </form>
            </div>
      <?php
      function updatecart(){
          global $con;

if(isset($_POST['update'])){
  foreach ($_POST['remove'] as $remove_id) {
    $delete_products="delete from cart where p_id='$remove_id'";
    $run_delete=mysqli_query($con,$delete_products);
    if($run_delete){
      echo "<script>window.open('cart.php','_self')</script";
    }
  }

}

if(isset($_POST['continue'])){
  echo "<script>window.open('all_products.php','_self')</script>";
}
}
 echo @$up_cart=updatecart();
       ?>

        </div>





    </div>
    <!--Content ends-->


 <?php include("footer.php"); ?>
