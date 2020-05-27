
<?php
	require_once('session.php');
	$id=$_GET['ID'];
	require_once('connexion.php');
	
	$requete="select * from FILIERE where id=$id";
	$resultat = $con->query($requete);
	$FILIERE=$resultat->fetch();
	
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Editer une filière</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Editer une filière</div>
				<div class="panel-body">
					<form method="post" action="updateFiliere.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="id" class="control-label" >
								Id=<?php echo $FILIERE['ID']; ?>
							</label>
							<input type="hidden" name="ID" 
									id="id" class="form-control" 
									value="<?php echo $FILIERE['ID']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="NOM_FILIERE" class="control-label">NOM FILIERE</label>
							<input type="text" name="NOM_FILIERE" id="NOM_FILIERE" class="form-control"
									value="<?php echo $FILIERE['NOM_FILIERE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="NIVEAU" class="control-label">NIVEAU</label>
							<input type="text" name="NIVEAU" id="NIVEAU" class="form-control"
									value="<?php echo $FILIERE['NIVEAU']; ?>"/>
						</div>
						
						<button type="submit" class="btn btn-primary">Enregistrer</button>
							
					</form>
				</div>
			</div>
			
			
				
		</div>
	</body>
</html>



