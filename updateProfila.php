<form method="POST" action="" enctype="multipart/form-data">
  <div class="form-group input-group promjeniSliku">
  <input type="hidden" name="sifra" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
  <input class="odaberi-avatar" style="margin-top:1em;margin-left: 16%;border: none;" type="file" name="slika" id="slika" accept="image/*"/>
    <button type="submit" value="Promjeni" name="promjenaAvatara" class="btn btn-default promjena">Promjeni</button>
  </div>
  </form>
</p>
<p>
	<form method="POST" action="">
    <div class="form-group input-group">
		<input type="hidden" name="sifra" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
     	<div class="input-group privatni-profil">
  		<span class="input-group-addon profil">IME</span>
  		<input type="text" name="ime" class="form-control" value="<?php echo $korisnik->ime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group privatni-profil">
  		<span class="input-group-addon profil">PREZIME</span>
  		<input type="text" name="prezime" class="form-control" value="<?php echo $korisnik->prezime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group privatni-profil">
  		<span class="input-group-addon profil">LOZINKA</span>
  		<input type="password" name="lozinka" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group privatni-profil">
  		<span class="input-group-addon profil">PONOVI LOZINKU</span>
  		<input type="password" name="lozinka2" class="form-control" aria-describedby="basic-addon1" />
		</div>
    <div class="row profilBtn">
      <button type="submit" value="Promjeni" name="promjeni" class="btn btn-default odustani">Odustani</button>
		<button type="submit" value="Promjeni" name="promjeni" class="btn btn-default">Promjeni</button>
  </div>
  </div>
	</form>