<?php
     require 'connect.php';
     require 'core.php';

     if(loggedin()){
                   $log=1;
             }
     else{
     header('Location:index.php');
     }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IIPS - Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main.php">Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Gaurav Parmar<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="main.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="upload.php"><i class="fa fa-upload fa-fw"></i> File Upload</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-wrench"></i> Update Panel <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="Add.php">Add<br>Notice/Announcement</a>
                            </li>
                            <li>
                                <a href="Delete.php">Delete Notice/Announcement</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Downloads <small>Section</small>
                        </h1>    
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> <a href="main.php">Dashboard</a> / <i class="fa fa-download fa-fw"></i> Downloads
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
								if ($handle = opendir('uploads/')) {
									while($file = readdir($handle)) {
										if ($file != "." && $file != "..") {
                                                                                        $name = substr($file,0,strpos($file,'.'));
											echo '<i class="fa fa-download fa-fw" style="position:relative; left:-10px"></i> <a href="uploads/'.$file.'">'.$name.'</a><br><br>';
										}
									}
									closedir($handle);
								}   
							?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notices And Announcement
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <marquee direction="down" behavior="scroll" scrolldelay="0">
                                   <?php
									global $log;
									if($log==1){
											$nquery="select title,description from notice;";
											if(mysql_query($nquery)){
												$run_query=mysql_query($nquery);
												if(mysql_num_rows($run_query)==NULL){
															
												}
												else{
														$i=0;
														while($i<mysql_num_rows($run_query)){
															$title=mysql_result($run_query,$i,'title');
															echo '<a href="notice.php" class="list-group-item"><i class="fa fa-fw fa-edit"></i>'
																	.$title.'
																	</a>';
																$i=$i+1;
														}
												}
											}
									}
				   ?>
                                </marquee> 
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="chat-panel panel panel-danger">
                        <div class="panel-heading">
                            <i class="fa fa-shopping-cart fa-fw"></i>
                            Downloads Section
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="width:300px; height:170px">
							<?php
								
								if ($handle = opendir('uploads/')) {
									echo '<ul type="none" style="position:relative; left:-10px">';
									$i=1;
									while($file = readdir($handle)) {
										if ($file != "." && $file != "..") {
                                                                                        $name = substr($file,0,strpos($file,'.'));
											echo '<li class="divider"><i class="fa fa-download fa-fw" style="position:relative; left:-10px"></i> <a href="uploads/'.$file.'">'.$name.'</a></li><br>';
										}
										if($i==5){
											break;
										}
										$i++;
									}
									echo '</ul>';
									closedir($handle);
								}   
							?>
						</div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
							<a href="#" class="btn btn-default btn-block">View All Downloads</a>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .Downloads-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
			</div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
		