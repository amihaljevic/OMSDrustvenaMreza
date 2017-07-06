<?php include "header_navigation.php";
$poruke=array();
$porukeRegistracija=array();
if(isset($_POST['promjenaAvatara'])){
  if ($_FILES['slika']) {
    $korisnikID = $_POST['sifra'];
    $slike_dir = "slike/";
    $ext = pathinfo($_FILES['slika']['name'], PATHINFO_EXTENSION);
    $slika_datoteka = $slike_dir . "avatar_" . $korisnikID . "." . $ext;
    $izraz1 = $veza->prepare("update korisnik set avatar='$slika_datoteka' where sifra=$korisnikID");
    $izraz1->execute();
    echo $slika_datoteka;
    move_uploaded_file($_FILES["slika"]["tmp_name"], $slika_datoteka);
  }
  header("location: nadzorna_ploca.php");
}
if(isset($_POST['promjeni'])){
if($_POST['lozinka'] == "" || $_POST['lozinka'] != $_POST['lozinka2']){
	array_push($poruke, "Unešene lozinke nisu identične");
	goto ostalo;
}
  $izraz = $veza->prepare("update korisnik set ime=:ime, prezime=:prezime, lozinka=:lozinka where sifra=:sifra");
  $izraz->bindValue(":sifra",$_POST['sifra']);
  $izraz->bindValue(":ime",$_POST['ime']);
  $izraz->bindValue(":prezime",$_POST['prezime']); 
  $izraz->bindValue(":lozinka",md5($_POST['lozinka']));
  $izraz->execute();
  header("location: privatniProfil.php?sifra=" . $_POST['sifra']);
}
if(isset($_POST['registracija'])){
  if($_POST['lozinka'] == "" || $_POST['lozinka'] != $_POST['lozinka2'] || count($_FILES['avatar']) == 0){
  array_push($porukeRegistracija, "Sva polja su obavezna");
  goto ostalo;
}
 $izraz = $veza->prepare("insert into korisnik (ime, prezime, korisnicko_ime, lozinka) values (:ime, :prezime, :korisnicko_ime, :lozinka)");
  $izraz->bindValue(":ime",$_POST['ime']);
  $izraz->bindValue(":prezime",$_POST['prezime']); 
  $izraz->bindValue(":korisnicko_ime",$_POST['korisnicko_ime']); 
  $izraz->bindValue(":lozinka",md5($_POST['lozinka']));
  $izraz->execute(); 
  $zadnji=$veza->lastInsertId();
 if ($_FILES['avatar']) {
    $slike_dir = "slike/";
    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $slika_datoteka = $slike_dir . "avatar_" . $zadnji . "." . $ext;
    $izraz1 = $veza->prepare("update korisnik set avatar='$slika_datoteka' where sifra=$zadnji");
    $izraz1->execute();
    echo $slika_datoteka;
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $slika_datoteka);
  }
  header("location: nadzorna_ploca.php");
}
ostalo:
?>
<div class="col-md-8">
<?php
$korisnikID = $_GET['sifra']; 
$izraz=$veza->prepare("select * from korisnik where sifra=$korisnikID");
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);
?>
<p style="text-align:center">
<img src="<?php echo $korisnik->avatar; ?>" style="width:30%" class="profilAvatar" />
<?php 
if ($korisnikID == $_SESSION['autoriziran']->sifra) {
include "updateProfila.php";
   if(!empty($poruke)): ?>
  <?php foreach ($poruke as $p): ?>
  <span><?php echo $p; ?></span>
  <?php 
  endforeach; 
  endif;
}
else {
  echo "<h1 style='text-align:center'>" . $korisnik->ime . " " . $korisnik->prezime . "</h1>";
}
?>
</p>
<?php 
if ($korisnikID == $_SESSION['autoriziran']->sifra and $korisnik->admin == 1) {
  include "unosKorisnika.php";
   if(!empty($porukeRegistracija)): ?>
  <?php foreach ($porukeRegistracija as $p): ?>
  <span><?php echo $p; ?></span>
  <?php 
  endforeach; 
  endif;
  }
if ($korisnik->admin != 1) {
include "zadacePrivatniProfil.php";
}
  ?> 
</div>
<?php include "korisnici.php"; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>


    </script>
  </body>
</html>