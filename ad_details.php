<?php include("includes/header.php");

require("includes/function.php");
require("language/language.php");





if(isset($_GET['ad_id']))
{

    $qry="SELECT * FROM tbl_dw_ads where ad_id='".$_GET['ad_id']."'";
    $result=mysqli_query($mysqli,$qry);
    $row=mysqli_fetch_assoc($result);

    $q = "SELECT ad_images FROM tbl_dw_ads WHERE ad_id='".$_GET['ad_id']."'";
    $temp1 = mysqli_query($mysqli, $q);
    $temp2 = mysqli_fetch_row( $temp1 );
    $images = explode(',',$temp2[0]);

    $qry="SELECT * FROM tbl_dw_cities where city_id='".$row['city_id']."'";
    $result=mysqli_query($mysqli,$qry);
    $row_city = mysqli_fetch_assoc($result);

    $qry="SELECT * FROM tbl_dw_categories where category_id='".$row['category_id']."'";
    $result=mysqli_query($mysqli,$qry);
    $row_category = mysqli_fetch_assoc($result);

    $qry="SELECT * FROM tbl_dw_users where user_id='".$row['user_id']."'";
    $result=mysqli_query($mysqli,$qry);
    $row_user = mysqli_fetch_assoc($result);

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
    header( "Location:confirmed_ads.php");
    exit;
}


if (isset($_GET['ad_id']) & $_GET['mode'] == "notconfirm")
{
    $data = array(
        'is_published'  => 0
    );

    Update('tbl_dw_ads', $data, 'ad_id='.$_GET['ad_id'].'');


    $_SESSION['msg']="17";
    header( "Location:manage_ads.php");
    exit;
}


?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">جزییات آگهی</div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <a href="?ad_id=<?php echo $row['ad_id'];?>&mode=<?php if($row["is_published"] == 0){?>confirm<?php }else{?>notconfirm<?php }?>" class="btn btn-primary"><?php if($row["is_published"] == 0){?>تایید<?php }else{?>لغو تایید<?php }?></a>
                        <a href="?ad_id=<?php echo $row['ad_id'];?>&mode=delete" class="btn btn-default" onclick="return confirm('آیا از حذف این آگهی مطمئنید؟');">حذف</a>
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
            <div class="card-body mrg_bottom">
                <form action="" name="add_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
                <div class="section">
                    <div class="section-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">نام آگهی :- <?php echo $row['ad_name'] ?></label><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> شرح آگهی :- <?php echo $row['ad_desc'] ?></label><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">عکس آگهی :- </label>
<?php foreach($images as $image){ echo '<img style="width:170px;height:230px;margin:5px;" src="http://staryas.ir/doorway/api/images/'.$image.'"/>';} ?><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">قیمت آگهی :- <?php echo $row['ad_price'] ?></label><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">نام دسته :- <?php echo $row_category['category'] ?></label><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">نام شهر :- <?php echo $row_city['city'] ?></label><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">نام کاربر :- <?php echo $row_user['username'] ?></label><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">تاریخ ایجاد :- <?php echo $row['created_at'] ?></label><br>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">تاریخ بروزرسانی :- <?php echo $row['updated_at'] ?></label><br>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php");?>
