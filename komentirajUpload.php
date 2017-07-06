<?php
include_once 'konfiguracija.php';
$veza->exec("set names utf8;");
$izraz=$veza->prepare("insert into komentarzadaca (naziv, uploadzadaca, korisnik, vrijeme) values (:naziv, :uploadzadaca, :korisnik, now())");
$izraz->bindValue(":uploadzadaca", $_POST['uploadzadaca']);
$izraz->bindValue(":korisnik", $_POST['korisnik']); 
$izraz->bindValue(":naziv", $_POST['naziv']); 
$izraz->execute();

$izraz=$veza->prepare("select a.ime, a.prezime, a.avatar, b.* from komentarzadaca b inner join korisnik a on a.sifra=b.korisnik where b.uploadzadaca=:uploadzadaca group by vrijeme ASC");
$izraz->bindValue(":uploadzadaca", $_POST['uploadzadaca']); 
$izraz->execute();
$komentari=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($komentari);