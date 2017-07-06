<?php
$title = "OMS Društvena mreža";
$server="localhost";
$baza="omsdm";
$korisnik="root";
$lozinka="";
$putanja="/p1/";
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8;");
