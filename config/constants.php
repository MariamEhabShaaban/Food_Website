<?php
session_start();
define("SITEURL", "http://localhost/Food_Website/");
define("DBNAME", "food");
define("DB_USERNAME", "root");
define("PASSWORD", "");
define("LOCALHOST", "localhost");
$connect = new mysqli(LOCALHOST, DB_USERNAME, PASSWORD, DBNAME) or
    die(mysqli_error($connect));
