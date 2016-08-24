<?php
session_start();
if($_SESSION['logged']==false){
	header('Location: login2.php');
}
?>

<?php
$connection=mysqli_connect("mysql.hostinger.in","u557576868_crypt","nullcrypt","u557576868_crypt")or die("Error");
if($connection)
{
$name=$_SESSION['username'];
$query="select username from login where username!='$name'";
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);

}

?>
<html>
<head>
<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
    font-family:verdana;
}
#left {
    line-height:30px;
    background-color:lightgray;
    height:300px;
    width:100px;
    float:left;
    padding:5px;	      
}
#content {
    width:1000px;
    float:right;
    padding:10px;	 	 
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
   padding:5px;	 	 
}

</style> 
</head>
<body>
<div id="header">
<h1>Welcome <?php echo $name;?></h1>
<a href="logout.php" style="float:right"><button type="button" name="logout">LogOut</button></a>
</div><br>
<div id="content">
<br>
<?php

$query="SELECT * FROM `login` WHERE username='$name' ";
$result1=mysqli_query($connection,$query);
$row=mysqli_fetch_assoc($result1);

echo "<span id="t">Name :   </span> ".$row['name']."<br>";
echo "<span id="t">Mobile  :</span>".$row['mobile']."<br>";
echo "<span id="t">Email :  </span>".$row['email']."<br>";
echo "<span id="t">Profession :  </span>".$row['profession']."<br>";


?>


</div>
<div id="left">
<h3>All USERS:</h3>
<table id="userlist">
<?php

while($row=mysqli_fetch_assoc($result))
{  
  $var= $row["username"];
echo  "<tr><td><a href='chat.php?value=$var'>".$var. '</a></td></tr>';
}

?>
</table>
</div>


<div id="footer">
Copyright &copyPPWorks
</div>
</body>				