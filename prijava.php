<?php
if(!isset($_POST['korisnicko_ime'])){
	echo "false";
	exit;
}
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select * from korisnik where korisnicko_ime=:korisnicko_ime and lozinka=:lozinka");
$izraz->bindValue(":korisnicko_ime", $_POST['korisnicko_ime']); 
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->execute();
$operater=$izraz->fetch(PDO::FETCH_OBJ);
if($operater!=null){
	session_start();
	$_SESSION['autoriziran']=$operater;
	echo "true";
}
else{
	echo "false";
}