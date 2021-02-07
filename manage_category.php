<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

  if(isset($_POST['data_search']))
   {

      $qry="SELECT * FROM tbl_dw_categories                   
                  WHERE tbl_dw_categories.category like '%".addslashes($_POST['search_value'])."%'
                  ORDER BY tbl_dw_categories.category";
 
     $result=mysqli_query($mysqli,$qry); 

   }
   else
   {
	
	//Get all Category 
	 
      $tableName="tbl_dw_categories";
      $targetpage = "manage_category.php"; 
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
      
     $qry="SELECT * FROM tbl_dw_categories
                   ORDER BY tbl_dw_categories.priority ASC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$qry); 
	
    } 

	if(isset($_GET['cat_id']))
	{ 


 
		Delete('tbl_dw_categories','category_id='.$_GET['cat_id'].'');

     
		$_SESSION['msg']="12";
		header( "Location:manage_category.php");
		exit;
		
	}	

  function get_total_item($cat_id)
  { 
    global $mysqli;   

    $qry_items="SELECT COUNT(*) as num FROM tbl_dw_items WHERE category_id='".$cat_id."'";
     
    $total_items = mysqli_fetch_array(mysqli_query($mysqli,$qry_items));
    $total_items = $total_items['num'];
     
    return $total_items;

  }

  //Active and Deactive status
if(isset($_GET['cat_id']))
{
    $res=mysqli_query($mysqli,'SELECT * FROM tbl_dw_ads WHERE category_id=\''.$_GET['cat_id'].'\'');
    $res_row=mysqli_fetch_assoc($res);


    Delete('tbl_dw_ads','category_id='.$_GET['cat_id'].'');

    Delete('tbl_dw_cities','category_id='.$_GET['cat_id'].'');


    $_SESSION['msg']="12";
    header( "Location:manage_category.php");
    exit;
}

?>

<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">مدیریت دسته ها</div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <div class="search_block">
                            <form  method="post" action="">
                                <input class="form-control input-sm" placeholder="جستجو..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                                <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="add_btn_primary"> <a href="add_category.php?add=yes">اضافه کردن دسته</a> </div>
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
                        <th>نام دسته</th>
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
                            <td><?php echo $row['category'];?></td>
                            <td><a href="add_category.php?cat_id=<?php echo $row['category_id'];?>" class="btn btn-primary">ویرایش</a>
                                <a href="?cat_id=<?php echo $row['category_id'];?>" class="btn btn-default" onclick="return confirm('آیا از حذف این دسته و آگهی های مرتبط مطمئنید؟');">حذف</a></td>
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
