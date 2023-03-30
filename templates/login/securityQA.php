<?php
session_start();
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Login\LoginRepository;
?>
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
<?php
?>
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
						<h3 class="mb-4 text-center" style="font-weight:400 ;">Forgotten password ?</h3>
						<!-- formulaire pour la vérification -->
						<?php if (isset($_SESSION['USERNAME']) && isset($_SESSION['NEW_PASSWORD'])) {
							$username = $_SESSION['USERNAME'];
							$newPassword = $_SESSION['NEW_PASSWORD'];
							$loginRepository = new LoginRepository();
							$loginRepository->connection = new DatabaseConnection();
							$loginInfos = $loginRepository->getLoginInfos($username);
						} ?>
						<form action="index.php?action=verifyQA" method='post' class="signin-form">
							<div class="form-group">
								<input type="text" readonly class="form-control" autocomplete="off" id="Username" name="Username" value="<?= $loginInfos->username ?>">
							</div>
							<div class="form-group">
								<input type="text" readonly class="form-control" autocomplete="off" id="security_answer" name="security_question" value="<?= $loginInfos->security_question ?>">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" autocomplete="off" id="security_answer" name="security_answer" placeholder="Type your answer" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Verify your identity</button>
							</div>
						</form>
						<!-- fin du formulaire pour la verification -->
						<h3 class="mb-4 text-center">have an account ?</h3>
						<!-- formulaire pour la connexion -->
						<form action="index.php?action=signInPage" method='post' class="signin-form">
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
							</div>
						</form>
						<!-- fin du formulaire pour la connexion-->
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require('templates/pagesComponents/popup/loginPopup.php') ?>
</body>
</html>