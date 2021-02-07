<?php
/**
 * Created by PhpStorm.
 * User: yas
 * Date: 5/15/19
 * Time: 11:48 AM
 */
require("../includes/connection.php");
require("../includes/function.php");

if (isset($_GET['orderby'])) {
    $tbl_name = "tbl_dw_cities";
    $order_by = $_GET['orderby'];
    $yas_query = "SELECT * FROM ".$tbl_name." ORDER BY ".$order_by. " ASC";

    $result = mysqli_query($mysqli , $yas_query);

    if( $result )
    {
        $json['success'] = 1;
        $json['cities'] = array();


        while( $row = mysqli_fetch_array( $result ))
        {
            $cities = array();

            $cities['city_id'] = $row['city_id'];
            $cities['city'] = $row['city'];

            array_push( $json['cities'] , $cities );
        }
    }
    else
    {
        $json['success'] = 0;
        $json['cities'] = array();
    }

    echo(json_encode( $json ));
}