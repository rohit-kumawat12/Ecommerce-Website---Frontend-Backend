<?php
    require('top.inc.php');

    if(isset($_GET['type']) && $_GET['type']!=''){
        
        $type=get_safe_value($con,$_GET['type']);

        

        if($type=='delete')
        {
            $id=get_safe_value($con,$_GET['id']);
            $delete_sql="UPDATE users SET deleted='YES' WHERE id='$id'";
            mysqli_query($con,$delete_sql);
            header('location:users.php');
            die();
        }
    }
    $sql = "SELECT * FROM users  WHERE deleted='NO' order by id desc";
    $res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Users </h4>
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
                                       <th>Date</th>
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
                                       <td><?php echo $row['added_on']; ?></td>
                                       
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
         