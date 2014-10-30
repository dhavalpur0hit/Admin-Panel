<?php
	 require 'connect.php';
     require 'core.php';

     if(loggedin()){
             header('Location:main.php');
     }
     else{
     include 'loginform.php';
     }

?>
