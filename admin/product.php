<?php
    require('top.inc.php');

    if(isset($_GET['type']) && $_GET['type']!=''){
        
        $type=get_safe_value($con,$_GET['type']);
        if($type=='status')
        {
            $operation=get_safe_value($con,$_GET['operation']);
            $id=get_safe_value($con,$_GET['id']);
            if($operation=='active'){
                $status='1';
            }else{
                $status='0';
            }
            $update_status_sql="UPDATE product SET status='$status' WHERE id='$id'";
            mysqli_query($con,$update_status_sql);
            header('location:product.php');
            die();
        }

        if($type=='delete')
        {
            $id=get_safe_value($con,$_GET['id']);
            $delete_sql="UPDATE product SET deleted='YES' WHERE id='$id'";
            mysqli_query($con,$delete_sql);
            header('location:product.php');
            die();
        }
    }
    $sql = "SELECT product.*,categories.categories FROM product,categories  WHERE product.categories_id=categories.id AND product.deleted='NO' order by product.id desc";
    $res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Products </h4>
                           <h4 class="box-link"> <a href="manage_product.php"> Add Product </a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Categories</th>
                                       <th>Image</th>
                                       <th>MRP</th>
                                       <th>Price</th>
                                       <th>Qty</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                     $i =1;
                                     while($row=mysqli_fetch_assoc($res)) {?>
                                    <tr>
                                       <td class="serial"><?php echo $i++; ?></td>
                                       <td><?php echo $row['id']; ?></td>
                                       <td><?php echo $row['name']; ?></td>
                                       <td><?php echo $row['categories']; ?></td>
                                       <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']; ?>" alt="<?php echo $row['image']; ?>"></td>
                                       <td><?php echo $row['mrp']; ?></td>
                                       <td><?php echo $row['price']; ?></td>
                                       <td><?php echo $row['qty']; ?></td>
                                       <td>
                                       <?php
                                             if($row['status']==1){?>
                                                <span class="badge badge-complete">
                                                <?php
                                                echo "<a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>&nbsp";
                                                ?>
                                                </span>
                                                <?php
                                                }else{?>
                                                    <span class="badge badge-pending">
                                                    <?php
                                                echo "<a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a>&nbsp";}
                                                ?>
                                                </span>
                                                
                                       </td>
                                       <td>
                                          <span class="badge badge-delete">
                                          <?php echo "<a href='?type=delete&id=".$row['id']."'>Delete</a>&nbsp"; ?>
                                          </span>
                                          <span class="badge badge-edit">
                                          <?php echo "<a href='manage_product.php?id=".$row['id']."'>Edit</a>&nbsp"; ?>
                                          </span>
                                       </td>
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
         