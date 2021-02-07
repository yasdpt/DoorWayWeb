<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 5/16/19
 * Time: 8:08 PM
 */

require_once '../vendor/autoload.php';

require("../includes/connection.php");
require("../includes/function.php");

$date = \Morilog\Jalali\Jalalian::now();


if (isset($_POST['mode'])){
    $mode = $_POST['mode'];
    $imagenames = "";
    if ($mode=="add"){
        $images = $_POST['ad_images'];

        if ($images[0] != "null"){

            foreach ($images as $image)
            {
                $imagename = rand(0,99999)."_".$_POST['category_id'].$_POST['user_id'].$_POST['city_id']."_".rand(0,99999).".jpg";
                $path = "images/".$imagename;
                file_put_contents($path,base64_decode($image));
                    //Thumb Image 
                //$thumbpath='images/thumbs/'.$imagename;   
                //$thumb_pic1=create_thumb_image($path,$thumbpath,'300','300'); 
                //$pic1=compress_image($path, $path, 80);
                //unlink($path);
                //$imgpath = compress_image($path)
                $imagenames .= $imagename . ",";
            }
            $thumbname = rand(0,99999)."_".$_POST['category_id'].$_POST['user_id'].$_POST['city_id']."_".rand(0,99999).".jpg";
            $patht = "images/thumbs/".$thumbname;
            file_put_contents($patht,base64_decode($images[0]));
            $pic1=compress_image($patht, $patht, 25);
            $imagenames = "thumbs/".$thumbname. ",". $imagenames;
            $imagenames = rtrim($imagenames,',');

            $imagenames = rtrim($imagenames,',');
        } else {
            $imagenames = "null";
        }

        $data = [
          "ad_name" => $_POST['ad_name'],
          "ad_desc" => $_POST['ad_desc'],
          "ad_images" => $imagenames,
          "ad_price" => $_POST['ad_price'],
          "category_id" => $_POST['category_id'],
          "user_id" => $_POST['user_id'],
          "city_id" => $_POST['city_id'],
          "created_at" => $date->format('Y-m-d H:i:s'),
          "updated_at" => $date->format('Y-m-d H:i:s')
        ];

        Insert("tbl_dw_ads",$data);

        $json['success'] = 1;
        $json['message'] = 'آگهی با موفقیت ارسال شد و پس از بررسی ثبت میشود';

    }

    if ($mode=="delete"){
        $q = "SELECT ad_images FROM tbl_dw_ads WHERE ad_id='".$_POST['ad_id']."'";
        $temp1 = mysqli_query($mysqli, $q);
        $temp2 = mysqli_fetch_row( $temp1 );
        $images = explode(',',$temp2[0],-1);
        foreach ($images as $image) {
            unlink("images/".$image);
        }
        if (Delete("tbl_dw_ads","WHERE ad_id=".$_POST['ad_id'])){
            $json['success'] = 1;
            $json['message'] = 'آگهی با موفقیت حذف شد';
        } else {
            $json['success'] = 0;
            $json['message'] = 'مشکلی در حذف آگهی پیش آمد';
        }

    }

    echo json_encode($json);

}