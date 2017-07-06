<?php
include_once 'konfiguracija.php';
$veza->exec("set names utf8;");
$izraz=$veza->prepare("insert into komentarstatus (naziv, korisnik, status, vrijeme) values (:naziv, :korisnik, :status, now())");
$izraz->bindValue(":status", $_POST['status']);
$izraz->bindValue(":korisnik", $_POST['korisnik']); 
$izraz->bindValue(":naziv", $_POST['naziv']); 
$izraz->execute();

$izraz=$veza->prepare("select a.ime, a.prezime, a.avatar, b.* from komentarstatus b inner join korisnik a on a.sifra=b.korisnik where b.status=:status group by vrijeme ASC");
$izraz->bindValue(":status", $_POST['status']); 
$izraz->execute();
$komentari=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($komentari);