<?php
session_start();
if($_SESSION['logged']==false){
	header('Location: login2.php');
        exit;
}
$user2=$_SESSION['user2'];
$user1=$_SESSION['username'];
$key=$_SESSION['key'];
?>
<html>
	<head>  
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
<title>JS Bin</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


		<style>
			body{ background-color:663300;
				}
			#upload_image {       
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
                      
			#b {
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
		<div id="b"><br>
			Upload Image
		</div>

		<div id="upload_image"><br><br>
			<form method="post" enctype="multipart/form-data">
				Select image to upload:
				<input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);" /><br>&nbsp;&nbsp;&nbsp;&nbsp;
                               
    
                                <input type="submit" value="Upload Image" name="upload_image">
			</form>
		</div><br>
<img id="blah" src="#" alt="your image" />
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
	</body>
</html>
<?php
if(isset($_POST["upload_image"]))
{
	$imgname=$_FILES["fileToUpload"]['tmp_name'];
	$data=fopen($imgname,'rb');
	$size=filesize($imgname);
	$contents=fread($data,$size);
	fclose($data);
	for($i=0;$i<strlen($contents);$i++){
	 $contents[$i]=chr(ord($contents[$i])+$key);
	}
	$encoded=base64_encode($contents);
	$connection=mysqli_connect("mysql.hostinger.in","u557576868_crypt","nullcrypt","u557576868_crypt")or die("Error");								// establishing a connection with MySql
	if($connection)
	{
		   $query="INSERT INTO chat (user1,user2,image) VALUES('$user1','$user2','$encoded')";
                   $result=mysqli_query($connection,$query);		   														// execution of query my sqli
			if(mysqli_affected_rows($connection)>0)
			{
			   echo "sent";
			}
			else 
			echo "404";
		   }
	else
	{			echo "no connection established error 404";
			
	}
}
?>
					