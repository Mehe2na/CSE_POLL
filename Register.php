<?php
		session_start();
        try
        {
         $bdd = new PDO('mysql:host=localhost;dbname=poll', 'root', '');
        }
        catch(Exception $e)
        {
         die('Erreur : '.$e->getMessage());
        }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<?php include('./includes/header.php'); ?>
	<div class="ConnexionForm"> 
		<form method="post" action="Module_creation.php">
			<div>
			<label>Nom Complet</label>
			<input type="text" name="nom">
			</div>
			<div>
			<label>Nom d'utilisateur</label>
			<input type="text" name="login">
			</div>
			<div>
			<label>Mot de passe</label>
			<input type="password" name="passwd">
			</div>
			<div>
			<label>Confirmation du mot de passe</label>
			<input type="password" name="passwd1">
			</div>
			<div>
			<button class="btn" type="submit">Créer</button>
			</div>
		</form>
	</div>
</body>
</html>