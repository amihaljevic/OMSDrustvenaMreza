<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("insert into likezadaca (liked, uploadzadaca, korisnik) values (1, :uploadzadaca, :korisnik)");
$izraz->bindValue(":uploadzadaca", $_POST['uploadzadaca']); 
$izraz->bindValue(":korisnik", $_POST['korisnik']);
$izraz->execute();
$izraz=$veza->prepare("select COUNT(liked) as numberLikes from likezadaca where uploadzadaca=:uploadzadaca");
$izraz->bindValue(":uploadzadaca", $_POST['uploadzadaca']); 
$izraz->execute();
$likeovi=$izraz->fetch(PDO::FETCH_OBJ);
echo json_encode($likeovi);