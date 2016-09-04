<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php 
            echo isset($page_title) ? $page_title . " : Address Directory" : "Address Directory"; 
        ?>
    </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!--<link href="css/jquery.dataTables.min.css" rel="stylesheet">-->
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Roboto+Slab|Shadows+Into+Light" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    
    <div class="master-area">

        <div class="container-fluid">
        	
            <div class="header">
                <div class="row">
                    
                    <!-- header-left -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="logo-text">
                            <span>A</span>ddress
                            <span>D</span>irctory
                        </div>
                    </div>
                    <!-- /col-md-6 -->

                    <!-- header-right -->
                    <div class="col-md-6 col-sm-6 col-xs-12 header-right">
                        
                        <?php if( isset($_SESSION["sess_user_name"])) : ?>
                            <button class="btn">
                              <i class="fa fa-user"></i>
                              <?php echo $_SESSION["sess_user_name"]; ?>  
                            </button>
                        <?php endif; ?>

                        <a href="logout.php" class="btn btn-danger">
                          <i class="fa fa-lock"></i>
                          Log Out
                        </a>

                    </div>
                    <!-- /col-md-6, header-right --> 
                        
                </div>
                <!-- /row -->
            </div>
            <!-- /header -->

            <div class="top-menu">
                <div class="row">
                    <div class="col-md-12">
                        <a href="directory-index.php" class="btn btn-info">
                          <i class="fa fa-home"></i>
                          Index Page
                        </a>
                        <a href="create-new-entry.php" class="btn btn-success">
                          <i class="fa fa-pencil"></i>
                          Create New
                        </a>
                        <a href="manage-circles.php" class="btn btn-info">
                          <i class="fa fa-users"></i>
                          Manage Circles
                        </a>
                    </div>
                    <!-- /col-md-12 -->
                </div>
                <!-- /row -->
            </div>
            <!-- /top-menu -->

            