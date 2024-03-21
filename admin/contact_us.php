<?php
    require('top.inc.php');

    if(isset($_GET['type']) && $_GET['type']!=''){
        
        $type=get_safe_value($con,$_GET['type']);

        if($type=='status')
        {
            $operation=get_safe_value($con,$_GET['operation']);
            $id=get_safe_value($con,$_GET['id']);
            if($operation=='SEEN'){
                $status='0';
            }
            $update_status_sql="UPDATE contact_us SET status='$status' WHERE id='$id'";
            mysqli_query($con,$update_status_sql);
            header('location:contact_us.php');
            die();
        }

        if($type=='delete')
        {
            $id=get_safe_value($con,$_GET['id']);
            $delete_sql="UPDATE contact_us SET deleted='YES' WHERE id='$id'";
            mysqli_query($con,$delete_sql);
            header('location:contact_us.php');
            die();
        }
    }
    $sql = "SELECT * FROM contact_us  WHERE deleted='NO' order by id desc";
    $res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Contact Us </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Mobile</th>
                                       <th>Query</th>
                                       <th>Date</th>
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
                                       <td><?php echo $row['email']; ?></td>
                                       <td><?php echo $row['mobile']; ?></td>
                                       <td><?php echo $row['comment']; ?></td>
                                       <td><?php echo $row['added_on']; ?></td>
                                       <td>
                                       <?php
                                             if($row['status']==1){?>
                                                <span class="badge badge-unseen">
                                                <?php
                                                echo "<a href='?type=status&operation=SEEN&id=".$row['id']."'>NEW</a>&nbsp";
                                                ?>
                                                </span>
                                                <?php
                                                }else{?>
                                                    <span class="badge badge-seen">
                                                    <?php
                                                echo "<a href='#'>SEEN</a>&nbsp";}
                                                ?>
                                                </span>
                                                
                                       </td>
                                       <td>
                                          <span class="badge badge-delete">
                                          <?php echo "<a href='?type=delete&id=".$row['id']."'>Delete</a>&nbsp"; ?>
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