<?php 
    require('connection.inc.php');
    require('funtions.inc.php');

    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $password=get_safe_value($con,$_POST['password']);
    $added_on=date('Y-m-d h:i:s');

    $check_user=mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND deleted='NO'"));

    if($check_user>0)
    {
        echo "present";
    }else{
        mysqli_query($con,"INSERT INTO users(name,email,mobile,password,added_on,deleted) values('$name','$email','$mobile','$password','$added_on','NO')");
        echo "insert";

    }

?>