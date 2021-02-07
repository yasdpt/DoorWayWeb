<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 6/11/19
 * Time: 11:36 AM
 */
require("../includes/connection.php");
require("../includes/function.php");

if (isset($_GET['mode'])){
    $mode = $_GET['mode'];
    $tbl_name = "tbl_dw_ads";
    $query = $_GET['query'];
    $order_by = $_GET['orderby'];
    $records_limit = 15;
    $city = $_GET['city'];
    $page = $_GET['page'];
    $offset = $page * $records_limit;

    if ($mode == "main"){

        $yas_query = "SELECT * FROM ".$tbl_name." WHERE city_id=".$city." AND is_published=1 AND ad_name LIKE '%".$query."%' ORDER BY ".$order_by." DESC LIMIT ".$offset." , ".$records_limit;

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
                $ads['created_at'] = $row['created_at'];

                array_push( $json['ads'] , $ads );
            }
        }
        else
        {
            $json['success'] = 0;
            $json['message'] = "Nothing main";
        }

        echo(json_encode( $json ));

    } else {
        $category = $_GET['category'];


        $yas_query = "SELECT * FROM ".$tbl_name." WHERE ad_name LIKE '%".$query."%' AND city_id=".$city." AND category_id=".$category." AND is_published=1 ORDER BY ".$order_by." DESC LIMIT ".$offset." , ".$records_limit;

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
                $ads['created_at'] = $row['created_at'];

                array_push( $json['ads'] , $ads );
            }
        }
        else
        {
            $json['success'] = 0;
            $json['message'] = "Nothing cat";
        }

        echo(json_encode( $json ));
    }
}