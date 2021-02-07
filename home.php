<?php include("includes/header.php");

$qry_language="SELECT COUNT(*) as num FROM tbl_dw_categories";
$total_language= mysqli_fetch_array(mysqli_query($mysqli,$qry_language));
$total_language = $total_language['num'];

$qry_city="SELECT COUNT(*) as num FROM tbl_dw_cities";
$total_city= mysqli_fetch_array(mysqli_query($mysqli,$qry_city));
$total_city = $total_city['num'];

$qry_ad="SELECT COUNT(*) as num FROM tbl_dw_ads";
$total_ad = mysqli_fetch_array(mysqli_query($mysqli,$qry_ad));
$total_ad = $total_ad['num'];

 

?>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_category.php" class="card card-banner card-green-light cardtitle">
        <div class="card-body"> <i class="icon fa fa-folder-open fa-4x"></i>
          <div class="content">
            <div class="title" >دسته</div>
            <div class="value"><span class="sign"></span><?php echo $total_language;?></div>
          </div>
        </div>
        </a> 
        </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_city.php" class="card card-banner card-blue-light cardtitle">
        <div class="card-body"> <i class="icon fa fa-sitemap fa-4x"></i>
          <div class="content">
            <div class="title" id="cardtitle">شهر</div>
            <div class="value"><span class="sign"></span><?php echo $total_city;?></div>
          </div>
        </div>
        </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_ads.php" class="card card-banner card-yellow-light cardtitle">
        <div class="card-body"> <i class="icon fa fa-list fa-4x"></i>
          <div class="content">
            <div class="title" id="cardtitle">آگهی</div>
            <div class="value"><span class="sign"></span><?php echo $total_ad;?></div>
          </div>
        </div>
        </a> 
        </div>
         
     
    </div>

        
<?php include("includes/footer.php");?>       
