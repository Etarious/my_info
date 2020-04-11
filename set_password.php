<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Etarious</title>
	<link rel="stylesheet" type="text/css" href="third_parties/fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="third_parties/bootstrap/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Sen:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&family=Sen:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body style="background-color: rgb(240, 240, 240);">
	<div class="container-fluid" style="margin-top: 10px;">
		<div class="row base">
			<div class="col-md-3" style="background-color: rgb(100, 100, 100);">
				
			</div>
			<div class="col-md-6" style="background-color: rgb(240, 240, 240);">
				<h6>Set Password | <small><a href="messages.php" class="link">Messages</a> | <a href="change_password.php" class="link">Change Password</a></small></h6>
				<hr>

				<?php
					if (isset($_POST["set_password"])) {
						require("process/set_password_process.php");
					}

					
				?>

				<div id="form">
					<form class="form" method="POST">
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label for="confirm">Confirm-password:</label>
							<input type="password" name="confirm" class="form-control">
						</div>
						<button class="btn btn-md btn-success" name="set_password">Set Password</button>
					</form>
				</div>
			</div>
			<div class="col-md-3" style="background-color: rgb(100, 100, 100);">
				
			</div>
		</div>
	</div>

<script type="text/javascript" src="third_parties/jquery.js"></script>
<script type="text/javascript" src="third_parties/fontawesome/js/all.min.js"></script>
<script type="text/javascript" src="third_parties/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>