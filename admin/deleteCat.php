<?php
require('connection.inc.php ');
if(isset($_POST['id']) && $_POST['id']>0 && isset($_POST['prodelete']) && $_POST['prodelete']==1)
{
        $id = mysqli_real_escape_string($con,$_POST['id']);
        mysqli_query($con,"UPDATE categories SET deleted='YES' WHERE id='$id'");
        mysqli_query($con,"UPDATE product SET deleted='YES' WHERE categories_id='$id'");

}else if(isset($_POST['id']) && $_POST['id']>0 && isset($_POST['prodelete']) && $_POST['prodelete']==0)
{
        $id = mysqli_real_escape_string($con,$_POST['id']);
        mysqli_query($con,"UPDATE categories SET deleted='YES' WHERE id='$id'");
        mysqli_query($con,"UPDATE product SET categories_id='1000' WHERE categories_id='$id'");

}
?>