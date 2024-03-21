<?php 
    require('connection.inc.php');
    require('funtions.inc.php');

    $login_email=get_safe_value($con,$_POST['login_email']);
    $login_password=get_safe_value($con,$_POST['login_password']);

    $res=mysqli_query($con,"SELECT * FROM users WHERE email='$login_email' AND password='$login_password' AND deleted='NO'");
    $check_user=mysqli_num_rows($res);

    if($check_user>0)
    {
        $row=mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGIN']='yes';
        $_SESSION['USER_ID']=$row['id'];
        $_SESSION['USER_NAME']=$row['name'];
        echo "valid";
    }else{

        echo "wrong";

    }

?>