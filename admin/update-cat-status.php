<?php
include('connection.inc.php ');
if(isset($_POST['id']) && $_POST['id']>0)
{
        $id = mysqli_real_escape_string($con,$_POST['id']);
        // $status = mysqli_real_escape_string($_POST['status']);
        $res=mysqli_query($con,"SELECT * FROM categories WHERE id='$id'");
        $row=mysqli_fetch_assoc($res);
        $status=$row['status'];
        if($status=='1')
        {
            $status='0';
        }else{
            $status='1';
        }
        mysqli_query($con,"UPDATE categories SET status='$status' WHERE id='$id'");
        return $status;

}
?>