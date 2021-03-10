<?php
  require "db.php";
  require "libs/memcounter.php";

  
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

<body style="background: url(img/bg3.jpg);background-attachment: fixed ;">


	<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
  		<div class="container-fluid">
    		<a class="navbar-brand" href="#"> <img src="img/logo1.2.png" alt="..." style="height: 50px;"></a>
    		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
    		</button>

    		<div class="collapse navbar-collapse" id="navbarNav">
      			<ul class="navbar-nav">
       				 <li class="nav-item">
         				 <a class="nav-link active" aria-current="page" href="#">Главная</a>
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
        				  <a class="nav-link" href="info.php">О нас</a>
       				 </li>     
    		  </ul>
   			 </div>
 		 </div>
		</nav>


	
	<div class="container-fluid">
		<div class="row">
			
	
			<div class="col-md-9 order-last">
				<h2>Текущий рейтинг-лист команд</h2>
				<table class="table table-dark table-striped table-hover table-bordered" style="width: 100%; opacity: 0.95;">
					<tr class="table-dark">
						<th style="width: 10%">Место</th>
						<th style="width: 70%">Название команды</th>
						<th style="width: 10%">Число участников</th>
						<th style="width: 10%">Рейтинг</th>
					</tr>
					<?php
					$allteams = R::getall('SELECT `id`,`tname`,`rating`,members FROM `teams` ORDER BY `rating` DESC');
					$i=1;
					foreach ($allteams as $team) {?>
					
					<tr>
						<td class="text-center"><?php echo $i;$i++;?></td>
						<form action="teampages/teampage.php" method="POST">
							<td class="text-center">
								<button name="idbut" 
								type="submit" class="btn" style="width: 100%;"><p class="fw-bold text-primary m-auto"><?php echo $team['tname']; ?></p>
								</button>												
							</td>
							<td class="text-center"><?php echo $team['members']; ?><!--number of members-->
								<input name="id" value="<?php echo $team['id']; ?>" type="text" class="invisible" style="height: 1px;width: 1px;">
							</td>
						</form>	
						<td class="text-center"><?php echo $team['rating'];?></td>
					</tr>
					<?php
				}?>					
				</table>
			</div>

		<div class="col-md-3 order-first">	
	
	<?php if (isset($_SESSION['logged_user'])):?>

		<div class="m-2 container-fluid">
		<p class="allign-center"><strong>Привет,<i> <?php echo $_SESSION['logged_user']-> login;?></i>!</strong></p>
	</div>
			
			<form action="logout.php">
				<div class="my-3 mx-1 row">
   					 <button type="submit" class="btn btn-outline-dark mb-3" >Выйти</button>
  				</div>
			</form>
			</div>
		<?php 	else : ?>

		<div class="my-2 row">
			<p class="allign-center text-important"><strong>Кажется, вы не авторизованы. Исправьте это скорее!</strong></p>
			<div class="col-md-12 col-sm-12 col-lg-5">
			<form action="log.php">
				<div class="my-3 mx-1 row">
   					 <button type="submit" class="btn btn-outline-dark mb-3" ><p class="fw-bold">Войти</p></button>
  				</div>
			</form>
			</div>
			<div class="col-md-12 col-sm-12 col-lg-7">
			<form action="reg.php">
				<div class="my-3 mx-1 row">
   					 <button type="submit" class="btn btn-outline-dark mb-3" ><p class="text-break fw-bold">Зарегистрироваться</p></button>
  				</div>
			</form>
			</div>

		</div>
		<?php endif; ?>	
						

			</div>
		</div>

	</div>

	

	
<?php 
include 'libs/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>

</html>