<?php
include_once("../Model/utilisateurs.php");
include_once("../Model/films.php");

$utilisateur = new utilisateurs($db);
$film = new films($db);
