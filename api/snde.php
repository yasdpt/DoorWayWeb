<?php

$crypted_etoken="jafar";
$to = "mryas3352@gmail.com";
            $subject = "تایید ایمیل";
            include ("confirm.php");
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <support@staryas.com>" . "\r\n";
            $headers .= 'Cc: '.$to. "\r\n";

            // SEND CONFIRMATION EMAIL
            mail($to,$subject,$message,$headers);

?>