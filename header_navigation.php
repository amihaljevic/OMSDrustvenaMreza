<?php
include "head.php";
session_start();
if(!isset($_SESSION['autoriziran'])){
  header("location: odjava.php");  
}
?>
 <body class="bodyNadzorna">
    <div class="container-fluid">
      <header>
        <h2>OMS</h2>
        <h3 class="nadzornaH3"><?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h3>
      </header>
      <div class="row">
        <div class="col-md-2">
          <!--<div id="sidebar-wrapper">-->
            <ul class="sidebar-nav">
              <li>
                <a href="<?php echo $putanja; ?>nadzorna_ploca.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>Zadaće <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="postavljeneZadace.php">Postavljene zadaće</a></li>
                  <?php if($_SESSION['autoriziran']->admin!=1): ?>
                  <li><a href="<?php echo $putanja; ?>uploadZadace.php">Nova zadaća</a></li>
                <?php endif; ?>
                </ul>
              </li>
              <li>
                <a href="<?php echo $putanja; ?>privatniProfil.php?sifra=<?php echo $_SESSION['autoriziran']->sifra; ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Moj profil</a>
              </li>
              <li>
                <a href="<?php echo $putanja; ?>odjava.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>Odjava</a>
              </li>
            </ul>
        </div>