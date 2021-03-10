<?php
  require "../db.php";
  require "../libs/memcounter.php";

  
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	
	<title>Турнирная таблица</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body style="background: url(../img/bg3.jpg);background-attachment: fixed;">
	<?php include '../libs/navbar.php'; 
$curtour = R::findone('tournaments','status = 1');?>


<div class="container my-5"><h3>After round <?php echo $curtour -> round; ?></h3></div>
	
<div class="container-fluid">
	<form action="">
		<div class="container-fluid">
			<button type='submit' class="btn btn-outline-dark mb-3 mx-auto">create pairings</button>
		</div>
		<div>
			<table class="table table-dark table-striped table-bordered">
				<tr>
					<th style="width: 10%" class="text-center">place</th>
					<th style="width: 30%">login</th>
					<th style="width: 30%">team</th>
					<th style="width: 10%" class="text-center">points</th>
					<th style="width: 10%" class="text-center">AC1</th>
					<th style="width: 10%" class="text-center">AC2</th>
				</tr>
				<?php 
				$players = R::findall('battle','ORDER BY `place`');



				foreach ($players as $player): 
				?>
				<tr>
					<td class="text-center"><?php echo ($player -> place); ?></td>
					<td <?php if ($player -> status <1): ?>class="text-muted"<?php endif ?>><?php echo ($player -> users -> login) ?></td>
					<td><?php echo ($player -> users -> teams -> tname) ?></td>
					<td class="text-center"><?php echo ($player -> points); ?></td>
					<td class="text-center"><?php echo ($player -> cb); ?></td>
					<td class="text-center"><?php echo ($player -> zb); ?></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>	
	
		
	</form>
</div>


<!--<p class="text-start">1-0</p><p class="text-center">1/2</p><p class="text-end">0-1</p>-->





	<?php include '../libs/teamfooter.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>