<?php
$con=mysqli_connect("localhost","root","Password.123","phpapp");

$sql  = "SELECT * FROM files";
$result = mysqli_query($con,$sql);
$files = mysqli_fetch_all($result,MYSQLI_ASSOC);


if(isset($_POST['save']))
{
	$filename = $_FILES['myfile']['name'];
$extension = pathinfo($filename,PATHINFO_EXTENSION);
$file = $_FILES['myfile']['tmp_name'];
$size = $_FILES['myfile']['size'];
if(! in_array($extension,['zip','pdf','png','crypto']))
{
	echo '<script>alert("your file extension must be .zip,.pdf, or .png")</script>'; 
}
elseif($_FILES['myfile']['size'] > 1000000)
{
	
	echo '<script>alert("file is too large")</script>'; 
}
else
{
		$sql = "INSERT INTO files (name,size,downloads)
		values('$filename','$size',0)";
		 if(mysqli_query($con,$sql))
		 {
			
			 echo '<script>alert("file uploaded successfully")</script>'; 
		 }
		 else{
			 echo '<script>alert("failed to upload file")</script>'; 
		 }
	}
}



?>