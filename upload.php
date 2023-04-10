<?php include 'filesLogic.php';?>
<!Doctype Html>
<html>
<head>
<title>File upload</title>
<link rel="stylesheet" href="style.css">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="bs-example">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="index.php" class="nav-link active">Logout</a>
        </li>
       
    </ul>
</div>
<div class ="container">
  <div  class="row">
 
<!--  <a class="navbar-brand" href="index.php">Files App</a>  -->
     <form action ="upload.php" method ="post" enctype="multipart/form-data">
	 <div >
        <h3><kbd>Upload Files</kbd></h3><br>
		</div>
		
      <input type="file" name="myfile"><br> 
        <button type="submit" class="btn btn-danger" name="save">Upload</button>
     </form>
   
   </div>
  <div class ="row">
       <table class="table table-dark table-striped">
          <thread>
		        <th>  FileName  </th>
			<th>  Size(in mb)  </th>
		<!--	<th>  Downloads  </th> -->
			<th>  Action  </th>
	      </thread>
	<tbody>
			<?php foreach($files as $file):?>
			<tr>
				<td><?php echo $file['name'];?></td>
				<td><?php echo $file['size'] / 1000 ."KB";?></td>
			<!--	<td><?php echo $file['downloads'];?></td> -->
				<td>
				<button class="="btn btn-danger"  onclick="window.location.href = 'decrypt.php'">Download</button>
				</td>
			</tr>
			<?php endforeach ;?>
	</tbody>
	</table>
	</div>
</div>


</body>
</html>