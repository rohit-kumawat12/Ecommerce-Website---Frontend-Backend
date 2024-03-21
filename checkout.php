<?php 
    require('top.php');
    if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
    ?>
        <script>
            window.location.href='index.php';
        </script>
    <?php
    }


    $cart_total=0;
    foreach($_SESSION['cart'] as $key=>$val){
        $productArr=get_product($con,'','',$key);
        $price=$productArr[0]['price'];
        $qty=$val['qty'];
        $cart_total=$cart_total + ($price*$qty);
    }

    if(isset($_POST['submit']))
    {
        $address=get_safe_value($con,$_POST['address']);
        $city=get_safe_value($con,$_POST['city']);
        $name=get_safe_value($con,$_POST['name']);
        $pincode=get_safe_value($con,$_POST['pincode']);
        $email=get_safe_value($con,$_POST['email']);
        $mobile=get_safe_value($con,$_POST['mobile']);
        $payment_type=get_safe_value($con,$_POST['payment_type']);
        $user_id=$_SESSION['USER_ID'];
        $payment_status='1';
        $total_price=get_safe_value($con,$cart_total);
        if($payment_type=='cod')
        {
        $payment_status='success';
        }else{

        }
        $order_status='1';
        $added_on=date('Y-m-d h:i:s');

        mysqli_query($con,"INSERT INTO `order`(`user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) VALUES ('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')");

        $order_id=mysqli_insert_id($con);

        foreach($_SESSION['cart'] as $key=>$val){
            $productArr=get_product($con,'','',$key);
            $price=$productArr[0]['price'];
            $qty=$val['qty'];
        

        mysqli_query($con,"INSERT INTO `order_details`(`order_id`, `product_id`, `qty`, `price`) VALUES ('$order_id','$key','$qty','$price')");

        }

        unset($_SESSION['cart']);
        ?>
        <script>
            window.location.href='thank_you.php';
        </script>
        <?php

        
    }
?>

                    <!-- Start Cart Panel -->
                    <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    
                                    <?php
                                        $accordion_class='accordion__title'; 
                                        if(!isset($_SESSION['USER_LOGIN'])){
                                            $accordion_class='accordion__hide';
                                    ?>
                                        <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                    <form id="login-form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">											
                                                                <input type="text" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                                                <span class="field_error" id="email_login_error"></span>
                                                            </div>

                                                            <div class="single-input">
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                                                <span class="field_error" id="password_login_error"></span>
                                                            </div>

                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                            </div>
                                                        </form>
                                                        
								<div class="form-output" id="login_msg">
									<p class="form-messege"></p>
								</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                            <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                                            <span class="field_error" id="name_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                            <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:100%">
                                                            <span class="field_error" id="mobile_error"></span>
                                                            </div>
															<div class="single-input">
                                                            <input type="email" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                                            <span class="field_error" id="email_error"></span>
                                                            </div>


															
                                                            <div class="single-input">
                                                            <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                                            <span class="field_error" id="password_error"></span>
                                                            </div>
                                                            <div class="dark-btn">
                                                            <button type="button" class="fv-btn" onclick="user_register()">Register</button>
                                                            </div>
                                                        </form>
                                                        
								<div class="form-output" id="register_msg">
									<p class="form-messege field_error"></p>
								</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="<?php echo $accordion_class;?>">
                                        Address Information
                                    </div>
                                    <form method="post">
                                    <div class="accordion__body">
                                        <div class="bilinfo">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="name" placeholder="First name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="email" name="email" placeholder="Email address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="mobile" placeholder="Phone number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                    <div class="<?php echo $accordion_class;?>">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                COD <input type="radio" name="payment_type" value="cod" required>
                                                &nbsp;
                                                PayU <input type="radio" name="payment_type" value="payu" required>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="single-method">
                                                <input type="submit" name="submit" value="submit">
                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            <?php 
                            $cart_total=0;
                                            foreach($_SESSION['cart'] as $key=>$val){
                                                $productArr=get_product($con,'','',$key);
                                                $pname=$productArr[0]['name'];
                                                $mrp=$productArr[0]['mrp'];
                                                $price=$productArr[0]['price'];
                                                $image=$productArr[0]['image'];
                                                $qty=$val['qty'];
                                                $cart_total=$cart_total + ($price*$qty);
                            ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image; ?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname; ?></a>
                                        <span class="price">₹ <?php echo $price*$qty; ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                                <?php } ?>
                                
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price">₹ <?php echo $cart_total; ?></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->

<?php 
    require('footer.php');
?>