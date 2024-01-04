<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "go_shdc";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
