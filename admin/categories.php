<?php
    require('top.inc.php');

   //  if(isset($_GET['type']) && $_GET['type']!=''){
        
   //      $type=get_safe_value($con,$_GET['type']);
   //      if($type=='status')
   //      {
   //          $operation=get_safe_value($con,$_GET['operation']);
   //          $id=get_safe_value($con,$_GET['id']);
   //          if($operation=='active'){
   //              $status='1';
   //          }else{
   //              $status='0';
   //          }
   //          $update_status_sql="UPDATE categories SET status='$status' WHERE id='$id'";
   //          mysqli_query($con,$update_status_sql);
   //          header('location:categories.php');
   //          die();
   //      }

   //      if($type=='delete')
   //      {
   //          $id=get_safe_value($con,$_GET['id']);
   //          $delete_sql="UPDATE categories SET deleted='YES' WHERE id='$id'";
   //          mysqli_query($con,$delete_sql);
   //          header('location:categories.php');
   //          die();
   //      }
   //  }
    $sql = "SELECT * FROM categories  WHERE deleted='NO' order by categories DESC";
    $res = mysqli_query($con,$sql);
    $sql1 = "SELECT * FROM categories  WHERE deleted='NO' && id='1000'";
    $res1 = mysqli_query($con,$sql1);
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Categories </h4>
                           <h4 class="box-link"> <a href="manage_categories.php"> Add Categories </a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th class="serial">Sr.</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $row1=mysqli_fetch_assoc($res1);
                                    $i=1;
                                    ?>
                                    <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row1['id']; ?></td>
                                    <td><?php echo $row1['categories']; ?></td>
                                    <td>
                                    <?php
                                       if($row1['status']==1)
                                       {
                                          ?>
                                          <input class="badge-complete btn-w" id="<?php echo 'status-btn-'.$row1['id'];?>" type="button" onclick="updatestatus('<?php echo $row1['id']?>')" value="Active">
                                          <?php
                                       }else{
                                          ?>
                                          <input class="badge-pending btn-w" id="<?php echo 'status-btn-'.$row1['id'];?>" type="button" onclick="updatestatus('<?php echo $row1['id']?>')" value="Deactive">
                                          <?php
                                       }
                                    ?>
                                    </td>
                                    <td>
                                       <input class="dis dis-red" type="button" value="Delete">
                                       <input class="dis dis-blue" type="button" value="Edit">
                                    </td>
                                    </tr>
                     
                                    <?php
                                     while($row=mysqli_fetch_assoc($res)) {?>
                                     <?php
                                     if($row['id']==1000)
                                     {

                                    
                                     }else{
                                       ?>
                                          <tr id="<?php echo 'deleteCat'.$row['id'];?>">
                                       <td class="serial"><?php echo $i++; ?></td>
                                       <td><?php echo $row['id']; ?></td>
                                       <td><?php echo $row['categories']; ?></td>
                                       <td>
                                       <?php

                                          if($row['status']==1)
                                          {
                                             ?>
                                             <input class="badge-complete btn-w" id="<?php echo 'status-btn-'.$row['id'];?>" type="button" onclick="updatestatus('<?php echo $row['id']?>')" value="Active">
                                             <?php
                                          }else{
                                             ?>
                                             <input class="badge-pending btn-w" id="<?php echo 'status-btn-'.$row['id'];?>" type="button" onclick="updatestatus('<?php echo $row['id']?>')" value="Deactive">
                                             <?php
                                          }

                                       ?>


                                       <?php
                                             // if($row['status']==1){?>
                                                <!-- <span class="badge badge-complete btn-w"> -->
                                                <?php
                                                // echo "<a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>&nbsp";
                                                ?>
                                                <!-- </span> -->
                                                <?php
                                                // }else{?>
                                                    <!-- <span class="badge badge-pending btn-w"> -->
                                                    <?php
                                                // echo "<a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a>&nbsp";}
                                                 ?>
                                                <!-- </span> -->




                                                
                                       </td>
                                       <td>
                                       <input class="badge-pending btn-w" type="button" onclick="deleteCat('<?php echo $row['id']?>')" value="Delete">
                                          <!-- <span class="badge badge-delete"> -->
                                             
                                          <?php 
                                          // echo "<a href='?type=delete&id=".$row['id']."'>Delete</a>&nbsp"; 
                                          ?>
                                          <!-- </span> -->
                                          <a  href='manage_categories.php?id=<?php echo $row['id']?>'>  <input class="btn-w badge-edit" type="button" value="Edit"></a>
                                        
                                          <!-- <span class="badge badge-edit"> -->
                                          <?php 
                                          // echo "<a href='manage_categories.php?id=".$row['id']."'>Edit</a>&nbsp"; 
                                          ?>
                                          <!-- </span> -->
                                       </td>
                                    </tr>
                                       <?php
                                     }
                                     ?>
                                    
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

          <script>
            $(".btn-w").css('width','70px').css('cursor','pointer');
            $(".dis").css('width','70px').css('cursor','not-allowed');

            // document.getElementById("disable").disabled = true;
       
          </script>
          <script>
               // title: "Delete all product of this category?",
               //             text: "If not deleted, all product of this category will move to General category!",
               //             icon: "warning",
               //             buttons: true,
               //             dangerMode: true,
               //             })
               //             .then((pro) => {
               //             }
            function deleteCat(id) {
               swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                  })
                  .then((willDelete) => {
                  if (willDelete) {
                    {
                     swal({
                        title: "Delete all product of this category?",
                        text: "If not deleted, all product of this category will move to General category!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                           
                        if (willDelete) {
                           var prodelete=1;
                           swal("category deleted!", {
                              icon: "success",
                           });
                           jQuery.ajax({
                              
                              url:'deleteCat.php',
                              type:'post',
                              data:'id='+id+'&prodelete='+prodelete,
                              success:function(result)
                              {
                                 $('.table').load(location.href + " .table");                                 
                              }
                           });

                        }else{
                           var prodelete=0;
                           swal({
                              title: "category deleted!",
                              icon: "success",
                              text: "all product of this category will move to General category!",
                           });
                           jQuery.ajax({
                              url:'deleteCat.php',
                              type:'post',
                              data:'id='+id+'&prodelete='+prodelete,
                              success:function(result)
                              {
                                 $('.table').load(location.href + " .table");                                 
                              }
                           });


                        }
                        });
                    }
                  }
                  });
            }



            function updatestatus(id)
            { 
               jQuery.ajax({
                  url:'update-cat-status.php',
                  type:'post',
                  data:'id='+id,
                  success:function(result){
                    
                     let status=jQuery('#status-btn-'+id).val();
                     if(status=='Active')
                     {
                        jQuery('#status-btn-'+id).val('Deactive');
                        jQuery('#status-btn-'+id).removeClass("badge-complete");
                        jQuery('#status-btn-'+id).addClass("badge-pending btn-w");
                        
                     }else{
                        jQuery('#status-btn-'+id).val('Active');
                        jQuery('#status-btn-'+id).removeClass("badge-pending");
                        jQuery('#status-btn-'+id).addClass("badge-complete btn-w");
                     }


                  }
               });
            }
          </script>
<?php
    require('footer.inc.php');
?>
         