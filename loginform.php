<?php
     if(isset($_POST['username']) && isset($_POST['password'])){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $hash_pass=md5($password);
            if (!empty($username) && !empty($password)){
                $query="select id from admin_acc where username='".mysql_real_escape_string($username)."' and password='".mysql_real_escape_string($hash_pass)."'";
                $query_run=mysql_query($query);
                 if ($query_run = mysql_query($query)){
                    if (mysql_num_rows($query_run)==NULL){
                         $incorrect=1;
                    }
                    else{
                         $id=mysql_result($query_run,0,'id');
                         $_SESSION['id']=$id;
                         header('Location:index.php');
                        }
                 }
                 else{
                      mysql_error();
                     }
                }
            else{
                    $empty_field=1;
                 }
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

    <title>IIPS - Admin Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

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

    <div class="container" style="position:relative; top:100px">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
			        </div>
                    <div class="panel-body">
                        <form action="<?php echo $current_file;?>" method="POST" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="Submit" value="Login" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
					<?php
						global $empty_field;
						global $incorrect;
						if($empty_field==1){
							echo '<i class="fa fa-warning fa-fw"></i> Please enter Username and Password';
						}
						else if($incorrect==1){
							echo '<i class="fa fa-warning fa-fw"></i> Invalid Username or Password';
						}
					?>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>

