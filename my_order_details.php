<?php 
    require('top.php');
    $order_id=get_safe_value($con,$_GET['id']);

?>

<div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><span>Product Name</span></th>
                                                <th>Product Image</th>
                                                <th><span>Qty</span></th>
                                                <th><span>Price</span></th>
                                                <th><span>Total Price</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $uid=$_SESSION['USER_ID'];
                                                $res = mysqli_query($con,"SELECT distinct(order_details.id),order_details.*,product.name,product.image,`order`.user_id FROM order_details,product,`order` WHERE order_details.order_id='$order_id' AND `order`.user_id='$uid' AND product.id=order_details.product_id ");
                                                $total_price=0;
                                                while($row=mysqli_fetch_assoc($res))
                                                {
                                                    $total_price=$total_price+($row['qty']*$row['price']);
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="#"><?php echo $row['name']; ?></a></td>
                                                <td class="product-thumbnail"><span><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']; ?>" alt=""></span></td>
                                                <td class=""><span>
                                                    <?php echo $row['qty']; ?>
                                                </span></td>
                                                <td class=""><span><?php echo $row['price']; ?></span></td>
                                                <td class=""><span><?php echo $row['price']*$row['qty']; ?></span></td>

                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="">Total Price</td>
                                                <td class=""><?php echo $total_price; ?></td>

                                            </tr>
                                        </tbody>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php 
    require('footer.php');
?>