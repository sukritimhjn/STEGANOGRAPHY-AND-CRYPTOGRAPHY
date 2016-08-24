<?php
session_start();
if($_SESSION['logged']==false){
	header('Location: login2.php');
        exit;
}
$user2=$_GET['value'];
$user1=$_SESSION['username'];
$_SESSION['user2']=$user2;
?>
<html>
	<head>
		<style>
			body{ background-color:663300;
				}
                        #key_generation {
                        background-color:CCCC99;
						color:black;
						font-family:Serif;
						font-weight:bold;
						margin-top:none;
						margin-bottom:20px;
						margin-left:400px;
						margin-right:120px;
						height:300px;        
						width: 500px;
                       }
			#a {
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
		
		<script>
                function func(){
                  var b=document.getElementById("k3").value;
                  var a = <?php echo $_SESSION['a']; ?>;
                  var y=(Math.pow(b,a))%11;
                  if(y>0)
                  document.getElementById("k4").value=y;
                 }
		</script>
		
	</head>
	<body>
		<a href="logout.php"><button type="button">LogOut</button></a>
		<div id="a"><br>
			Key Generation 
		</div>
		
		<div id="key_generation">
			<br><br>
			        <form method="post">
				Enter Secret Integer(a):
				<input type="text" name="integer" id="k1" required><br>
				<input type="submit" name="calc" value="Calculate"><br>
                                </form>
				<form method="post">
				Self Partial Key(A=g^a mod p):
				<input type="text" name="key2"  id="k2" required><br>
				<input type="submit" name="send"><br>
				</form>
				<form method="post">
				User1 Partial Key(B=g^b mod p):
				<input type="text" name="key" id="k3"><br>
				<input type="submit" name="retrieve" value="Retrieve KEY"><br>
				</form>
                                <form method="post" action="decide.php">
				Common Key(B^a mod p = g^ab mod p):
				<input type="text" name="key4" id="k4" required ><br>
				<button type="button" onclick="func()" name="commonkey">Calculate</button><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="submit" value="Encode & Send" name="s_image">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="submit" value="Retrieve & Decode" name="r_image">
				</form>
			
		</div><br>
		
	</body>
</html>

<?php
if(isset($_POST["send"])){  
$connection=mysqli_connect("mysql.hostinger.in","u557576868_crypt","nullcrypt","u557576868_crypt")or die("Error");								// establishing a connection with MySql
	if($connection)
	{      $x=$_POST["key2"];
		   $query1="INSERT INTO `key`(`user1`,`user2` ,`key1`) VALUES ('$user1','$user2','$x')"; 
                   $result=mysqli_query($connection,$query1);													// execution of query my sqli
			if(mysqli_affected_rows($connection)>0)
			{
			   echo "Partial Key Sent";
			}
			else 
			{echo "404";}
}
else
	{			echo "no connection established error 404";
			
	}
}
?>
<?php
if(isset($_POST["retrieve"])){
$connection=mysqli_connect("mysql.hostinger.in","u557576868_crypt","nullcrypt","u557576868_crypt")or die("Error");								// establishing a connection with MySql
	if($connection)
	{     
	      
		  $query="SELECT  `key1` FROM `key` WHERE user1='$user2' AND user2='$user1' ORDER BY `id` DESC LIMIT 1 "; 
                  $result=mysqli_query($connection,$query);													// execution of query my sqli
			if(mysqli_num_rows($result)>0)
			{  $row=mysqli_fetch_assoc($result);
			   $paras=$row['key1'];
			    echo "<script type=\"text/javascript\">
                             var e = document.getElementById('k3');
				e.action='chat.php';
				e.value='$paras';
				e.submit();
                </script>";
			}
			else 
			{echo "404";}
                  if($paras && $paras!="" && $paras>0){
                  $query="DELETE FROM `key` WHERE user1='$user2' AND user2='$user1' "; 
                  $result=mysqli_query($connection,$query);	
}
}
else
	{			echo "no connection established error 404";
			
	}
}
?>
<?php
if(isset($_POST["calc"])){
$x=$_POST["integer"];
echo "<script type=\"text/javascript\">
                             var e = document.getElementById('k1');
				e.action='chat.php';
				e.value='$x';
				e.submit();
                </script>";   
$_SESSION['a']=$x;
$y=(pow(2,$x))%11;		
 echo "<script type=\"text/javascript\">
                             var e = document.getElementById('k2');
				e.action='chat.php';
				e.value='$y';
				e.submit();
                </script>";               
		
               
}
?>