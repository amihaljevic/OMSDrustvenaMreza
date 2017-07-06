<?php include "head.php"; ?>
  <body class="bodyIndex">
    <div class="container">
      <div class="rowIndex">
        <div class="col-md-6" id="logo">
          <h1 style="margin-top:150px;">OMS</h1>
          <h1>društvena<br>mreža</h1>
        </div>
        <div class="col-md-6" id="forma">
          <form class="indexForma">
            <h2 class="indexH2">Prijava</h2>
            <div class="form-group">
              <input type="text" class="form-control form-controlIndex" id="korisnicko_ime" placeholder="Korisničko ime">
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-controlIndex" id="lozinka" placeholder="Lozinka">
            </div>
            <a href="#" id="prijava" class="btn btn-default">Prijavi se</a>
          </form>
          <p id="poruka"></p>
      </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
       $("#lozinka").keypress(function(e) {
          if(e.which == 13) {
            $("#poruka").html("");
            $.ajax({
              type: "POST",
              url: "prijava.php",
              data: "korisnicko_ime=" + $("#korisnicko_ime").val() + "&lozinka=" + $("#lozinka").val(),
              success: function(msg){
                if(msg=="true"){
                  window.location="nadzorna_ploca.php";
                }
                else{
                  $("#poruka").html("Neispravno uneseno korisničko ime i lozinka.<br /> Molimo unesite ponovno.");
                }                
              }
            });
          }
        });
        $("#prijava").click(function(){
          console.log("here");
          $("#poruka").html("");
          $.ajax({
            type: "POST",
            url: "prijava.php",
            data: "korisnicko_ime=" + $("#korisnicko_ime").val() + "&lozinka=" + $("#lozinka").val(),
            success: function(msg){
              if(msg=="true"){
                window.location="nadzorna_ploca.php";
              }
              else{
                $("#poruka").html("Neispravno uneseno korisničko ime i lozinka.<br /> Molimo unesite ponovno.");
              }            
            }
          });          
     return false;
       
});
    $("#prijava").click(function(){
      $("#poruka").html("");
      $.ajax({
        type: "POST",
        url: "prijava.php",
        data: "korisnicko_ime=" + $("#korisnicko_ime").val() + "&lozinka=" + $("#lozinka").val(),
        success: function(msg){
            if(msg=="true"){
              window.location="nadzorna_ploca.php";
            }
            else{
              $("#poruka").html("Neispravno uneseno korisničko ime i lozinka.<br /> Molimo unesite ponovno.");
            }

          
        }
      });
        return false;
      });
      </script>
  </body>
</html>