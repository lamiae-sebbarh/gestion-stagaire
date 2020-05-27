<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['ID_FILIERE']))
		$idf=$_GET['ID_FILIERE'];
	else
		$idf=0;
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if($idf==0){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT S.ID,NOM,PRENOM,PHOTO,NOM_FILIERE
								FROM STAGIAIRE S,FILIERE F
								WHERE S.ID_FILIERE=F.ID
								AND (NOM like '%$mc%' OR PRENOM like '%$mc%')
								ORDER BY S.ID
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrSTAGAIRE 
								from STAGIAIRE 
								where NOM like '%$mc%' OR PRENOM like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT S.ID,NOM,PRENOM,PHOTO,NOM_FILIERE
								FROM STAGIAIRE S,FILIERE F
								WHERE S.ID_FILIERE=F.ID
								AND (NOM like '%$mc%' OR PRENOM like '%$mc%')
								And ID_FILIERE=$idf
								ORDER BY S.ID
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrSTAGAIRE 
								from STAGIAIRE 
								where (NOM like '%$mc%' OR PRENOM like '%$mc%')
								And ID_FILIERE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrSTAGAIRE'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from filiere";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des stagiaires</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des stagiaires</div>
					<div class="panel-body">
						<form method="get" action="stagiaires.php" class="form-inline">
						<div class="form-group">						
								<select name="ID_FILIERE" id="ID_FILIERE" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Toutes les filières</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['ID']?>" 
											<?php echo $idf==$filiere['ID']?"selected":"" ?>>
											<?php echo $filiere['NOM_FILIERE']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Taper un mot clé"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Chercher...
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<a class="btn btn-success" href="nouveaustagaire.php">Nouveau stagiaire</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des stagiaires (<?php echo $nbrPro ?> &nbsp stagiaire) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>NOM</th>
									<th>PRENOM</th>
									<th>FILIERE</th>
									<th>PHOTO</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['ID'] ?></td>
										<td><?php echo $STAGIAIRE['NOM'] ?></td>
										<td><?php echo $STAGIAIRE['PRENOM'] ?></td>
										<td><?php echo $STAGIAIRE['NOM_FILIERE'] ?></td>	
										<td>
											<img src="../images/<?php echo $STAGIAIRE['PHOTO']?>" 
												class="img-thumbnail"  width="50" height="40" >
										</td>	
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="editerstagaire.php?ID=<?php echo $STAGIAIRE['ID'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le STAGIAIRE?')" 
													href="supprimerstagaire.php?ID=<?php echo $STAGIAIRE['ID'] ?>">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
																							
											<?php } ?>
											
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Stagiaire par Page </label>
											<input type="hidden" name="ID_FILIERE" 
												value="<?php echo $idf ?>">
											<input type="hidden" name="motCle" 
												value="<?php echo $mc ?>">
											<input type="hidden" name="page" 
												value="<?php echo $page ?>">
											<select name="size" class="form-control"
													onchange="this.form.submit()">
												<option <?php if($size==5)  echo "selected" ?>>5</option>
												<option <?php if($size==10) echo "selected" ?>>10</option>
												<option <?php if($size==15) echo "selected" ?>>15</option>
												<option <?php if($size==20) echo "selected" ?>>20</option>
												<option <?php if($size==25) echo "selected" ?>>25</option>
											</select>
										</form>
									</li>
									<?php for($i=1;$i<=$nbrPage;$i++){ ?>
										<li class="<?php if($i==$page) echo 'active' ?>">
											<a href="stagiaires.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&ID_FILIERE=<?php echo $idf ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>