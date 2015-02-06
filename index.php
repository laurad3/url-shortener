<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>URL Shortener</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>URL Shortener</h1>
		<p class="message"><?php echo $_GET["message"]; ?></p>

		<form action="shorten.php" method="post" enctype="application/x-www-form-urlencoded">
			<div class="form-group">
				<input type="url" name="url" placeholder="http://www.example.com" class="form-control" autocomplete="off">
			</div>
			<input type="submit" name="submit" value="Shorten">
		</form>
	</div>
</body>
</html>