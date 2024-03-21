<?php
    require('top.inc.php');

    $sql = "SELECT * FROM users  WHERE deleted='NO' order by id desc";
    $res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Order </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                           <table class="table">
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
                                                $res = mysqli_query($con,"SELECT `order`.*,order_status.name as order_status_str FROM `order`,order_status WHERE order_status.id=`order`.order_status");
                                                while($row=mysqli_fetch_assoc($res))
                                                {
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="order_master_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
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
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>

          
<?php
    require('footer.inc.php');
?>
         