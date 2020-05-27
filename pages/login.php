<?php
	
	if (version_compare(phpversion(), '5.4.0', '<')) {
		 if(session_id() == '') {
			session_start();
		 }
	 }
	 else
	 {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	 }
	if(isset($_SESSION['erreurLogin'])){
		$erreurLogin=$_SESSION['erreurLogin'];
		//$_SESSION['erreurLogin']="";
	}else{
		$erreurLogin="";
	}
	session_destroy();
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Se connecter</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<script src="../js/jquery-3.3.1.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</head>
	<body>		
		<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">			
			<div class="panel panel-primary espace60 ">
				<div class="panel-heading">Se connecter</div>
				<div class="panel-body">
					<form method="post" action="seConnecter.php" class="form">
						<?php
								if($erreurLogin!=""){?>			
									<div class="alert alert-danger alert-dismissible">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<?php echo $erreurLogin ?>
									</div>			
						<?php 	}	?>
						
						<div class="form-group">
							<label for="LOGIN" class="control-label">LOGIN</label>
							<input type="text" name="LOGIN" id="LOGIN" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="PWD" class="control-label">Mot de passe</label>
							<input type="password" name="PWD" id="PWD" class="form-control"/>
						</div>
							
						<button type="submit" class="btn btn-success">Se connecter</button>
						<br><br>
						<a href="InitialiserPwd.php">Mot de passe Oublié</a>
							&nbsp &nbsp	&nbsp
						<a href="nouvelUtilisateur.php">Créer un compte</a>	
					</form>
				</div>
			</div>			
		</div>
	</body>
</html>



