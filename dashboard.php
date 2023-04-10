<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
  background-image: url("bachg.jpg");
  background-repeat: no-repeat; /* Do not repeat the image */
   background-size: cover; 
}

h1{
	margin-left:10 px;
}
.sidenav {
  height: 100%;
  width: 25%;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
 background-color: black; 
  overflow-x: hidden;
  padding-top: 25px;
}

.sidenav a {
  padding: 50px 15px 10px 16px;
  text-decoration: none;
  font-size: 30px;
  color: white;
  display: block;
}

.sidenav a:hover {
  color: red;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>


<div class="sidenav">
  <a href="encrypt.php">Encrypt Files</a>
  <a href="upload.php">Upload Files</a>
  <a href="decrypt.php">Download Files</a>
  <a href="index.php">Logout</a>
</div>


   
</body>
</html> 
