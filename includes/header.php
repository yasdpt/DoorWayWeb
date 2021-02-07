<?php include("includes/connection.php");
include("includes/session_check.php");

//Get file name
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];


?>
<!DOCTYPE html>
<html>
<head>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME;?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
    <link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">

    <script src="assets/ckeditor/ckeditor.js"></script>

</head>
<body>
<div class="app app-default">
    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header"> <a class="sidebar-brand" href="home.php"><img src="images/<?php echo APP_LOGO;?>" alt="app logo" /></a>
            <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
        </div>
        <div class="sidebar-menu">
            <ul class="sidebar-nav">
                <li <?php if($currentFile=="home.php"){?>class="active"<?php }?>> <a href="home.php">
                        <div class="icon"> <i class="fa fa-dashboard" aria-hidden="true"></i> </div>
                        <div class="title">داشبورد</div>
                    </a>
                </li>
                <li <?php if($currentFile=="manage_city.php" or $currentFile=="add_city.php"){?>class="active"<?php }?>> <a href="manage_city.php">
                        <div class="icon"> <i class="fa fa-sitemap" aria-hidden="true"></i> </div>
                        <div class="title">شهر</div>
                    </a>
                </li>

                <li <?php if($currentFile=="manage_ads.php" or $currentFile=="add_items.php" or $currentFile=="edit_items.php"){?>class="active"<?php }?>> <a href="manage_ads.php">
                        <div class="icon"> <i class="fa fa-list" aria-hidden="true"></i> </div>
                        <div class="title">آگهی ها</div>
                    </a>
                </li>
                <li <?php if($currentFile=="manage_category.php" or $currentFile=="add_category.php"){?>class="active"<?php }?>> <a href="manage_category.php">
                        <div class="icon"> <i class="fa fa-folder-open" aria-hidden="true"></i> </div>
                        <div class="title">دسته ها</div>
                    </a>
                </li>

                <li <?php if($currentFile=="manage_users.php" or $currentFile=="add_users.php"){?>class="active"<?php }?>> <a href="manage_users.php">
                        <div class="icon"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                        <div class="title">کاربران</div>
                    </a>
                </li>

                <li <?php if($currentFile=="api_urls.php"){?>class="active"<?php }?>> <a href="api_urls.php">
                        <div class="icon"> <i class="fa fa-exchange" aria-hidden="true"></i> </div>
                        <div class="title">آدرس های API</div>
                    </a>
                </li>

            </ul>
        </div>

    </aside>
    <div class="app-container">
        <nav class="navbar navbar-default" id="navbar">
            <div class="container-fluid">
                <div class="navbar-collapse collapse in">
                    <ul class="nav navbar-nav navbar-mobile">
                        <li>
                            <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
                        </li>
                        <li class="logo"> <a class="navbar-brand" href="#"><?php echo APP_NAME;?></a> </li>
                        <li>
                            <button type="button" class="navbar-toggle">
                                    <img class="profile-img" src="images/profile.png">
                            </button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="navbar-title"><?php echo APP_NAME;?></li>

                    </ul>
                    <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown profile"> <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"> <?php if(PROFILE_IMG){?>
                                    <img class="profile-img" src="images/profile.png">
                                <?php }else{?>
                                    <img class="profile-img" src="assets/images/profile.png">
                                <?php }?>
                                <div class="title">پروفایل</div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="profile-info">
                                    <h4 class="username">مدیر</h4>
                                </div>
                                <ul class="action">
                                    <li><a href="profile.php">پروفایل</a></li>
                                    <li><a href="logout.php">خروج</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>