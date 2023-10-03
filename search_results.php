<?php
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
	// special character 
	$mysqli->set_charset('utf8');


	// 2. Perfrom SQL queries
	$sql = "SELECT dvd_title_id, title, release_date, award, genres.genre AS genre, ratings.rating AS rating
	        FROM dvd_titles
			LEFT JOIN genres
				ON dvd_titles.genre_id = genres.genre_id
			LEFT JOIN ratings
				ON dvd_titles.rating_id = ratings.rating_id
			LEFT JOIN labels
				ON dvd_titles.label_id = labels.label_id
			LEFT JOIN formats
				ON dvd_titles.format_id = formats.format_id
			LEFT JOIN sounds
				ON dvd_titles.sound_id = sounds.sound_id
			WHERE 1=1";

	if (isset($_GET['title']) && !empty($_GET['title'])) {
		$title = $_GET['title'];
		$sql = $sql . " AND dvd_titles.title LIKE '%$title%'";
	}
	if (isset($_GET['release_date_from']) && !empty($_GET['release_date_from'])) {
		$release_date_from = $_GET['release_date_from'];
		$sql = $sql . " AND dvd_titles.release_date >= '$release_date_from'";
	}
	if (isset($_GET['release_date_to']) && !empty($_GET['release_date_to'])) {
		$release_date_to = $_GET['release_date_to'];
		$sql = $sql . " AND dvd_titles.release_date <= '$release_date_to'";
	}
	if (isset($_GET['genre_id']) && !empty($_GET['genre_id'])) {
		$genre_id = $_GET['genre_id'];
		$sql = $sql . " AND genres.genre_id = $genre_id";
	}
	if (isset($_GET['rating_id']) && !empty($_GET['rating_id'])) {
		$rating_id = $_GET['rating_id'];
		$sql = $sql . " AND ratings.rating_id = $rating_id";
	}
	if (isset($_GET['label_id']) && !empty($_GET['label_id'])) {
		$label_id = $_GET['label_id'];
		$sql = $sql . " AND dvd_titles.label_id = $label_id";
	}
	if (isset($_GET['format_id']) && !empty($_GET['format_id'])) {
		$format_id = $_GET['format_id'];
		$sql = $sql . " AND dvd_titles.format_id = $format_id";
	}
	if (isset($_GET['sound_id']) && !empty($_GET['sound_id'])) {
		$sound_id = $_GET['sound_id'];
		$sql = $sql . " AND dvd_titles.sound_id = $sound_id";
	}
	if (isset($_GET['award']) && !empty($_GET['award'])) {
		if ($_GET['award'] == "yes") {
			$sql = $sql . " AND dvd_titles.award IS NOT NULL";
		}
		else if ($_GET['award'] == 'no') {
			$sql = $sql . " AND dvd_titles.award IS NULL";
		}
	}

	$sql = $sql . ";";

	// echo "<pre>";
	// echo $sql;
	// echo "</pre>";


	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}


	// 3. Close MySQL Connection
	$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $row = $results->fetch_assoc() ) : ?>
							<tr>
								<td>
									<a href="<?php echo 'details.php?dvd_title_id='. $row['dvd_title_id']; ?>">
										<?php echo $row['title']; ?>
									</a>			
								</td>
								<td>
									<?php echo $row['release_date']; ?>
								</td>
								<td>
									<?php echo $row['genre']; ?>
								</td>
								<td>
									<?php echo $row['rating']; ?>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>