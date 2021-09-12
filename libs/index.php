<?php
require("header.php");
require("/OpenServer/domains/TZ/db/db.php");
require("functions.php");
$title = "Главная страница";

//$course_carr = get_course();
//var_dump($course_carr);
?>
<div class="container mt-4">
	<div class="row">
		<div class="col">
			<center>
				<h1>Добро пожаловать на наш сайт!</h1>
			</center>
			<a href="form.php">Посмотреть курс USD к гривне</a>
		</div>
	</div>
</div>

<?php
require("footer.php");
?>