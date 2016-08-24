<?php
session_start();
if($_SESSION['logged']==false){
	header('Location: login2.php');
        exit;
}
$key=$_POST['key4'];
$_SESSION['key']=$key;
if(isset($_POST['s_image'])){
header('Location: send.php');
exit;
}
else if(isset($_POST['r_image'])){
header('Location: retrieve.php');
exit;
}
?>