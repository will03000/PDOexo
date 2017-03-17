<?php 
$erreur = [];
$pdo = new PDO('mysql:dbname=colyseum;host=localhost;charset=utf8','root', '');
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$statement=$pdo->query('SELECT id , type FROM cardTypes');
$typedecarte = $statement->fetchAll();

if (isset($_POST) && !empty($_POST)) {
	
	$donnee = [];
	$donnee2 = [];

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
		 	$donne2['cardNumber'] = $_POST['cardNumber'];
		}else{
			$erreur[] = 'merci de mettre votre numéro de carte';
		}
		if (isset($_POST['typedecarte']) && !empty($_POST['typedecarte'])) {
			$donne2['cardTypeId'] = $_POST['typedecarte'];
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

		$statement2 = $pdo->prepare('INSERT INTO cardTypes 
									SET cardTypeId = :cardTypeId,
										cardNumber = :cardNumber,
										');
		$statement2->execute($donnee2);

		$erreur[] = 'le client est bien ajouté';
	}

	
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>formulaire</title>
	<link rel="stylesheet" type="text/css" href="style/css/style.css">
</head>
<body>

<ul>
	<?php
	foreach ($erreur as $value) {
		echo "<li>$value</li>";
	}
	?>
</ul>

<form method="post" action="exo2.php">

	<input type="text" name="lastName" placeholder="nom">
	<input type="text" name="firstName" placeholder="prenom">
	<input type="date" name="birthDate">
	<label for="card">carte de fidélité </label>
	<input type="checkbox" name="card" id="card">
	<input type="number" name="cardNumber" placeholder="numero de la carte">
	<select name="typedecarte" > 
		<option value="">merci de choisir un type de carte</option>
		<?php foreach ($typedecarte as $key => $value) {
			echo '<option value="'.$value->id.'">'.$value->type.'</option>';
		}
	?>
	</select>
	<button type="submit">ok</button>

	
</form>











</body>
</html>