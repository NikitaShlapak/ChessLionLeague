<?php
  require "db.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Chess Lion League</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>

<body style="background: url(img/bg3.jpg);background-attachment: fixed;">


	<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
  		<div class="container-fluid">
    		<a class="navbar-brand" href="index.php"> <img src="img/logo1.2.png" alt="..." style="height: 50px;"></a>
    		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
    		</button>

    		<div class="collapse navbar-collapse" id="navbarNav">
      			<ul class="navbar-nav">
       				 <li class="nav-item">
         				 <a class="nav-link" aria-current="page" href="index.php">Главная</a>
        			</li>
        			<li class="nav-item">
        				  <a class="nav-link" href="history.php">Турниры</a>
       				 </li>
       				 <?php if (isset($_SESSION['logged_user'])):?>
       				 <li class="nav-item">
          				<a class="nav-link" href="profile.php">Профиль</a>
       				 </li> 
       				 <?php endif; ?>  
               <li class="nav-item">
                 <a class="nav-link active" aria-current="page" href="#">О нас</a>
              </li>    
    		  </ul>
   			 </div>
 		 </div>
		</nav>


    
<?php include 'libs/footer.php' ?>
</body>
</html>