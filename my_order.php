<?php 
    require('top.php');
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
                                                <th class="product-remove"><span class="nobr">Order Id</span></th>
                                                <th class="product-thumbnail">Order Date</th>
                                                <th class="product-name"><span class="nobr">Address</span></th>
                                                <th class="product-price"><span class="nobr"> Payment Type </span></th>
                                                <th class="product-price"><span class="nobr"> Payment Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $uid=$_SESSION['USER_ID'];
                                                $res = mysqli_query($con,"SELECT `order`.*,order_status.name as order_status_str FROM `order`,order_status WHERE `order`.user_id='$uid' and order_status.id=`order`.order_status");
                                                while($row=mysqli_fetch_assoc($res))
                                                {
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="my_order_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                                                <td class=""><span><?php echo $row['added_on']; ?></span></td>
                                                <td class=""><span>
                                                    <?php echo $row['address']; ?><br/>
                                                    <?php echo $row['city']; ?><br/>
                                                    <?php echo $row['pincode']; ?><br/>
                                                </span></td>
                                                <td class=""><span><?php echo $row['payment_type']; ?></span></td>
                                                <td class=""><span><?php echo $row['payment_status']; ?></span></td>
                                                <td class=""><span><?php echo $row['order_status_str']; ?></span></td>

                                            </tr>
                                            <?php } ?>
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