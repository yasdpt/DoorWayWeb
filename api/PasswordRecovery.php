<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 6/12/19
 * Time: 6:04 PM
 */

require_once '../vendor/autoload.php';
require("../includes/connection.php");
require("../includes/function.php");
$encryption_key = 'J50TLS1ZGKXCFD7QBOVI6AMH2U9RPY3E4N8W';
$cryptor = new \Morilog\Jalali\Cryptor($encryption_key);

if (isset($_GET['email'])){
    $email = $_GET['email'];

    $qry="select * from tbl_dw_users where email='".$email."'";

    $result=mysqli_query($mysqli,$qry);

    if(mysqli_num_rows($result) > 0)
    {
        $row=mysqli_fetch_assoc($result);

        $dbpass = $cryptor->decrypt($row['password']);

        $to = $email;
        $subject = "بازیابی رمزعبور";
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
    <title>Password Recovery</title>
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
                        <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">بازیابی رمز عبور</h1>
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
                        <p style="margin: 0;">رمز عبور شما به شرح زیر می باشد، اگر شما درخواست نکرده اید این ایمیل را نادیده بگیرید</p>
                    </td>
                </tr>
                <tr>
                    <td align="right" bgcolor="#ffffff" style="padding: 24px; font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <p style="margin: 0;">رمز عبور شما:</p>
                        <p style="margin: 0;">'.$dbpass.'</p>
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
        $json['message'] = "رمزعبور شما با موفقیت به ایمیلتان ارسال شد";
    } else {
        $json['success'] = 0;
        $json['message'] = 'کاربر موجود نیست!';
        
    }
    echo json_encode($json);
} else {
    $json['success'] = 0;
    $json['message'] = "error in request";
    echo json_encode($json);
}