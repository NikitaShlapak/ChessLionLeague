<?php
	require "../db.php";
	$all_tour=R::getall('SELECT `id`,`date`,`type` FROM `tournaments`');


	$data = $_POST;
	if (isset($data[do_signup])){
		$errors = array();
		$org = $_SESSION['logged_user'];
		
	if (empty($errors)){
		//no errors
		$new_tour = R::dispense('tournaments');
		$new_tour -> date = $data['date'];
		$new_tour -> type = $data['type'];
		$new_tour -> org_name = $org['login'];
		$new_tour -> org_id = $org['id'];
		$new_tour -> status = 'next';
		$new_tour -> lilink = '';
		$new_tour -> winner = 'undefined';
		$new_tour -> win_id = '0';		
		R::store($new_tour);


    

		
		#header('location: /');
	} else {
		//error(s) appeared
		echo '<p style="color:red">'. array_shift($errors). '</p>';
	}

	}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="../style.css">
	

<body style="background: url(../img/bg3.jpg);background-attachment: fixed;">
<?php include "../libs/navbar.php" ?>
	<div class="container-fluid">
  	<div class="my-5 mx-2 row">

		<form action="../swiss/swreg.php" method="POST">
			<div class="container-fluid m-3">
				<h1 class="allign-center"><strong>Регистрация турнира</strong></h1>
			</div>
		<div class="my-3 mx-1 row">	
			<label class="col-md-3 col-form-label">Дата:</label>
			<div class="col-md-9">
				<input type="date" name="date" class="form-control"value="<?php
				echo @$data[date];?>">
			</div>			
		</div>
		
			
		<!--------------------------------------------------->
		<div class="my-3 mx-1 row">	
			<label class="col-md-3 col-form-label">Тип:</label>
			<div class="col-md-9">
				<select name="type" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
 				 	<option value="undefined" selected>Тип не указан</option>
  					
           			<option value="swiss"> 
          			 	Швейцарская система      
           			</option>
           			 <option value="arena"> 
          				Арена      
           			</option>
				</select>
			</div>
		</div>	
		<!--------------------------------------------
		<div class="my-3 mx-1 row">	
			<label class="col-md-3 col-form-label">Распорядитель:</label>
			<div class="col-md-9">
				<input type="text" name="date" class="form-control"value="<?php
				#echo @$data[date];?>">
			</div>			
		</div>------->
		
		<div class="my-3 mx-1 row">		
			
				<button type=submit class="btn btn-dark mb-3" name="do_signup">Зарегистрировать турнир</button>
			
		</div>
		</form>
	</div>
	</div>

<?php include '../libs/teamfooter.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
			