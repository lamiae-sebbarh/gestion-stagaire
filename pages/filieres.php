<?php
	require_once('session.php');
?>

<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['NIVEAU']))
		$niveau=$_GET['NIVEAU'];
	else
		$niveau="all";
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=5;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if($niveau=="all"){// TOUS LES NIVEAUX
		$resultat1 = $con->query("SELECT * FROM FILIERE
									WHERE  NOM_FILIERE like '%$mc%' 
									ORDER BY ID
									LIMIT $size
									OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrFiliere 
									from FILIERE 
									where NOM_FILIERE like '%$mc%'");
	}else{
		$resultat1 = $con->query("SELECT * FROM FILIERE
									WHERE  NOM_FILIERE like '%$mc%'
									AND NIVEAU='$niveau'
									ORDER BY ID
									LIMIT $size
									OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrFiliere 
									from FILIERE 
									where NOM_FILIERE like '%$mc%'
									AND NIVEAU='$niveau'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrF=$nbr['nbrFiliere'];
	
	$reste=$nbrF % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrF sur $size
	if($reste==0)
		$nbrPage=$nbrF/$size;
	else
		$nbrPage=floor($nbrF/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des Filières</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('entete.php');?>
			
		<div class="container">
			<div class="panel panel-success espace60">
				<div class="panel-heading">Rechercher des filières</div>
				<div class="panel-body">
					<form method="get" action="filieres.php" class="form-inline">
						<div class="form-group">													
							
							<input type="text" name="motCle" 
									placeholder="Taper un mot clé"
									id="motCle" class="form-control" 
									value="<?php echo $mc; ?>"/>
							
							<label for="NIVEAU" class="control-label">Niveau</label>
							<select name="NIVEAU" id="NIVEAU" class="form-control"
									onChange="this.form.submit();">
								<option value="all" <?php echo $niveau=="all"?"selected":"" ?>>Tous les niveaux</option>
								<option value="d" <?php echo $niveau=="t"?"selected":"" ?>>Doctorat</option>
								<option value="ts" <?php echo $niveau=="ms"?"selected":"" ?>>Master Spécialisé</option>
								<option value="l" <?php echo $niveau=="l"?"selected":"" ?>>Licence</option>
								<option value="m" <?php echo $niveau=="m"?"selected":"" ?>>Master</option>
							</select>

							<button type="submit" class="btn btn-success">
								<i class="glyphicon glyphicon-search"></i>
								Chercher...
							</button>
							
							&nbsp&nbsp&nbsp
							<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
								<a href="nouvelleFiliere.php">Nouvelle filière</a>
							<?php } ?>	
						</div>
							
					</form>
				</div>
			</div>
			<div class="panel panel-primary ">
				<div class="panel-heading">Liste des filières (<?php echo $nbrF ?>&nbsp Filière) </div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>NOM DE LA FILIERE</th>
								<th>NIVEAU</th>								
								 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
									<th>ACTIONS</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php while($FILIERE=$resultat1->fetch()){?>
								<tr>
									<td><?php echo $FILIERE['ID'] ?></td>
									<td><?php echo $FILIERE['NOM_FILIERE'] ?></td>
									<td><?php echo $FILIERE['NIVEAU'] ?></td>
									
									<td>
										<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
											<!--  Action Editer une FILIERE -->
											<a href="editerFiliere.php?ID=<?php echo $FILIERE['ID'] ?>">
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
											
											&nbsp &nbsp
											<!--  Action Supprimer une FILIERE -->
											<a Onclick="return confirm('Etes vous sur de vouloir supprimer la filière?')" 
												href="supprimerFiliere.php?ID=<?php echo $FILIERE['ID'] ?>">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
																						
										<?php } ?>
										
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<div>
						<ul class="nav nav-pills">
							
							<?php for($i=1;$i<=$nbrPage;$i++){ ?>
								<li class="<?php if($i==$page) echo 'active' ?>">
									<a href="filieres.php?page=<?php echo $i ?>
										&motCle=<?php echo $mc ?>
										&NIVEAU=<?php echo $niveau ?>">
										Page <?php echo $i ?>
									</a>
								</li>
							<?php } ?>	
						</ul>
					</div>
					
				</div>				
			</div>	
			
		</div>
	</body>
</html>