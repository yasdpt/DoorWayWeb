<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 5/16/19
 * Time: 8:08 PM
 */

require("../includes/connection.php");
require("../includes/function.php");

if (isset($_GET['city']) && isset($_GET['page'])){
    $tbl_name = "tbl_dw_ads";
    $order_by = $_GET['orderby'];
    $records_limit = 15;
    $city = $_GET['city'];
    $page = $_GET['page'];
    $offset = $page * $records_limit;

    $yas_query = "SELECT * FROM ".$tbl_name." WHERE city_id=".$city." AND is_published=1 ORDER BY ".$order_by." DESC LIMIT ".$offset." , ".$records_limit;

    $result = mysqli_query($mysqli , $yas_query);

    if( $result )
    {
        $json['success'] = 1;
        $json['ads'] = array();


        while( $row = mysqli_fetch_array( $result ))
        {
            $ads = array();

            $ads['ad_id'] = $row['ad_id'];
            $ads['ad_name'] = $row['ad_name'];
            $ads['ad_desc'] = $row['ad_desc'];
            $ads['ad_price'] = $row['ad_price'];
            $ads['ad_images'] = $row['ad_images'];

            $q = " SELECT category FROM tbl_dw_categories WHERE category_id='".$row['category_id']."'";
            $temp1 = mysqli_query($mysqli, $q);
            $temp2 = mysqli_fetch_row( $temp1 );
            $category = $temp2[0];

            $ads['category'] = $category;


            $q = " SELECT city FROM tbl_dw_cities WHERE city_id='".$city."'";
            $temp1 = mysqli_query($mysqli, $q);
            $temp2 = mysqli_fetch_row( $temp1 );
            $cityname = $temp2[0];

            $ads['city'] = $cityname;

            $q = " SELECT email FROM tbl_dw_users WHERE user_id='".$row['user_id']."'";
            $temp1 = mysqli_query($mysqli, $q);
            $temp2 = mysqli_fetch_row( $temp1 );
            $email = $temp2[0];

            $ads['email'] = $email;

            $q = " SELECT phone FROM tbl_dw_users WHERE user_id='".$row['user_id']."'";
            $temp1 = mysqli_query($mysqli, $q);
            $temp2 = mysqli_fetch_row( $temp1 );
            $phone = $temp2[0];

            $ads['phone'] = $phone;
            $ads['is_published'] = $row['is_published'];
            $ads['created_at'] = $row['created_at'];

            array_push( $json['ads'] , $ads );
        }
    }
    else
    {
        $json['success'] = 0;
        $json['message'] = "Nothing";
    }

    echo(json_encode( $json ));

}