<?php
	require "../db.php";

	$data = $_POST;

	if (isset($data[do_signupt])){
		$errors = array();
		if (trim($data['tname'])==''){
			$errors[]="Ведите название команды!";
		}
		
		if (empty($errors)){
		//no errors
			$team = R::dispense('teams');
			$team -> tname = $data['tname'];
			$team -> ins = $data['ins'];
			$team -> story = $data['story'];
			R::store($team);		
		} else {
		//error(s) appeared
		echo '<p style="color:red">'. array_shift($errors). '</p>';
		}
	}
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
<?php include "libs/navbar.php" ?>
	<div class="container-fluid">
  	<div class="my-5 mx-2 row">

		<form action="/teamreg.php" method="POST">
			<div class="container-fluid m-3">
				<h1 class="allign-center"><strong>Регистрация новой команды</strong></h1>
			</div>
		<div class="my-3 mx-1 row">	
			<label class="col-md-3 col-form-label">Название:</label>
			<div class="col-md-9">
				<input type="login" name="tname" class="form-control"value="<?php
				echo @$data[tname];?>">
			</div>			
		</div>	
		
		<div class="my-3 mx-1 row">	
			
				<label class="col-md-3 col-form-label">Учебное заведение:</label>
				<div class="col-md-9">
				<input class="form-control" type="text" name="ins" value="<?php
				echo @$data[ins];?>">
			</div>
		</div>

		<div class="my-3 mx-1 row">	
			
				<label class="col-md-3 col-form-label">Описание: </label>
				<div class="col-md-9">
				<textarea class="form-control" rows="3" type="text" name="story" ><?php
				echo @$data[story];?></textarea>
			</div>
		</div>
		
		<div class="my-3 mx-1 row">		
			
				<button type=submit class="btn btn-dark mb-3" name="do_signupt">Зарегистрировать</button>
			
		</div>
		</form>
	</div>
	</div>

<?php include 'libs/footer.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
			</html>