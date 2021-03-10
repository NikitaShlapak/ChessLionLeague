<?php
  require "../db.php";
  require "../libs/memcounter.php";

  
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	
	<title>Пары</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body style="background: url(../img/bg3.jpg);background-attachment: fixed;">
	<?php include '../libs/navbar.php'; ?>

<?php 
$curtour = R::findone('tournaments','status = 1');
$round=$curtour -> round; 
?>
<div class="container my-5"><h3>Round <?php echo $round ?></h3></div>
	
<div class="container-fluid">
	<form action="resulting.php" method="POST">
		<div class="container-fluid">
			<button type='submit' class="btn btn-outline-dark mb-3 mx-auto">Send</button>
		</div>
		<div>
			<table class="table table-dark table-striped">

				<tr>
					<th style="width: 5%">board</th>
					<th style="width: 15%">white</th>
					<th style="width: 15%">team</th>
					<th style="width: 5%" class="text-center">points</th>
					<th style="width: 15%">black</th>
					<th style="width: 15%">team</th>
					<th style="width: 5%" class="text-center">points</th>
					<th style="width: 25%">
						<div class="container-fluid row p-0 ps-3">
							<div class="col-4">
								<p class="text-start text-nowrap">1-0</p>
							</div>
							<div class="col-4">
								<p class="text-center">1/2</p>
							</div>
							<div class="col-4">
								<p class="text-end text-nowrap">0-1</p>
							</div>
						</div>
					</th>
				</tr>
				<?php 
				$games=R::findall('round');
				foreach ($games as $game) :
				$white = R::findone('battle','id = ?',[$game -> id_white]);
				$black = R::findone('battle','id = ?',[$game -> id_black]);
				?>
				<tr>
					<td class="text-center"><?php echo ($game -> board); ?></td>
					<td><?php echo $white -> users -> login?></td>
					<td><?php echo $white -> users -> teams -> tname ?></td>
					<td class="text-center"><?php echo $white -> points?></td>
					<td><?php echo $black -> users -> login?></td>
					<td><?php echo $black -> users -> teams -> tname ?></td>
					<td class="text-center"><?php echo $black -> points?></td>
					<td><input type="range" class="form-range dark" min="0" max="2"name="b<?php echo($game -> board)?>result" value="<?php echo($game -> result); ?>"></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>	
	</form>
</div>


	<?php include '../libs/teamfooter.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>