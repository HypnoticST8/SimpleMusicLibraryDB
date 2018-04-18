<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$url = $_SERVER['REQUEST_URI'];
$arr = explode('/', $url);

// Local DB connection
define("DB_SERVER", "localhost");
define("DB_USER", "phpmyadmin");
define("DB_PASSWORD", "myphp_01");
define("DB_NAME", "vinyl_db");
$link = mysql_connect (DB_SERVER, DB_USER, DB_PASSWORD) or die (mysql_error());
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>VinylDB - baza danych muzyki</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php
switch ($arr[2]) {
  case "home": include("src/home.php"); break;
  case "categories": include("src/categories.php"); break;
  case "": include("src/home.php"); break;
  default: include("src/error.php");
}
?>
</body>
</html>