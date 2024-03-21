<?php
    //Start session
    session_start();

    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','myshop');

    define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/first/myshop/');
    define('SITE_PATH','http://localhost/first/myshop/');
    define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
    define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');


    $con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($con,DB_NAME) or die(mysqli_error());
    
?>