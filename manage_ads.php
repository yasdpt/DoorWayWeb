<?php include("includes/header.php");

require("includes/function.php");
require("language/language.php");

if(isset($_POST['data_search']))
{

    $qry="SELECT * FROM tbl_dw_ads                  
                  WHERE tbl_dw_ads.ad_name like '%".addslashes($_POST['search_value'])."%'
                  AND tbl_dw_ads.is_published=0 ORDER BY tbl_dw_ads.ad_name";

    $result=mysqli_query($mysqli,$qry);

}
else
{

    //Get all Ads

    $tableName="tbl_dw_ads";
    $targetpage = "manage_ads.php";
    $limit = 12;

    $query = "SELECT COUNT(*) as num FROM $tableName";
    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
    $total_pages = $total_pages['num'];

    $stages = 3;
    $page=0;
    if(isset($_GET['page'])){
        $page = mysqli_real_escape_string($mysqli,$_GET['page']);
    }
    if($page){
        $start = ($page - 1) * $limit;
    }else{
        $start = 0;
    }

    $qry="SELECT * FROM tbl_dw_ads WHERE is_published=0
                   ORDER BY tbl_dw_ads.ad_id DESC LIMIT $start, $limit";

    $result=mysqli_query($mysqli,$qry);

}

if(isset($_GET['ad_id']) & $_GET['mode'] == "delete")
{
    $q = "SELECT ad_images FROM tbl_dw_ads WHERE ad_id='".$_GET['ad_id']."'";
    $temp1 = mysqli_query($mysqli, $q);
    $temp2 = mysqli_fetch_row( $temp1 );
    $images = explode(',',$temp2[0]);
    foreach ($images as $image) {
        unlink("api/images/".$image);
    }

    Delete('tbl_dw_ads','ad_id='.$_GET['ad_id'].'');


    $_SESSION['msg']="12";
    header( "Location:manage_ads.php");
    exit;

}

if (isset($_GET['ad_id']) & $_GET['mode'] == "confirm")
{
    $data = array(
        'is_published'  =>  1
    );

    Update('tbl_dw_ads', $data, 'ad_id='.$_GET['ad_id'].'');


    $_SESSION['msg']="16";
    header( "Location:manage_ads.php");
    exit;
}


?>

<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">مدیریت آگهی های تایید نشده</div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <div class="search_block">
                            <form  method="post" action="">
                                <input class="form-control input-sm" placeholder="جستجو..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                                <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="add_btn_primary"> <a href="confirmed_ads.php">آگهی های تایید شده</a> </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <div class="col-md-12 col-sm-12">
                        <?php if(isset($_SESSION['msg'])){?>
                            <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                            <?php unset($_SESSION['msg']);}?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mrg-top">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>نام آگهی</th>
                        <th class="cat_action_list">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    while($row=mysqli_fetch_array($result))
                    {
                        ?>
                        <tr>
                            <td><a href="ad_details.php?ad_id=<?php echo $row['ad_id'];?>"><?php echo $row['ad_name'];?></a> </td>
                            <td><a href="?ad_id=<?php echo $row['ad_id'];?>&mode=confirm" class="btn btn-primary">تایید</a>
                                <a href="?ad_id=<?php echo $row['ad_id'];?>&mode=delete" class="btn btn-default" onclick="return confirm('آیا از حذف این دسته و رادیو های مرتبط مطمئنید؟');">حذف</a></td>
                        </tr>
                        <?php

                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="pagination_item_block">
                    <nav>
                        <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php include("includes/footer.php");?>
