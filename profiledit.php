<?php
  require "db.php";

  $user = $_SESSION['logged_user'];
  
  $ct=$user -> teams_id;
  #echo $ct;
  #var_dump( $old_team);
  $data = $_POST;

  if (isset($data[do_change])){
    $errors = array();    
    
  if (empty($errors)){
    //no errors
   
    $user -> name = $data['name'];
    $user -> surname = $data['surname'];
  
    $user -> sex = $data['sex'];
    $user -> bdate = $data['bdate'] ;
    $user -> liname = $data['liname'];
    $user -> lilink = $data['lilink'];
R::store($user);
    $team = R::findone('teams','id = ?', array($data['teamid']));
    $team->ownUsersList[]=$user;
R::store($team);
  
    header('location: /');
  } else {
    //error(s) appeared
    echo '<p style="color:red">'. array_shift($errors). '</p>';
  }

  }
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
               <li class="nav-item">
                  <a class="nav-link active" href="#">Профиль</a>
               </li> 
               <li class="nav-item">
                  <a class="nav-link" href="info.php">О нас</a>
               </li>        
          </ul>
         </div>
     </div>
    </nav>          

    <div class="container-fluid">
    <div class="my-5 mx-2 row">

    <form action="/profiledit.php" method="POST">
      <div class="container-fluid m-3">
        <h1 class="allign-center"><strong><?php echo $_SESSION['logged_user']-> login;?></strong></h1>
      </div>

    <div class="my-3 mx-1 row"> 
      <label class="col-md-3 col-form-label">Фамилия:</label>
      <div class="col-md-9">
        <input type="text" name="surname" class="form-control"value="<?php
        if (empty($data[surname])){
          echo($_SESSION['logged_user']-> surname);
        } else {      
          echo @$data[surname];}
        ?>">
      </div>      
    </div>

    <div class="my-3 mx-1 row"> 
      <label class="col-md-3 col-form-label">Имя:</label>
      <div class="col-md-9">
        <input type="text" name="name" class="form-control"value="<?php
        if (empty($data[name])){
          echo($_SESSION['logged_user']-> name);
        } else {      
          echo @$data[name];}
          ?>">
      </div>      
    </div>

    <div class="my-3 mx-3">       
        <label class="col-md-3 col-form-label">Пол:</label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sex" value="male" checked>
            <label class="form-check-label">
            Мужской
            </label>
        </div>
        <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="sex" value="female" >
              <label class="form-check-label">
              Женский
              </label>
        </div>
    </div>

    <div class="my-3 mx-1 row"> 
      <label class="col-md-3 col-form-label">Дата рождения</label>
      <div class="col-md-9">
        <input type="date" name="bdate" class="form-control"value="<?php
        if (empty($data[bdate])){
          echo($_SESSION['logged_user']-> bdate);
        } else {      
          echo $data[bdate];}
          ?>">
      </div>      
    </div>   



    <div class="my-3 mx-1 row">       
      <label class="col-md-3 col-form-label">Команда:</label>
      <div class="col-md-9">
        <select name="teamid" class="form-select form-select-lg" aria-label=".form-select-lg example">
          
          <?php
           $data = R::getall('SELECT `id`,`tname` FROM `teams`');
           foreach ($data as $cur) {
          ?>
           <option <?php 
           if ($user -> teams == $cur['id']):?> active <?php endif; ?> 
            value="<?php echo $cur[id];?>"> 
          <?php echo $cur[tname]; }?>       
           </option>  
        </select>
      </div>
    </div>
       
    <div class="my-3 mx-1 row"> 
      <label class="col-md-3 col-form-label">Ник на Lichess:</label>
      <div class="col-md-9">
        <input type="Text" name="liname" class="form-control"value="<?php
        if (empty($data[liname])){
          echo ($_SESSION['logged_user']-> liname);
        } else {      
          echo @$data[liname];}
          ?>">
      </div>      
    </div>

     <div class="my-3 mx-1 row"> 
      <label class="col-md-3 col-form-label">Профиль на Lichess:</label>
      <div class="col-md-9">
        <input type="link" name="lilink" class="form-control"value="<?php
        if (empty($data[lilink])){
          echo ($_SESSION['logged_user']-> lilink);
        } else {      
          echo @$data[lilink];}
          ?>">
      </div>      
    </div>

    <div class="my-3 mx-1 row">       
        <label class="col-md-3 col-form-label">Почта:</label>
        <div class="col-md-9">
        <input class="form-control" disabled type="email" name="email" value="<?php echo $_SESSION['logged_user']-> email;?>">
      </div>
    </div>
    <div class="my-3 mx-1 row">
        <button type=submit class="btn btn-dark mb-3" name="do_change">Подтвердить</button>      
    </div>
    </form>
   
  </div>
  </div>
    

<?php ;include 'libs/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>