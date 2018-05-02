<?php
	require "includes/db.php";

	// Step 2: Preform Database Query
	$table = "projects";
	$query = "SELECT * FROM {$table}";
	$result = mysqli_query($connection, $query);

	// Check there are no errors with our SQL statement
	if (!$result) {
			die ("Database query failed.");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PHP DB Example</title>
	<link rel="stylesheet" href="screen.css">
</head>
<body>

	<div class="grid">
		<?php
			while ($row = mysqli_fetch_assoc($result)) {
		?>

			<div class="project">
				<figure>
					<img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
					<figcaption>
						<?php echo $row['name']; ?>
					</figcaption>
				</figure>
				<p><?php echo $row['description']; ?></p>
				<p><a href="single.php?id=<?php echo $row['id']; ?>">Read More&hellip;</a></p>
			</div>

		<?php
			}

			// Step 4: Release Returned Data
			mysqli_free_result($result);

			// Step 5: Close Database Connection
			mysqli_close($connection);
		?>
	</div>

</body>
</html>