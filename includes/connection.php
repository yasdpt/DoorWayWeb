<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 5/15/19
 * Time: 11:46 AM
 */
    error_reporting(0);
    ob_start();
    session_start();

 	header("Content-Type: text/html;charset=UTF-8");


 	if($_SERVER['HTTP_HOST']=="localhost")
        {
            //local
            DEFINE ('DB_USER', 'user');
            DEFINE ('DB_PASSWORD', 'password');
            DEFINE ('DB_HOST', 'localhost');
            DEFINE ('DB_NAME', 'dbname');
        }
        else
        {
            //local live

            DEFINE ('DB_USER', 'user');
            DEFINE ('DB_PASSWORD', 'password');
            DEFINE ('DB_HOST', 'localhost'); //host name depends on server
            DEFINE ('DB_NAME', 'dbname');
        }




	$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

mysqli_query($mysqli,"SET NAMES 'utf8'");

    define("APP_NAME","DoorWay");
    define("APP_LOGO","applogo.png");

    //Profile
    if(isset($_SESSION['id']))
    {
        $profile_qry="SELECT * FROM tbl_dw_admin where id='".$_SESSION['id']."'";
        $profile_result=mysqli_query($mysqli,$profile_qry);
        $profile_details=mysqli_fetch_assoc($profile_result);

        define("PROFILE_IMG",$profile_details['image']);
    }

?>