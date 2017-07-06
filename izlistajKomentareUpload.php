<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select a.ime, a.prezime, a.avatar, b.* from komentarzadaca b inner join korisnik a on a.sifra=b.korisnik where b.uploadzadaca=:uploadzadaca group by vrijeme ASC");
$izraz->bindValue(":uploadzadaca", $_POST['uploadzadaca']); 
$izraz->execute();
$komentari=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($komentari);