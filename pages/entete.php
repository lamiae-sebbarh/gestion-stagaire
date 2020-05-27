<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="index.php" class="navbar-brand">Gestion des stagiaires</a>
		</div>
		
		<ul class="nav navbar-nav">
			
			<li><a href="stagiaires.php">Les Stagiaires</a></li>
			<li><a href="filieres.php">Les Filières</a></li>
			<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
				<li><a href="Utilisateurs.php">Les utilisteurs</a></li>
			<?php } ?>
			
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="editerUtilisateur.php?id=<?php echo $_SESSION['utilisateur']['ID'];?>">
						<span class="glyphicon glyphicon-user"></span> 
						<?php echo $_SESSION['utilisateur']['LOGIN'];?>
					</a>
				</li>
				<li>
					<a href="SeDeconnecter.php">
						<span class="glyphicon glyphicon-log-out"></span>
						Se Deconnecter
					</a>
				</li>
			</ul>
	</div>
</nav>