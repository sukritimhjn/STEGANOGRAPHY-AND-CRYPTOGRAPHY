<?php
session_start();
if($_SESSION['logged']==false){
	header('Location: login2.php');
        exit;
}
$user1=$_SESSION['username'];
$user2=$_SESSION['user2'];
$key=$_SESSION['key'];
?>

<html>
	<head>
		<style>
			body{ background-color:663300;
				}
			#retrieve_image {       
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
                    
			#c {
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
		<a href="logout.php"><button type="button">LogOut</button></a>
	
		<div id="c"><br>
			Retrieve Image
		</div>
	
		<div id="retrieve_image"><br><br>
			<form method="post" >
				Retrieve image:
				<input type="submit" value="Retrieve Image" name="retrieve_image">
			</form>
		</div>
                
	
	</body>
</html>
<?php
if(isset($_POST["retrieve_image"])){
$connection=mysqli_connect("mysql.hostinger.in","u557576868_crypt","nullcrypt","u557576868_crypt")or die("Error");								// establishing a connection with MySql
	if($connection)
	{      
		   $query="select image from chat where user1='$user2' AND user2='$user1' ORDER BY `id` DESC LIMIT 1"; 
           $result=mysqli_query($connection,$query);													// execution of query my sqli
			if(mysqli_num_rows($result)>0)
			{  $row=mysqli_fetch_assoc($result);
			   $paras=$row['image'];
			   $paras1=base64_decode($paras);
			   for($i=0;$i<strlen($paras1);$i++){
	                   $paras1[$i]=chr(ord($paras1[$i])-$key);
	                    }
			   $paras=base64_encode($paras1);
			  echo "<img alt=Embedded Image src=\"data:image/png;base64,$paras\" />";
			}
			else 
			{echo "404";}
}
else
	{			echo "no connection established error 404";
			
	}
}
?>