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
				<div>
					<h6>Messages | <small><a href="change_password.php" class="link">Change Password</a></small></h6>
				</div>
				<div id="form">
					<form class="form" method="POST">
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" name="password" class="form-control" id="password">
						</div>
						<div id="response"></div>
						<button class="btn btn-md btn-success" name="submit_password" id="submit_password">Submit Password</button>
					</form>
				</div>

				<div id="r_button">
					<?php
						if (isset($_POST["submit_password"])) {
							require("process/check_password.php");
						}
					?>
				</div>

				<div class="messages" id="per-message">
					<div class="card">
						<div class="card-body">
							<div class="im">
								<span>Input the right password to view your messages.</span>
							</div>
						</div>
					</div>
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