<?php session_start() ?>
<!doctype html>
<html lang="en">
<head>
	<title>LOGIN</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="templates\pagesComponents\navbar\assets\img\insigneAir.png" type="image/icon type">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="templates\login\css\style.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="img js-fullheight" style="background-image: url(templates/login/images/wpp.avif);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">MOYENS TECHNIQUES</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center" style="font-weight:400;">Who are you?</h3>
						<!-- formulaire pour l'inscription-->
						<form action="index.php?action=profileCompletion" method='post' class="signin-form">
							<div class="form-group">
								<select id="password-field" id="grade" name="grade" class="form-control" required>
									<option class="option" value="">Select your grade</option>
									<option class="option" value="Colonel- Major">Colonel- Major</option>
									<option class="option" value="Colonel">Colonel</option>
									<option class="option" value="Lieutenant-Colonel">Lieutenant-Colonel</option>
									<option class="option" value="Commandant">Commandant</option>
									<option class="option" value="Capitaine">Capitaine</option>
									<option class="option" value="Lieutenant">Lieutenant</option>
									<option class="option" value="Sous-Lieutenant">Sous-Lieutenant</option>
								</select>
							</div>
							<div class="form-group">
								<input id="password-field" type="text" id="surname" name="surname" class="form-control" placeholder="Surname" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" autocomplete="off" id="firstName" name="firstName" placeholder="First Name" required>
							</div>
							<div class="form-group">
								<input id="password-field" type="text" id="function" name="function" class="form-control" placeholder="Function" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Complete your profile</button>
							</div>
						</form>
						<!-- fin du formulaire pour l'inscription-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require('templates/pagesComponents/popup/loginPopup.php') ?>
</body>
</html>