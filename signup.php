<?php
if(isset($_POST["submit"]))
{   $connection=mysqli_connect("mysql.hostinger.in","u557576868_crypt","nullcrypt","u557576868_crypt")or die("Error");								// establishing a connection with MySql
	if($connection)
	{
	    
		   $name=$_POST["username"];																				
		   $email=$_POST["email"];
		   $password=$_POST["password"];
                   $fname=$_POST["name"];
                   $mobile=$_POST["mobile"];
                   $profession=$_POST["profession"];
		   $query="INSERT INTO login (name,mobile,profession,username,email,password) VALUES('$fname','$mobile','$profession','$name','$email','$password')";
           $result=mysqli_query($connection,$query);		   														// execution of query my sqli
			if(mysqli_affected_rows($connection))
			{
			   header('Location: login2.php');
			}
			else 
			echo "404";
		   }
	else
	{			echo "no connection established error 404";
			
	}
}
?>

<html>
	<head>
		<style>
			body {background-color:663300;}
			#box {       
						background-color:CCCC99;
						color:black;
						font-family:Serif;
						font-weight:bold;
						margin-top:none;
						margin-bottom:20px;
						margin-left:400px;
						margin-right:120px;
						height:160px;        
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
		</style>
	</head>	
<body>
<div id="loginhd"><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSIGN UP</div>
<div id="box">
	<form method="post" action="signup.php"><BR>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbspName : 
		<input type="text" name="name" ><br><br>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbspMobile Number : 
		<input type="number" name="mobile" ><br><br>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbspProfession : 
		<input type="text" name="profession" ><br><br>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUsername : 
		<input type="text" name="username" ><br><br>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbspEmail : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="email" name="email"><br><br>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPassword :&nbsp 
		<input type="password"  name="password"><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="submit" name="submit"> 
	</form>
</div>
	</body>
	</html>