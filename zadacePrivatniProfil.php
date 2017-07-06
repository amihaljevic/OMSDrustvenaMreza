<?php
$vrijeme = date("Y-m-d");
$izraz=$veza->prepare("select * from zadaca");
$izraz->execute();
$zadace=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($zadace as $zadaca):
	if ($zadaca->pocetak < $vrijeme):
?>

	<div class="input-group privatni-profil">
  		<span class="input-group-addon profil"><?php echo $zadaca->naziv;?></span>
  		<div type="text" name="ime" class="panel-body" value="<?php 
$izraz=$veza->prepare("select * from uploadzadaca where korisnik=:korisnik and zadaca=:zadaca");
$izraz->bindValue(":korisnik",$_GET['sifra']); 
$izraz->bindValue(":zadaca",$zadaca->sifra); 
$izraz->execute();
$korisnikoveZadace=$izraz->fetch(PDO::FETCH_OBJ);
if ($korisnikoveZadace==null) {
	echo "Nemam predanu ovu zadaću";
}
else {
	echo "<a href='" . $korisnikoveZadace->putanja . "'>" . $korisnikoveZadace->putanja . "</a>";
}
?>" aria-describedby="basic-addon1" style="border:1px solid #ccc"><?php 
$izraz=$veza->prepare("select * from uploadzadaca where korisnik=:korisnik and zadaca=:zadaca");
$izraz->bindValue(":korisnik",$_GET['sifra']); 
$izraz->bindValue(":zadaca",$zadaca->sifra); 
$izraz->execute();
$korisnikoveZadace=$izraz->fetch(PDO::FETCH_OBJ);
if ($korisnikoveZadace==null) {
	echo "Nemam predanu ovu zadaću";
}
else {
	echo "<a href='" . $korisnikoveZadace->putanja . "'>" . $korisnikoveZadace->putanja . "</a>";
}
?></div>
<!--		
<?php 
$izraz=$veza->prepare("select * from uploadzadaca where korisnik=:korisnik and zadaca=:zadaca");
$izraz->bindValue(":korisnik",$_GET['sifra']); 
$izraz->bindValue(":zadaca",$zadaca->sifra); 
$izraz->execute();
$korisnikoveZadace=$izraz->fetch(PDO::FETCH_OBJ);
if ($korisnikoveZadace==null) {
	echo "Nemam predanu ovu zadaću";
}
else {
	echo "<a href='" . $korisnikoveZadace->putanja . "'>" . $korisnikoveZadace->putanja . "</a>";
}
?>-->
</div>

<?php
endif;
endforeach; ?>