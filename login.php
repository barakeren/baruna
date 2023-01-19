<?php
// Panggil Class utama Aplikasi
require 'App.php'; 

// Inisiani class
$app = new App(); 

// set login Authentification
if(isset($_POST['cek_login'])) :
	$object = array(
		'user' => $_POST['username'],
		'pass' => $_POST['password']
	);

	$cek_login = $app->authentification( $object['user'], $object['pass'] );
	if( $cek_login == FALSE ) :
		$message = "Maaf Password dan Username tidak cocok!";
	endif;
endif;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
		</title>
		<link rel="stylesheet" href="assets/style.css" type="text/css" />
		<meta name="" content="">
	</head>
	<body>

		<div id="login-form">
			<?php echo (isset($message)) ? $message : ''; ?>
			<form method="post" action="">
				<h3>
					Username
				</h3>
				
				<input type="text" name="username" required class="input-form" />
				
				<h3>
					Password
				</h3>
				
				<input type="password" name="password" required class="input-form" />
				<br>
				<br>
				<input type="submit" name="cek_login" value="LOGIN" class="input-submit" />

			</form>
		</div>
	</body>
</html>