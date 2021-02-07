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
if (isset($_POST['fullname'])){
    $username = $_POST['username'];
    $email = $_POST['email'];

    $uqry="select * from tbl_dw_users where username='".$username."'";
    $uresult=mysqli_query($mysqli,$uqry);

    $eqry="select * from tbl_dw_users where email='".$email."'";
    $eresult=mysqli_query($mysqli,$eqry);

    if(!(mysqli_num_rows($uresult) > 0))
    {
        if (!(mysqli_num_rows($eresult) > 0)) {
            $token = $_POST["password"];
            $crypted_token = $cryptor->encrypt($token);
            unset($token);
            $data = [
                'full_name' => $_POST['fullname'],
                'username' => $_POST['username'],
                'password' => $crypted_token,
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'created_at' => $date->format("Y-m-d"),
                'updated_at' => $date->format("Y-m-d")
            ];

            Insert("tbl_dw_users", $data);
            $etoken = $_POST['username'];
            $crypted_etoken = base64_encode($etoken);
            unset($etoken);

            $to = $email;
            $subject = "تایید ایمیل";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <support@staryas.ir>" . "\r\n";
            $headers .= 'Cc: '.$to. "\r\n";

            $message = '
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: \'Source Sans Pro\';
                font-style: normal;
                font-weight: 400;
                src: local(\'Source Sans Pro Regular\'), local(\'SourceSansPro-Regular\'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format(\'woff\');
            }

            @font-face {
                font-family: \'Source Sans Pro\';
                font-style: normal;
                font-weight: 700;
                src: local(\'Source Sans Pro Bold\'), local(\'SourceSansPro-Bold\'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format(\'woff\');
            }
        }
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }

        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>
<body style="background-color: #e9ecef;">

<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">

    <tr>
        <td align="center" bgcolor="#e9ecef">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 36px 24px;">
                        <a href="" target="_blank" style="display: inline-block;">
                            <img src="http://staryas.ir/doorway/images/applogo2.png" alt="Logo" border="0" width="100" style="display: block; width: 100px; max-width: 100px; min-width: 100px;">
                        </a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>

    <tr>
        <td align="center" bgcolor="#e9ecef">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="right" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                        <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">تایید آدرس ایمیل</h1>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td align="center" bgcolor="#e9ecef">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                <tr>
                    <td align="right" bgcolor="#ffffff" style="padding: 24px;text-align: right; font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <p style="margin: 0;">برای تایید ایمیل خود روی دکمه زیر کلیک کنید اگر شما در برنامه دوروی اکانت نساختید این ایمیل را نادیده بگیرید</p>
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
                                                <a href="http://staryas.ir/doorway/ConfirmEmail.php?confirm='.$crypted_etoken.'" target="_blank" style="display: inline-block; padding: 16px 36px; font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">تایید</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="right" bgcolor="#ffffff" style="padding: 24px; font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <p style="margin: 0;">اگر دکمه کار نکرد لینک زیر را در مرورگر خود کپی و اجرا کنید</p>
                        <p style="margin: 0;"><a href="http://staryas.ir/doorway/ConfirmEmail.php?confirm='.$crypted_etoken.'" target="_blank">http://staryas.ir/doorway/ConfirmEmail.php?confirm='.$crypted_etoken.'</a></p>
                    </td>
                </tr>
                <tr>
                    <td align="right" bgcolor="#ffffff" style="padding: 24px; font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                        <p style="margin: 0;">با تشکر<br>DoorWay</p>
                    </td>
                </tr>

            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->

            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>
</body>
</html>
';

            mail($to,$subject,$message,$headers);

            $json['success'] = 1;
            $json['message'] = "کاربر با موفقیت ثبت شد";

        } else {

            $json['success'] = 0;
            $json['message'] = 'ایمیل مورد نظر موجود است';

        }
    } else {

        $json['success'] = 0;
        $json['message'] = 'نام کاربری مورد نظر موجود است';

    }



    echo json_encode($json);
}