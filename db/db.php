<?php
session_start();
$server = "localhost";
$username = "root";
$passwordUserDb = "";
$database = "rates";
define("ACTUALEXCHANGERATES", 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
define("ARCHIVEEXCHANGERATES", 'https://api.privatbank.ua/p24api/exchange_rates?json&date=');




$mysqli = new MySQLi($server, $username, $passwordUserDb, $database);

if ($mysqli->connect_errno) {
	die("<p><strong>Ошибка подключения к БД</strong></p><p><strong>Код ошибки: </strong> " . $mysqli->connect_errno . " </p><p><strong>Описание ошибки:</strong> " . $mysqli->connect_error . "</p>");
}

//$mysqli->set_charset('utf8');
