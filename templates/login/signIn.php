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
						<h3 class="mb-4 text-center">Have an account?</h3>
						<!-- formulaire pour la connexion -->
						<form action="index.php?action=signIn" method='post' id="form1" class="signin-form">
							<div class="form-group">
								<input type="text" class="form-control" autocomplete="off" id="Username" name="Username" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input id="password-field" type="password" id="Password" name="Password" class="form-control" placeholder="Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50">
									<label class="checkbox-wrap checkbox-primary">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="index.php?action=forgottenPasswordPage" id='resetlink' style="color: #fff">Forgot Password</a>
								</div>
							</div>
						</form>
						<?php
						?>
						<!-- fin du formulaire pour la connexion-->
						<h3 class="mb-4 text-center">New account ?</h3>
						<!-- formulaire pour l'inscription-->
						<form action="index.php?action=signUpPage" method='post' class="signin-form">
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Sign Up</button>
							</div>
						</form>
						<!-- fin formulaire pour l'inscription-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require('templates/pagesComponents/popup/loginPopup.php') ?>
</body>
</html>