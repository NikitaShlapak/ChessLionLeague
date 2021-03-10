<?php
  require "db.php";
  $user=$_SESSION['logged_user'];
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


    <div class="container-fluid pb-n4">
      <div class="row">        
        <div class="m-2 col-9  mx-auto">
           <table class="table table-dark">
            <!--info-->
            <tr>
              <th colspan="2">
                <h1 class="text-center"><?php echo $user-> login;?></h1>
              </th>
            </tr>             
            <tr>
              <th colspan="2">
                <h5 class="text-center text-light">Фамилия, имя: <strong><?php echo $user-> surname.' '.$user-> name;  ?></strong></h5>
              </th>
            </tr>
            <tr>
              <td>
                <p class="text-center text-light">Дата рождения: <strong class="text-nowrap"><?php echo $user-> bdate ?></strong></p>
              </td>
              <td>
                <p class="text-center text-light">Пол: <strong>
                  <?php 
                    if ($user -> sex =='female'){
                      echo "Женский";
                    } else {
                       echo "Мужской";
                    }?></strong>
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <p class="text-center text-light">Команда:<h3 class="text-center text-light">
                  <?php
                    echo $user-> teams -> tname;
                  ?>
                </h3>
                </p>
              </td>
            </tr>
            <tr>
              <td>                  
                  <p class="text-light text-center">Титул: <strong>
                  <?php

                    if ($_SESSION['logged_user'] -> access <1){
                      echo "Пешка";
                    } else if ($_SESSION['logged_user'] -> access <5){
                      echo "Слон";
                    } else if ($_SESSION['logged_user'] -> access <10){
                      echo "Ладья";
                    } else if ($_SESSION['logged_user'] -> access <100){
                      echo "Ферзь";
                    } else if ($_SESSION['logged_user'] -> access >=100){
                      echo "Администратор";
                    }
                    #echo $_SESSION['logged_user'] -> access;
                    ?></strong>
                  </p>
                </td>
                <td>
                  <a href="info.php" class="link-primary">Что это значит?</a>
                </td>  
            </tr>
            <tr>
              <td colspan="2">
                <p class="text-center text-light">Профиль на Lichess: <strong>
                <a href="<?php echo($_SESSION['logged_user']-> lilink)?>" class="link-light">
                  <?php echo $_SESSION['logged_user']-> liname ?>
                </a>
                </strong>
                </p>
              </td>
            </tr>
           </table> 
           <div class="container-fluid">
            <?php $curtour = R::findone('tournaments','status = 1');
            if ( !isset($curtour) ) :?>
             <form action="swiss/startswiss.php">              
               <button type="submit" class="btn btn-outline-dark mb-3">Начать турнир!</button>
            <?php else : ?>
                <form action="swiss/do_pairings.php">              
               <button type="submit" class="btn btn-outline-dark mb-3">Do</button>
             <?php endif; ?>
             </form>
             <form action="swiss/startswiss.php">              
               <button type="submit" class="btn btn-outline-dark mb-3">Начать турнир!</button>
             </form>
           </div> 
        </div> 
      <!--options--> 
        <div class="col-3 my-n3" style="background: linear-gradient(to left, #212529, rgba(33,37,41,0));">

          <div class="d-grig gap-2">
          <div class="ms-3 my-1 link-light1">
            <a href="profiledit.php" class="link-light nav-link"><p class="text-end">Внести исправления</a></p>
          </div>
          <div class="ms-3 my-1 link-light1">
            <a href="logout.php" class="link-light nav-link"><p class="text-end">Выйти</a></p>
          </div>
          <div class="ms-3 my-1 link-light1">
            <?php 
            $status=$_SESSION['logged_user'] -> status;
            if  ($status!=='active'):?>
            <a href="swiss/act.php" class="link-light nav-link"><p class="text-end">Подать заявку на следующий турнир</a></p>
            <?php else : ?>
              <a href="swiss/inact.php" class="link-light nav-link"><p class="text-end">Сняться с турнира</a></p>
            <?php endif; ?>
          </div>
          </div>
          <?php if ($_SESSION['logged_user']-> access >= 10) :?>
          <div class="ms-3 my-1 link-light1">
            <a href="teampages/teamreg.php" class="link-light nav-link"><p class="text-end">Зарегистрировать команду</p></a>
          </div> 
          <div class="ms-3 my-1 link-light1">
            <a href="swiss/swreg.php" class="link-light nav-link"><p class="text-end">Назначить турнир</p></a>
          </div>
        <?php endif; ?>
        <div class="ms-3 my-1 link-light1">
            <a href="swiss/startswiss.php" class="link-light nav-link"><p class="text-end">startswiss</p></a>
        </div>
        <div class="ms-3 my-1 link-light1">
            <a href="swiss/pairings.php" class="link-light nav-link"><p class="text-end">pairings</p></a>
        </div>
        <div class="ms-3 my-1 link-light1">
            <a href="libs/players_places.php" class="link-light nav-link"><p class="text-end">players_places</p></a>
          </div>
          <?php $curtour = R::findone('tournaments','status = 1');
          if ( isset($curtour) ) :?>
          <div class="ms-3 my-1 link-light1">
            <a href="swiss/list.php" class="link-light nav-link"><p class="text-end">list</p></a>
          </div>
        <?php endif; ?>
          </div>   
        </div>   

   
    </div>

<?php include 'libs/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>