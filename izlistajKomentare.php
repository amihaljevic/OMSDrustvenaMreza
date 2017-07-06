<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select a.ime, a.prezime, a.avatar, b.* from komentarstatus b inner join korisnik a on a.sifra=b.korisnik where b.status=:status group by vrijeme ASC");
$izraz->bindValue(":status", $_POST['status']); 
$izraz->execute();
$komentari=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($komentari);