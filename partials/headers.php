<?php $title = isset($title) ? $title : "DSheldon"; ?>
<html>
<head>
    <title><?php echo ucwords($title);?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Second Meta is Internet Explorer Compatibility and second is Third Mobile Meta -->
    <link rel="stylesheet" href="<?php echo $styles_path; ?>/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $styles_path; ?>/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $styles_path; ?>/style.css">
    <?php if (isset($styles)) { ?>
        <?php foreach($styles as $style) { ?>
            <link rel="stylesheet" href="<?php echo $styles_path; ?>/<?php echo $style;?>.css">
        <?php } ?>
    <?php } ?>
</head>
<body>
<!--Start Navbar-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" <?php echo $title == "homepage" ? "style='background:none;'" : '';?>>
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="		#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo $server_base;?>"> <img src="<?php echo $images_path;?>/DS2.png"> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" style="padding-top: 8px" method="get" action="<?php echo $server_base;?>/results/results.php">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
								    <span class="input-group-btn">
								    	<button type="button" class="btn btn-default" aria-label="Left Align">
  											<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
										</button>
								    </span>
                            <input type="text" name="q" class="form-control" placeholder="Search for..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : '';?>">
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div>
            </form>
            <?php if ($title != 'homepage') { ?>
            <ul class="nav navbar-nav navbar-right"> <!--It took navbar right so it went right-->
                <?php if (!isset($_SESSION['user'])) { ?>
                    <?php if (!isset($is_signup)) {?>
                    <li>
                        <button type="button" class="btn btn-default" onclick="location.href='<?php echo $server_base;?>/signup.php'" style="margin-top: 2px;width: 120px">Sign Up</button> <!--Edit-->
                    </li>
                    <?php } ?>
                    <?php if (!isset($is_login)) {?>
                    <li>
                        <button type="button" class="btn btn-default" onclick="location.href='<?php echo $server_base;?>/login.php'" style="margin-top: 2px;width: 120px">Log In</button> <!--Edit-->
                    </li>
                    <?php } ?>
                <?php } else { ?>
                    <?php if ($title != "profile") { ?>
                    <li>
                        <button type="button" class="btn btn-default" onclick="location.href='<?php echo $server_base;?>/profile.php'" style="margin-top: 2px;width: 120px">Profile</button> <!--Edit-->
                    </li>
                    <?php } else { ?>
                    <li>
                        <button type="button" class="btn btn-default" onclick="location.href='<?php echo $server_base;?>/edit.php'" style="margin-top: 2px;width: 120px">Edit Profile</button> <!--Edit-->
                    </li>
                    <?php } ?>
                    <li>
                        <button type="button" class="btn btn-danger" onclick="location.href='<?php echo $server_base;?>/logout.php'" style="margin-top: 2px;width: 120px">Logout</button> <!--Edit-->
                    </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    <!-- End of the Container-->
</nav>
<!--End Navbar-->

