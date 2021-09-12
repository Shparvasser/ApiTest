<?php
function print_arr($arr)
{
	echo "<pre> " . print_r($arr, true) . "</pre>";
}

function get_course()
{
	$data = file_get_contents(ACTUALEXCHANGERATES);
	if (!$data) return [];
	$courses = json_decode($data, true);
	$course_curr = [];
	foreach ($courses as $course) {
		if ($course['ccy'] == 'USD') {
			$course_curr = array(
				"buy" => $course['buy'],
				"sale" => $course['sale']
			);
			break;
		}
	}
	return $course_curr;
}

function GetArchiveExchangeRates($date)
{
	$archiveExchangeRatesLink = ARCHIVEEXCHANGERATES . $date;
	$data = file_get_contents($archiveExchangeRatesLink);
	if (!$data) return [];
	$courses = json_decode($data, true);
	$course_curr = [];
	$exchangeRates = $courses['exchangeRate'];
	if (empty($exchangeRates))
		return [];
	foreach ($exchangeRates as $exchangeRate) {
		if ($exchangeRate['currency'] == 'USD') {
			$course_curr = array(
				"buy" => $exchangeRate['purchaseRate'],
				"sale" => $exchangeRate['saleRate']
			);
			break;
		}
	}
	return $course_curr;
}

function GetExchangeRates($date)
{
	if (IsCurrentDate($date)) {
		return get_course();
	}
	return GetArchiveExchangeRates($date);
}

function IsCurrentDate($date)
{
	return $date == date("d.m.Y");
}
