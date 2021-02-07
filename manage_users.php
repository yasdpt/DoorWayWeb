<?php include("includes/header.php");

require("includes/function.php");
require("language/language.php");

if(isset($_POST['data_search']))
{

    $qry="SELECT * FROM tbl_dw_users                   
                  WHERE tbl_dw_users.username like '%".addslashes($_POST['search_value'])."%'
                  ORDER BY tbl_dw_users.username";

    $result=mysqli_query($mysqli,$qry);

}
else
{

    //Get all Category

    $tableName="tbl_dw_users";
    $targetpage = "manage_city.php";
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

    $qry="SELECT * FROM tbl_dw_users
                   ORDER BY tbl_dw_users.user_id DESC LIMIT $start, $limit";

    $result=mysqli_query($mysqli,$qry);

}

if(isset($_GET['user_id']))
{

    Delete('tbl_dw_users','user_id='.$_GET['user_id'].'');


    $_SESSION['msg']="12";
    header( "Location:manage_users.php");
    exit;

}

?>

<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">مدیریت کاربران</div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <div class="search_block">
                            <form  method="post" action="">
                                <input class="form-control input-sm" placeholder="جستجو..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                                <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="add_btn_primary"> <a href="add_city.php?add=yes">اضافه کردن شهر</a> </div>
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
            <div class="col-md-12 mrg-top table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>نام کامل</th>
                        <th>نام کاربری</th>
                        <th>ایمیل</th>
                        <th>شماره تلفن</th>
                        <th>فعال</th>
                        <th>تاریخ ثبت</th>
                        <th>تاریخ ویرایش</th>

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
                            <td><?php echo $row['full_name'];?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php if ($row['active'] == 0) echo "خیر"; else echo "بله";?></td>
                            <td><?php echo $row['created_at'];?></td>
                            <td><?php echo $row['updated_at'];?></td>
                            <td><a href="?user_id=<?php echo $row['user_id'];?>" class="btn btn-primary" onclick="return confirm('آیا از حذف این کاربر مطمئنید؟');">حذف</a></td>
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
