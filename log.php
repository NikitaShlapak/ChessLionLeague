<?php
  require "db.php";


  $data = $_POST;
  if (isset($data[do_log])){
    $errors = array();
    $user = R::findone('users', 'login = ?', array($data['login']));
    if($user){
      if (password_verify($data['password'], $user -> password)) {
        header('location: /');
      } else {
        $errors[]='Пароль неверен';

      }
    } else {
      $errors[]='Пользователь с таким именем не найден';
      
    }

    if (empty($errors)){
    //no errors
      $_SESSION['logged_user']=$user;
    //echo '<p style="color:green">'. "Добро пожаловать!". '</p>';
  } else {
    //error(s) appeared
    echo '<p style="color:red">'. array_shift($errors). '</p>';
  }

  }


?>  
<body style="background: url(img/bg3.jpg);background-attachment: fixed;">  

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


<div class="container-fluid">
  <div class="my-5 mx-2 row">
  <form action="/log.php" method="POST">	
		<h3>Вход</h3>
			<div class="mb-3 row">
    			<label class="col-md-4 col-form-label">Логин</label>
    			   <div class="col-md-8">
      		      <input type="login" name="login"class="form-control" value="<?php
                echo @$data[login];?>">
   		          </div>
  		</div>
 				<div class="mb-3 row">
    				<label for="inputPassword" class="col-md-4 col-form-label" value="example123" >Пароль</label>
    				<div class="col-md-8">
      					<input type="password" name="password" class="form-control" id="inputPassword">
    				</div>
    			</div>
    			<div class="mb-3 row">
   					 <button type="submit" class="btn btn-dark mb-3" name="do_log">Войти</button>
  				</div>
  			</form>
      </div>
  </div>
  <?php include 'libs/footer.php' ?>
</body>