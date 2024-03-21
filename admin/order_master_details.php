<?php
    require('top.inc.php');
    $order_id=get_safe_value($con,$_GET['id']);
    if(isset($_POST['update_order_status']))
    {
        $update_order_status=$_POST['update_order_status'];
        mysqli_query($con,"UPDATE `order` SET order_status='$update_order_status' WHERE id='$order_id'");
    }
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Order details </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                           <table class="table">
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
                                                $res = mysqli_query($con,"SELECT distinct(order_details.id),order_details.*,product.name,product.image,`order`.user_id,`order`.address,`order`.city,`order`.pincode,`order`.order_status FROM order_details,product,`order` WHERE order_details.order_id='$order_id' AND product.id=order_details.product_id ");
                                                $total_price=0;
                                                while($row=mysqli_fetch_assoc($res))
                                                {
                                                    $address=$row['address'];
                                                    $city=$row['city'];
                                                    $pincode=$row['pincode'];
                                                    $total_price=$total_price+($row['qty']*$row['price']);
                                                    $order_status=$row['order_statuss'];
                                                    
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

                                    <div id="address_details">
                                        <strong>Address: </strong>
                                        <?php echo $address; ?>,<?php echo $city; ?>,<?php echo $pincode; ?><br><br>
                                        <strong>Order Status: </strong>
                                        <?php
                                            $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"SELECT order_status.name FROM order_status,`order` WHERE `order`.id='$order_id' AND `order`.order_status=order_status.id"));
                                            echo $order_status_arr['name'];
                                        ?>
                                        <div>
                                            <form method="post"> 
                                            <select class="form-control" name="update_order_status">
                                                <option>Select Status</option>
                                                <?php
                                                $res=mysqli_query($con,"SELECT * FROM order_status");
                                                while($row=mysqli_fetch_assoc($res)){
                                                    if($row['id']==$order_id){
                                                        echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                                    }else{
                                                        echo "<option value=".$row['id'].">".$row['name']."</option>";
                                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <input type="submit" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

          
<?php
    require('footer.inc.php');
?>
         