<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

    require_once __DIR__ . '/vendor/autoload.php';
    $date = \Morilog\Jalali\Jalalian::now();




	if(isset($_POST['submit']) and isset($_GET['add']))
	{
	 
          
       $data = array(
               'city'  =>  $_POST['city_name'],
           'created_at' => $date->format("Y-m-d"),
           'updated_at' => $date->format("Y-m-d")
			    );		

 		$qry = Insert('tbl_dw_cities',$data);
 
		$_SESSION['msg']="10"; 
		header( "Location:add_city.php?add=yes");
		exit;	

		  
	}
	
	if(isset($_GET['city_id']))
	{
			 
			$qry="SELECT * FROM tbl_dw_cities where city_id='".$_GET['city_id']."'";
			$result=mysqli_query($mysqli,$qry);
			$row=mysqli_fetch_assoc($result);

	}
	if(isset($_POST['submit']) and isset($_POST['city_id']))
	{
		 
		 $data = array(
			          'city'  =>  $_POST['city_name'],
                'updated_at'  =>  $date->format("Y-m-d"),

						);	
 
	    $category_edit=Update('tbl_dw_cities', $data, "WHERE city_id = '".$_POST['city_id']."'");
 
		
		$_SESSION['msg']="11"; 
		header( "Location:add_city.php?city_id=".$_POST['city_id']);
		exit;
 
	}


?>
<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title"><?php if(isset($_GET['city_id'])){?>ویرایش کردن<?php }else{?>اضافه کردن<?php }?> شهر</div>
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
            <form action="" name="addedit_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
            	<input  type="hidden" name="city_id" value="<?php echo $_GET['city_id'];?>" />

              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">نام شهر :-</label>
                    <div class="col-md-6">
                      <input type="text" name="city_name" id="city_name" value="<?php if(isset($_GET['city_id'])){echo $row['city'];}?>" class="form-control" required>
                    </div>
                  </div>
                   
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       
