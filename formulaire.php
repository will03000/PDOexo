<?php 
$erreur = [];
if (isset($_POST) && !empty($_POST)) {
	

	if (isset($_POST['lastName']) && $_POST['lastName'] !== ''){
		$nom = $_POST['lastName'];
	}else{
		$erreur[] = 'merci de mettre un nom';
	}
	if (isset($_POST['firstName']) && $_POST['firstName'] !== '') {
		$prenom = $_POST['firstName'];
	}else{
		$erreur[] = 'merci de mettre un prenom';
	}
	if (isset($_POST['birthDate'])) {
			$naissance = $_POST['birthDate'];
	}else{
		$erreur[] = 'merci de mettre une date de naissance';
	}
	if (isset($_POST['card'])) {
			$card = 1;
		
		 if(isset($_POST['cardNumber'])) {
		 	$numcarte = $_POST['cardNumber'];
		}else{
			$erreur[] = 'merci de mettre votre numéro de carte';
		}
	}else{
		$card = 0;
		$numcarte = null;
	}
	if (empty($erreur)) {
		$pdo = new PDO('mysql:dbname=colyseum;host=localhost;charset=utf8','root', '');
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$statement = $pdo->prepare('INSERT INTO clients 
									SET lastName = ?,
										firstName = ?,
										birthDate = ?,
										card = ?,
										cardNumber = ?');
		$statement->execute([$nom,$prenom,$naissance,$card,$numcarte]);

		$erreur[] = 'le client est bien ajouté';
	}

	
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>formulaire</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>

<ul>
	<?php
	foreach ($erreur as $value) {
		echo "<li>$value</li>";
	}
	?>
</ul>

<form method="post" action="formulaire.php">

	<input type="text" name="lastName" placeholder="nom">
	<input type="text" name="firstName" placeholder="prenom">
	<input type="date" name="birthDate">
	<label for="card">carte de fidélité </label>
	<input type="checkbox" name="card" id="card">
	<input type="number" name="cardNumber" placeholder="numero de la carte">
	<button type="submit">ok</button>

	
</form>











</body>
</html>