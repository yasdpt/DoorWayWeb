<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 5/15/19
 * Time: 11:46 AM
 */

require_once '../vendor/autoload.php';
require("../includes/connection.php");
require("../includes/function.php");

$date = \Morilog\Jalali\Jalalian::now();
$encryption_key = 'J50TLS1ZGKXCFD7QBOVI6AMH2U9RPY3E4N8W';
$cryptor = new \Morilog\Jalali\Cryptor($encryption_key);

if (isset($_POST['username'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = array();


    $qry="select * from tbl_dw_users where username='".$username."'";

    $result=mysqli_query($mysqli,$qry);

    if(mysqli_num_rows($result) > 0)
    {
        $row=mysqli_fetch_assoc($result);

        $dbpass = $cryptor->decrypt($row['password']);
        if ($password == $dbpass)
        {
            
            if ($row['active'] == 1){
                $json['success'] = 1;
                $json['message'] = 'با موفقیت وارد شدید!';
                $json['user'] = array();
                
                $user['user_id'] = $row['user_id'];
                $user['fullname'] = $row['full_name'];
                $user['username'] = $row['username'];
                $user['email'] = $row['email'];
                $user['phone'] = $row['phone'];
                array_push($json['user'],$user);
            } else {
                $json['success'] = 0;
                $json['message'] = 'حساب شما فعال نیست لطفا ایمیل خود را برای فعال کردن چک کنید';
                array_push($json['user'],$user);
                
            }
        } else {
            $json['success'] = 0;
            $json['message'] = 'نام کاربری یا رمز عبور اشتباه است!';
            array_push($json['user'],$user);
        }

    }
    else
    {
        $json['success'] = 0;
        $json['message'] = 'نام کاربری یا رمز عبور اشتباه است!';
        array_push($json['user'],$user);

    }
    echo json_encode($json);
}