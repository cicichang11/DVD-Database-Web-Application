<?php 
	if ( !isset($_POST['title']) || trim($_POST['title']) == '') {
		$error = "Please fill out all required fields.";
	} else {
		// Everything valid - perfom db operations
		$host = "303.itpwebdev.com";
		$user = "cicichan_db_user";
		$pass = "Heyitscicinn0411/";
		$db = "cicichan_dvd_db";

		// 1. Establish MySQL Connection
		$mysqli = new mysqli($host, $user, $pass, $db);

		// Check for MySQL Connection Errors
		if ($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$title = $_POST['title'];

		// label
		if (isset($_POST['label_id']) && trim($_POST['label_id']) != '') {
			$label_id = $_POST['label_id'];
		} else {
			$label_id = "null";
		}
		// sound
		if (isset($_POST['sound_id']) && trim($_POST['sound_id']) != '') {
			$sound_id = $_POST['sound_id'];
		} else {
			$sound_id = "null";
		}
		// genre
		if (isset($_POST['genre_id']) && trim($_POST['genre_id']) != '') {
			$genre_id = $_POST['genre_id'];
		} else {
			$genre_id = "null";
		}
		// rating
		if (isset($_POST['rating_id']) && trim($_POST['rating_id']) != '') {
			$rating_id = $_POST['rating_id'];
		} else {
			$rating_id = "null";
		}
		// format
		if (isset($_POST['format_id']) && trim($_POST['format_id']) != '') {
			$format_id = $_POST['format_id'];
		} else {
			$format_id = "null";
		}
		// award
		if (isset($_POST['award']) && trim($_POST['award']) != '') {
			$award = $_POST['award'];
		} else {
			$award = "null";
		}

		//release date
		if (isset($_POST['release_date']) && trim($_POST['release_date']) != '') {
			$release_date = $_POST['release_date'];
			$sql = "INSERT INTO dvd_titles (title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id)
				VALUES ('$title', '$release_date', '$award', $label_id, $sound_id, $genre_id, $rating_id, $format_id);";
		} else {
			$release_date = "null";
			$sql = "INSERT INTO dvd_titles (title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id)
				VALUES ('$title', $release_date, '$award', $label_id, $sound_id, $genre_id, $rating_id, $format_id);";
		}


		$result = $mysqli->query($sql);

		if (!$result) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		// echo "<pre>";
		// echo $sql;
		// echo "</pre>";


		// Close db connection
		$mysqli->close();
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error)) : ?>

					<div class="text-danger">
						<?php echo $error; ?>
					</div>

				<?php else : ?>

					<div class="text-success">
						<span class="font-italic"><?php echo $title; ?></span> was successfully added.
					</div>

				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Go to Search Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>