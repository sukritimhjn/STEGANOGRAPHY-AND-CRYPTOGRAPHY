<?php
session_start();
if(isset($_SESSION['logged']) && $_SESSION['logged']==true){
	header('Location: home.php');
}
?>

<?php
if(isset($_POST["Login"]))
{   $connection=mysqli_connect("mysql.hostinger.in","u557576868_crypt","nullcrypt","u557576868_crypt")or die("Error");
	if($connection)
	{      $_SESSION['logged']=false;
		   $name=$_POST["username"];
		   $password=$_POST["password"];
		   $query=" select password from login where username='$name' ";
           $result=mysqli_query($connection,$query);		   
			if(mysqli_num_rows($result)>0)
			{
				$row=mysqli_fetch_assoc($result);	
				if($row["password"]==$password){
				  $_SESSION['username']=$name;
				  $_SESSION['logged']=true;
			      header('Location: home.php');		
				}				
				else{
                echo "wrong credentials";
				}
}				
				else{
				echo "wrong username";
				}

			
			}
			else
	{			echo "no connection established error 404";
			
	}
}		
	
?>
<html>
<style>
body {background-color:663300;
		background-repeat:no-repeat;
		background-size:cover;}
#box {       
        background-color:CCCC99;
        color:black;
		font-family:Serif;
        font-weight:bold;
        margin-top:none;
		margin-bottom:20px;
		margin-left:400px;
		margin-right:120px;
        height:150px;        
        width: 500px;
    }
#loginhd {
		background-color:996633;
        color:black;
		font-family:Serif;
        font-weight:bold;
         margin-top:120px;
		margin-bottom:none;
		margin-left:400px;
		margin-right:120px;
        height:50px;        
        width: 500px;

}	

#signuphd {text-align:center;}
</style>
<body>
	<form method="post" action="login2.php" autocomplete="off">
	<div id="loginhd"><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspLOGIN</div>
	<div id="box"><br><br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUSERNAME <input type="text" name="username" placeholder="Enter your username" value=> &nbsp;<br><br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPASSWORD <input type="password" name="password" placeholder="Enter password" value=""><br><br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" name="Login"></div>
	</form>
	<div id="signuphd">
	<a href="signup.php">Sign Up</a>
	</div>
	</body>

</html>