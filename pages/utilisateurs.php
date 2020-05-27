<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=5;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	$requete="select * from UTILISATEUR where login like '%$mc%' 
				ORDER BY login 	
				LIMIT $size
				OFFSET $offset";
				
	$resultat=$con->query($requete);
	
	$resultat2 = $con->query("select count(*) as nbrUser from UTILISATEUR where login like '%$mc%'");	
	$nbr=$resultat2->fetch();	
	$nbrU=$nbr['nbrUser'];	
	$reste=$nbrU % $size; 
	if($reste==0)
		$nbrPage=$nbrU/$size;
	else
		$nbrPage=floor($nbrU/$size)+1;
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>LES UTILISATEURS</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('entete.php');?>	
		<div class="container">
			<br>
			<div class="panel panel-primary espace60">
				<div class="panel-heading">RECHERCHER UN UTILISATEUR</div>
				<div class="panel-body">
					<form method="get" action="utilisateurs.php" class="form-inline">
						<div class="form-group">							
							
							<button type="submit" class="btn btn-primary">
							
							<i class="glyphicon glyphicon-search">...</i>
							</button>
							
							<input type="text" name="motCle" id="motCle" 
								class="form-control" 
								value="<?php echo $mc ?>" 
								placeholder="Taper un mot clé"/>
								
						</div>			
					</form>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">LISTE DES UTILISATEUR </div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>LOGIN</th>
								<th>ROLE</th>
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<th>ACTIONS</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php while($USER=$resultat->fetch()){?>
								<tr <?php 
										if($USER['ETAT']==1) 
											echo 'class="success"';
										else  
											echo 'class="danger"'; 
									?>>
									<td><?php echo $USER['ID'] ?></td>
									<td><?php echo $USER['LOGIN'] ?></td>
									<td><?php echo $USER['ROLE'] ?></td>
									<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<td>
											<a href="editerUtilisateur.php?id=<?php echo $USER['ID'] ?>">
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
											
											&nbsp &nbsp
											
											<a OnClick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')" 
											href="supprimerUtilisateur.php?id=<?php echo $USER['ID'] ?>">
												<span class="glyphicon glyphicon-trash"></span>
											</a>
											
											&nbsp &nbsp
											<a href="activerUtilisateur.php?ID=<?php echo $USER['ID'] ?>
													&ETAT=<?php echo $USER['ETAT'] ?>">
												<?php 
													if($USER['ETAT']==1) 
														echo '<span class="glyphicon glyphicon-remove"></span>';
													else  
														echo '<span class="glyphicon glyphicon-ok"></span>'; 
												?>
												
											</a>					
									</td>
										<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<div>
						<ul class="nav nav-pills">
							<?php for($i=1;$i<=$nbrPage;$i++){ ?>
								<li class="<?php if($i==$page) echo 'active' ?>">
									<a href="utilisateurs.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>">
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