<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select a.ime, a.prezime, a.avatar, b.* from korisnik a inner join uploadzadaca b on a.sifra=b.korisnik where b.zadaca=:zadaca");
$izraz->bindParam(":zadaca", $_POST["zadaca"]);
$izraz->execute();
$skup=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($skup);
