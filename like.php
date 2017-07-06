<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("insert into likestatus (liked, korisnik, status) values (1, :korisnik, :status)");
$izraz->bindValue(":status", $_POST['status']); 
$izraz->bindValue(":korisnik", $_POST['korisnik']);
$izraz->execute();
$izraz=$veza->prepare("select COUNT(liked) as numberLikes from likestatus where status=:status");
$izraz->bindValue(":status", $_POST['status']); 
$izraz->execute();
$likeovi=$izraz->fetch(PDO::FETCH_OBJ);
echo json_encode($likeovi);