<?php
 require "../db.php";
 #require "libs/memcounter.php";

 $data=$_POST; 
 $team=R::findone('teams','id = ?', [$data['id']]);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Chess Lion League</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="/style.css">
	
</head>
<body style="background: url(/img/bg3.jpg);background-attachment: fixed;">

<?php include "../libs/navbar.php" ?>


    <div class="m-3 row  container-fluid">

      <div class="col-md-3 col-sm-6 ">        
        <div class="text-center"><img src="/img/no_avatar.jpg" alt="" ></div>
      </div>
      <div class="col-md-9 col-sm-6 px-5 my-auto ">
        <div class="row">
          <div class="col-9"><h1><?php echo $team['tname']; ?></h1></div>

          <div class="col-3">
            <?php 
            if (
              ( ($_SESSION['logged_user']-> access == 5) and ($_SESSION['logged_user'] -> teamid == $team['id']) )
              or ($_SESSION['logged_user']-> access >= 10) ) :?>
          <div>
            <form action="#">
              <button type="submit" class="btn btn-outline-dark mb-3" >Редактировать</button>
            </form>
          </div>           
        <?php endif; ?>
      </div>
          

        </div> 
          
      </div>
      
    </div>

    <div class="m-3 row container-fluid">

      <div class="col-md-4 col-sm-6 ">        
        <div class="text-center">
          <table class="table table-dark">
            <tr class="table-dark">
            <th style="width: 15%;"></th>
            <th>Ник</th>
          </tr>
          <?php $members =  $team -> ownUsersList;
          $i=1; 
          foreach ($members as $member) {?>
          <tr>
            <td><?php echo $i;$i++;?></td>           
            <td><?php if (($_SESSION['logged_user'] -> login)==$member['login']){
              ?><strong><?php };
               echo $member['login'];
               if (($_SESSION['logged_user'] -> login)==$member['login']){
              ?></strong><?php } ?></td>
          </tr><?php } ?>
          </table>
        </div>
      </div>

      <div class="col-md-8 col-sm-6 px-5 my-auto bg-dark">

         <div class="d-grid py-3 gap-3">
            <div class="p-2 bg-light">
              <div class="row">
                <div class="col-6">
                  <label>Рейтинг:<?php echo $team['rating']; ?></label>
                </div>
                <div class="col-6">
                  <label>Участников:<?php echo $team['members']; ?></label>
                </div>
              </div>
            </div>
            <div class="p-2 bg-light">
              <label>
                На Lichess.org: <?php echo $team['lilink'] ?>
              </label>
            </div>
            <div class="p-2 bg-light">
              <p>Описание</p><br>
              <p><?php echo $team['story'] ?></p>
            </div>
          </div>
      </div>
      
    </div>




<?php include '../libs/teamfooter.php' ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
 
  </body>
  </html>