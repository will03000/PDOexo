<?php
$pdo = new PDO('mysql:dbname=colyseum;host=localhost;charset=utf8','root', '');
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$donnee = [];

if (isset($_POST['lastName']) && $_POST['lastName'] !== ''){
		$donnee['lastName'] = $_POST['lastName'];
	}else{
		$erreur[] = 'merci de mettre un nom';
	}
	if (isset($_POST['firstName']) && $_POST['firstName'] !== '') {
		$donnee['firstName'] = $_POST['firstName'];
	}else{
		$erreur[] = 'merci de mettre un prenom';
	}
	if (isset($_POST['birthDate'])) {
			$donnee['birthDate'] = $_POST['birthDate'];
	}else{
		$erreur[] = 'merci de mettre une date de naissance';
	}
	if (isset($_POST['card'])) {
			$donnee['card'] = 1;

			 if(isset($_POST['cardNumber'])) {
		 	$donnee['cardNumber'] = $_POST['cardNumber'];
		 	}else{
			$erreur[] = 'merci de mettre votre numéro de carte';
				}
			}else{
		$donnee['card'] = 0;
		$donnee['cardNumber'] = null;
	}
	if (empty($erreur)) {
		
		$statement = $pdo->prepare('INSERT INTO clients 
									SET lastName = :lastName,
										firstName = :firstName,
										birthDate = :birthDate,
										card = :card,
										cardNumber = :cardNumber');
		$statement->execute($donnee);
		$erreur[] = 'le client est bien ajouté';
		}

	


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<form method="POST" action="exo3.php">
	
<input type="text" name="lastName" placeholder="nom">
<input type="text" name="firstName" placeholder="prenom">
<input type="date" name="birthDate">
<label for="carte"> carte de fidélité</label>
<input type="checkbox" name="card" id="carte">
<input type="number" name="cardNumber" placeholder="numéro de carte">
<button type="submit">ok</button>

</form>







</body>
</html>