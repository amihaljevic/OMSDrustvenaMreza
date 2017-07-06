<?php include "header_navigation.php"; ?>
<?php 
if(isset($_POST['predaj'])){
$izraz = $veza->prepare("insert into uploadzadaca (zadaca, korisnik, putanja) values (:zadaca, :korisnik, :putanja)");
$izraz->bindValue(':korisnik', $_POST['korisnik']);
$izraz->bindValue(':zadaca', $_POST['zadaca']);
$izraz->bindValue(':putanja', $_POST['putanja']);
$izraz->execute();
header("location: uploadZadace.php");
}
if(isset($_POST['promjena'])){
$izraz = $veza->prepare("update uploadzadaca set putanja=:putanja where sifra=:sifra");
$izraz->bindValue(':putanja', $_POST['putanja']);
$izraz->bindValue(':sifra', $_POST['sifra']);
$izraz->execute();
header("location: uploadZadace.php");
}
?>

        <div class="col-md-8">
        <?php
        $vrijeme = date("Y-m-d");
        $izraz=$veza->prepare("select * from zadaca");
        $izraz->execute();
        $zadace=$izraz->fetchALL(PDO::FETCH_OBJ);
        foreach ($zadace as $zadaca):
        if ($zadaca->pocetak <= $vrijeme && $zadaca->kraj >= $vrijeme):
        ?>
      <div class="panel panel-default">
        <div class="panel-heading">
      <h3 class="panel-title"><?php echo $zadaca->naziv; ?></h3>
        </div>
      <div class="panel-body">
      <p>
        <?php echo $zadaca->opiszadatka; ?>
      </p>
    </div>
    <div class="panel-footer">
      
      Rok predaje: <?php echo $zadaca->pocetak; ?> - <?php echo $zadaca->kraj; ?>
      
    </div>
    </div>
       <?php 
              $izraz=$veza->prepare("select * from uploadzadaca where korisnik=:korisnik and zadaca=:zadaca");
              $izraz->bindValue(':korisnik', $_SESSION['autoriziran']->sifra);
              $izraz->bindValue(':zadaca', $zadaca->sifra);
              $izraz->execute();
              $korisnikovaZadaca=$izraz->fetch(PDO::FETCH_OBJ);
              if ($korisnikovaZadaca==null): ?>
              <div class="row">
              <form method="POST">
              <div class="from-group input-group upload-zadace">
              <input type="hidden" name="korisnik" value="<?php echo $_SESSION['autoriziran']->sifra; ?>">
              <input type="hidden" name="zadaca" value="<?php echo $zadaca->sifra; ?>">
              <input type="text" name="putanja" cols="50" class="form-control" id="putanja" placeholder="Postavite URL do vaše zadaće">
              <button class="btn btn-default pull-right nadzornaBtn" name="predaj">Predaj</button>
              </div>
              </form>
            </div>
            <?php endif;
            if ($korisnikovaZadaca!=null): ?>
             <form method="POST">
              <div class="from-group input-group upload-zadace">
              <input type="hidden" name="sifra" value="<?php echo $korisnikovaZadaca->sifra; ?>">
              <input type="text" name="putanja" cols="50" class="form-control" id="putanja" value="<?php echo $korisnikovaZadaca->putanja; ?>">
              <button class="btn btn-default pull-right nadzornaBtn" name="promjena">Promjeni</button>
              </div>
              </form>
      <?php
      endif;
      endif;
      endforeach; ?>
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