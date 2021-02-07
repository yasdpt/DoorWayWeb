<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 5/15/19
 * Time: 11:47 AM
 */
require("../includes/connection.php");
require("../includes/function.php");

if (isset($_GET['orderby']) && isset($_GET['city_id'])) {
    $tbl_name = "tbl_dw_categories";
    $order_by = $_GET['orderby'];
    $city_id = $_GET['city_id'];
    $yas_query = "SELECT * FROM ".$tbl_name." ORDER BY ".$order_by. " ASC";

    $result = mysqli_query($mysqli , $yas_query);

    if( $result )
    {
        $json['success'] = 1;
        $json['categories'] = array();


        while( $row = mysqli_fetch_array( $result ))
        {
            $categories = array();

            $categories['category_id'] = $row['category_id'];
            $categories['category'] = $row['category'];

            $qry_language="SELECT COUNT(*) as num FROM tbl_dw_ads WHERE category_id=".$row['category_id']." AND is_published=1 AND city_id=".$city_id;
            $total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_language));
            $total_category = $total_category['num'];

            $categories['count'] = $total_category;

            array_push( $json['categories'] , $categories );
        }
    }
    else
    {
        $json['success'] = 0;
        $json['categories'] = array();
    }

    echo(json_encode( $json ));
}