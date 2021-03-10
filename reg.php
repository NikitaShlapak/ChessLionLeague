<?php
	require "db.php";


	$data = $_POST;
	if (isset($data[do_signup])){
		$errors = array();
		if (trim($data['login'])==''){
			$errors[]="Введите логин!";
		}
		if (R::count('users', "login = ?", array($data['login'])) > 0){
			$errors[]="Пользователь с таким именем уже зарегистрирован!";
		}
		if ($data['password']==''){
			$errors[]="Введите пароль!";
		}
		if ($data['password_2']!=$data['password']){
			$errors[]="Повторный пароль неверен!";
		}
		if (trim($data['email'])==''){
			$errors[]="Введите почту!";
		}			
		if (R::count('users', "email = ?", array($data['email'])) > 0){
			$errors[]="К этой почте уже привязана учётная запись";
		}
		if ($data['teamid'] < 1){
			$errors[]="Выберите команду!";
		}
		
	if (empty($errors)){
		//no errors
		$user = R::dispense('users');
		$user -> login = $data['login'];
		$user -> email = $data['email'];
		$user -> password = password_hash($data['password'], PASSWORD_DEFAULT);
		R::store($user);
   		$team = R::findone('teams','id = ?', array($data['teamid']));
    	$team -> ownUsersList[] = $user;
		R::store($team);
		$_SESSION['logged_user']=$user;
		header('location: /');
	} else {
		//error(s) appeared
		echo '<p style="color:red">'. array_shift($errors). '</p>';
	}

	}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<body style="background: url(img/bg3.jpg);background-attachment: fixed;">
	<div class="container-fluid">
  	<div class="my-5 mx-2 row">

		<form action="/reg.php" method="POST">
			<div class="container-fluid m-3">
				<h1 class="allign-center"><strong>Регистрация</strong></h1>
			</div>
		<div class="my-3 mx-1 row">	
			<label class="col-md-3 col-form-label">Логин:</label>
			<div class="col-md-9">
				<input type="login" name="login" class="form-control"value="<?php
				echo @$data[login];?>">
			</div>			
		</div>
		<div class="my-3 mx-1 row">			
			<label class="col-md-3 col-form-label">Пароль:</label>
			<div class="col-md-9">
				<input class="form-control" type="password" name="password">
			</div>
		</div>
		<div class="my-3 mx-1 row">	
			
				<label class="col-md-3 col-form-label">Подтверждение пароля:</label>
				<div class="col-md-9">
				<input class="form-control" type="password" name="password_2">
			</div>
		</div>
		<div class="my-3 mx-1 row">	
			
				<label class="col-md-3 col-form-label">Почта:</label>
				<div class="col-md-9">
				<input class="form-control" type="email" name="email" value="<?php
				echo @$data[email];?>">
			</div>
		</div>
		<div class="my-3 mx-1 row">	
			
			<label class="col-md-3 col-form-label">Команда:</label>
			<div class="col-md-9">
				<select name="teamid" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
 				 	<option value="0" selected>Команда не выбрана</option>
  					<?php
           $data = R::getall('SELECT `id`,`tname` FROM `teams`');
           foreach ($data as $cur) {?>
           <option value="<?php echo $cur[id];?>"> 
           <?php echo $cur[tname]; }?>       
           </option>
				</select>
			</div>
		</div>
		<div class="my-3 mx-1 row">		
			
				<button type=submit class="btn btn-dark mb-3" name="do_signup">Зарегистрироваться</button>
			
		</div>
		</form>
	</div>
	</div>

<?php include 'libs/footer.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
			