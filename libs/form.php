<?php
require("header.php");
require("/OpenServer/domains/TZ/db/db.php");
require("functions.php");
$title = "Запрос";
if (isset($_POST['do_rates'])) {
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$errors = array();
	if (empty($day)) {
		$errors['day'] = "Укажите день!";
	}
	if (empty($month)) {
		$errors['month'] = "Укажите месяц!";
	}
	if (empty($year)) {
		$errors['year'] = "Укажите год!";
	}
	if (empty($errors)) {
		$query = $mysqli->query("SELECT * FROM `options` WHERE `day` = '$day' AND `month` = '$month' AND `year` = '$year'");
		$fetchedArray = $query->fetch_assoc();
		if (empty($fetchedArray)) {
			$date = "$day.$month.$year";
			$course_carr = GetArchiveExchangeRates($date);
		} else {
			$fetchedArray['course_usd'];
		}
	}
}




?>

<div class="container mt-4">
	<div class="row">
		<div class="col">
			<h2>Курс валют, гривна к USD</h2>
			<form action="form.php" method="post">
				<input type="number" id="day" name="day" value="" placeholder="Ведите день">
				<div style="color: red;"><?php echo $errors['day']; ?></div><br>
				<input type="number" id="month" name="month" value="" placeholder="Ведите месяц">
				<div style="color: red;"><?php echo $errors['month']; ?></div><br>
				<input type="number" id="year" name="year" value="" placeholder="Ведите год">
				<div style="color: red;"><?php echo $errors['year']; ?></div><br>
				<button type="submit" class="btn btn-success" name="do_rates">Запросить</button>
			</form>
			<div> <?php
					if (!empty($fetchedArray)) {
						echo $fetchedArray['course_usd'];
						return;
					}
					if (!empty($course_carr)) {
						echo "Buy: " . ($course_carr['buy'] . "<br>");
						echo "Sale: " . ($course_carr['sale']);
						return;
					}
					echo "Курс валют на эту дату не доступен"; ?></div>
		</div>
	</div>
</div>

<?php
require("footer.php");
?>