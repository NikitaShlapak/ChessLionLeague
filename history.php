<?php
  require "db.php";
  
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Chess Lion League</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>

<body style="background: url(img/bg3.jpg);background-attachment: fixed;">

	
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
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
        				  <a class="nav-link active" href="#">Турниры</a>
       				 </li>
       				 <?php if (isset($_SESSION['logged_user'])):?>
               <li class="nav-item">
                  <a class="nav-link" href="profile.php">Профиль</a>
               </li> 
               <?php endif; ?>  
               <li class="nav-item">
                  <a class="nav-link" href="info.php">О нас</a>
               </li>     
    		  </ul>
   			 </div>
 		 </div>
		</nav>
    <h3>Наши последние турниры</h3>
    <table class="table table-dark table-striped table-hover table-bordered" style="width: 100%;opacity: 0.95;">
          <tr class="table-dark">
            <th class="text-center" style="width: 20%">Дата</th>
            <th class="text-center" style="width: 60%">Победитель</th>
            <th class="text-center" style="width: 20%">Тип</th>            
          </tr>
          <tr>
            <td><a class="nav-link text-center" href="https://lichess.org/tournament/DkSl8j2U" style="color: #fff;">30.01.2021</a></td>
            <td><a class="nav-link text-center" href="https://lichess.org/team/cpxJZAlS" style="color: #fff">Шахматный клуб РГГУ</a></td>
            <td><a class="nav-link text-center" href="https://lichess.org/tournament/DkSl8j2U" style="color: #fff">Арена</a></td>            
          </tr>
          
        </table>






<?php include 'libs/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>