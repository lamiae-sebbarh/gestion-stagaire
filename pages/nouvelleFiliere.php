<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle filière</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle filière</div>
				<div class="panel-body">
					<form method="post" action="insertFiliere.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="NOM_FILIERE" class="control-label">NOM</label>
							<input type="text" name="NOM_FILIERE" id="NOM_FILIERE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="NIVEAU" class="control-label">NIVEAU</label>
							<input type="text" name="NIVEAU" id="NIVEAU" class="form-control"/>
						</div>																
								
						<button type="submit" class="btn btn-primary">Enregistrer</button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



