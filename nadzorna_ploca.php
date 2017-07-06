<?php include "header_navigation.php"; ?>
<?php 
  if(isset($_POST['objava'])){
  $izraz = $veza->prepare("insert into status (tekst, korisnik, vrijeme) values (:status, :korisnik, now())");
  $izraz->bindValue(':korisnik', $_POST['korisnik']);
  $izraz->bindValue(':status', $_POST['status']);
  $izraz->execute();
  header("location: nadzorna_ploca.php");
  }
?>

<div class="col-md-8">
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group input-group">
      <div class="input-group">
      <span class="input-group-addon" style="height:54px"> <img src="<?php echo $_SESSION['autoriziran']->avatar; ?>" style="width:54px height:54px" class="slikaStatusa"/></span>
      <input type="hidden" name="korisnik" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
      <textarea name="status" cols="50" rows="2" maxlength="255" class="form-control" id="username" placeholder="Napiši status" style="border-left:0"></textarea>
    </div>
      <button type="submit" class="btn btn-default pull-right nadzornaBtn" name="objava">Objavi</button>
    </div>
  </form>
                 
<?php
  $izraz=$veza->prepare("select a.*, b.ime, b.prezime, b.sifra as korisnik_sifra from status a inner join korisnik b on a.korisnik=b.sifra order by a.vrijeme DESC");
  $izraz->execute();
  $statusi=$izraz->fetchALL(PDO::FETCH_OBJ);
  foreach ($statusi as $status): 
?>

  <div class="row">             
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $status->ime . " " . $status->prezime; ?></h3>
      </div>
      <div class="panel-body">
        <p><?php echo $status->tekst; ?></p>
        <hr>
        <p>
          
          <span class="glyphicon glyphicon-heart">

            <?php
              $statusID = $status->sifra;
              $liked = false;
              $izraz=$veza->prepare("select COUNT(liked) as numberLikes from likestatus where status=$statusID");
              $izraz->execute();
              $likeovi=$izraz->fetch(PDO::FETCH_OBJ);
              $izraz=$veza->prepare("select * from likestatus where status=$statusID");
              $izraz->execute();
              $likes=$izraz->fetchALL(PDO::FETCH_OBJ);
              foreach ($likes as $like) {
                if ($like->korisnik == $_SESSION['autoriziran']->sifra) {
                  $liked = true;
                }
              }
              if ($liked == true) {
              echo "<span class='status statusLiked' id='liked'>" . $likeovi->numberLikes . "</span>";
              }
              else {
                echo "<span class='status statusNotLiked' id='" . $statusID . "'>" . $likeovi->numberLikes . "</span>";
              }
            ?>

          </span> 
          <span class="komentari" id="<?php echo $statusID; ?>"> Komentari </span>          
        </p>
      </div>
    </div>
    <div class="izlistaniKomentari" id="izlistani_<?php echo $statusID; ?>"></div>
    <div class="form-group input-group">
      <div class="input-group">
      <span class="input-group-addon"> <img src="<?php echo $_SESSION['autoriziran']->avatar; ?>" class="slikaAvatara" /></span>
      <input type="hidden" id="korisnik_<?php echo $statusID; ?>" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
      <textarea name="text" cols="50" rows="1" minlength="1" maxlength="255" class="form-control" id="komentar_<?php echo $statusID; ?>" placeholder="Napiši komentar" style="border-left:0"></textarea>
    </div>
      <button class="btn btn-default pull-right komentiraj" id="<?php echo $statusID; ?>">Komentiraj</button>
    </div>
  </div>

  <?php endforeach; ?>

</div>

<?php include "korisnici.php"; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
  $(".status").click(function(){
    if ($(this).attr("id") !== "liked") {
    var ovajStatus = $(this);
    var status = ovajStatus.attr("id");
    var korisnik = <?php echo $_SESSION['autoriziran']->sifra ?>;
    $.ajax({
    type: "POST",
    url: "like.php",
    data: "status=" + status + "&korisnik=" + korisnik,
    success: function(msg){
      brojLikeova=$.parseJSON(msg);
      ovajStatus.removeClass("statusNotLiked").addClass("statusLiked");
      ovajStatus.attr("id", "liked");
      ovajStatus.html(brojLikeova.numberLikes);
    }
    });
    }
      return false;
  });
  $(".komentari").click(function(){
    $(".izlistaniKomentari").html("");
      var ovajStatus = $(this);
      var status = ovajStatus.attr("id");
      $.ajax({
      type: "POST",
      url: "izlistajKomentare.php",
      data: "status=" + status,
      success: function(msg){
      podaci=$.parseJSON(msg);
      $.each(podaci, function(i, item){
      $("#izlistani_" + status).append($('<p><img src="' + item.avatar + '" style="width:25px" />' + item.ime + ' ' + item.prezime + '</p><p>' + item.naziv + '</p>'));
      });
      }
      });
        return false;
  });
  $(".komentiraj").click(function(){
    var status = $(this).attr("id");
    var korisnik = $("#korisnik_" + status).val();
    var naziv = $("#komentar_" + status).val();
    $.ajax({
    type: "POST",
    url: "komentiraj.php",
    data: "status=" + status + "&korisnik=" + korisnik + "&naziv=" + naziv,
    success: function(msg){
    podaci=$.parseJSON(msg);
    $("#izlistani_" + status).html("");
    $("#komentar").val("");
    $.each(podaci, function(i, item){
    $("#izlistani_" + status).append($('<p><img src="' + item.avatar + '" style="width:25px" />' + item.ime + ' ' + item.prezime + '</p><p>' + item.naziv + '</p>'));
    });
    }
    });
      return false;
  });
</script>
</body>
</html>