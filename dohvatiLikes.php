<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select COUNT(liked) as numberLikes from likezadaca where uploadzadaca=:uploadzadaca");
$izraz->bindParam(":uploadzadaca", $_POST["uploadzadaca"]);
$izraz->execute();
$likeovi=$izraz->fetch(PDO::FETCH_OBJ);
$izraz=$veza->prepare("select * from likezadaca where uploadzadaca=:uploadzadaca");
$izraz->bindParam(":uploadzadaca", $_POST["uploadzadaca"]);
$izraz->execute();
$likes=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($likes as $like) {
if ($like->korisnik == $_POST['korisnik']) {
$likeovi->liked = true;
}
else if ($like->korisnik == $_POST['korisnik']) {
$likeovi->liked = true;
}
}
echo json_encode($likeovi);
