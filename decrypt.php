<?php
 
$ALGORITHM = 'AES-128-CBC';
$IV    = '12dasdq3g5b2434b';
 
$error = '';
 
if (isset($_POST) && isset($_POST['action'])) {
  
  $password   = isset($_POST['password']) && $_POST['password']!='' ? $_POST['password'] : null;
  $action = isset($_POST['action']) && in_array($_POST['action'],array('c','d')) ? $_POST['action'] : null;
  $file     = isset($_FILES) && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK ? $_FILES['file'] : null;
  
  if ($password === null) {
    $error .= 'Invalid Password<br>';
  }
  if ($action === null) {
    $error .= 'Invalid Action<br>';
  }
  if ($file === null) {
    $error .= 'Errors occurred while elaborating the file<br>';
  }
  
  if ($error === '') {
  
    $contenuto = '';
    $nomefile  = '';
  
    $contenuto = file_get_contents($file['tmp_name']);
    $filename  = $file['name'];
  
    switch ($action) {
      case 'c':
        $contenuto = openssl_encrypt($contenuto, $ALGORITHM, $password, 0, $IV);
        $filename  = $filename . '.crypto';
        break;
      case 'd':
        $contenuto = openssl_decrypt($contenuto, $ALGORITHM, $password, 0, $IV);
        $filename  = preg_replace( '#\.crypto$#' ,'',$filename);
        break;
    }
    
    if ($contenuto === false) {
      $error .= 'Errors occurred while encrypting/decrypting the file ';
    }
    
    if ($error === '') {
    
      header("Pragma: public");
      header("Pragma: no-cache");
      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Expires: 0");
      header("Content-Type: application/octet-stream");
      header("Content-Disposition: attachment; filename=\"" . $filename . "\";");
      $size = strlen($contenuto);
      header("Content-Length: " . $size);
      echo $contenuto;    
      die;
      
    }
  
  }
  
}
 
 
?>
<html>
  <head>
    <title>Decrypt file and download file</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="encrypt.css">
	<style>
	#heading
	{
		margin-left:300px;
		margin-top:30px;
	}
	#password{
		background-color:#F0FFF0;
		font-size:20px;
		font-color:blue;
		border:2px solid green;
	}
	#action
	{background-color:#F0FFF0;;
		font-size:20px;
		border:2px solid green;
	}
	.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: black;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: white;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
	
	</style>
  </head>
  <body>
  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="encrypt.php">Encrypt</a>
  <a href="upload.php">Upload Files</a>
  <a href="decrypt.php">Download Files</a>
  <a href="#">Logout</a>
    <a href="index.php">Login</a>
</div>
<!--
<h2>Animated Sidenav Example</h2>
<p>Click on the element below to open the side navigation menu.</p> -->
<span style="font-size:30px;cursor:pointer; color:white" onclick="openNav()"><h2>&#9776open</h2></span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
    <div class="container">
      <div class="row">
        <div class="col-12" >
            <h1 id="heading"> Decrypt and download file</h1>
        </div>
      </div>
      <?php if ($error != '') { ?>
      <div class="row">
        <div class="col-12 alert alert-danger" role="alert">
          <?php echo ($error); ?>
        </div>
      </div>
      <?php } ?>
      <form class="form" enctype="multipart/form-data" method="post" id="form1" name="form1" auto-complete="off">
        <div class="form-row">
          <div class="form-group">
            <label for="file"><h5>File</h5></label>
            <input type="file" name="file" id="file" placeholder="Choose a file" required class="form-control-file"/>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="password"><h5>Password</h5></label>
            <input type="password" name="password" id="password" placeholder="Insert password" required class="form-control" />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="action"><h5>Action<h5></label>
            <select name="action" id="action" required class="form-control">
              <option value="">-- Choose --</option>
              <option value="c">Encrypt</option>
              <option value="d">Decrypt</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <button type="submit" class="btn btn-primary" onclick="setTimeout('document.form1.reset();',1000)"><h5>Decrypt<h5></button>
          <button type="reset" class="btn btn-reset"><h5>Reset</h5></button>
         </div>
      </form>
	  <div align="center">
	  <button class ="btn btn-danger" onclick="window.location.href = 'index.php'">Logout</button>
	  </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>