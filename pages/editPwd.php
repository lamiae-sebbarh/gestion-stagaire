<?php
    require_once ('session.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Changement de mot de passe</title>
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/bootstrap.min.css">
        <link 	rel="stylesheet" 	type="text/css"  	href="../css/font-awesome.min.css">
        <link 	rel="stylesheet" 	type="text/css" 	href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
    	<script src="../js/myjs.js"></script>
    </head>
    <body>
    
    
    
    	<div class="container editpwd-page">
    		<h1 class="text-center">Changement de mot de passe</h1>
    		
    		<h2 class="text-center"> Compte :<?php echo $_SESSION['utilisateur']['LOGIN'] ?> 	</h2>
    		
    		<form class="form-horizontal" method="post" action="updatePwd.php">
    
    
    			<!-- ***************** start old pwd field  ***************** -->
    
    				<div class="input-container">
    					<input 	
    						minlength=4
    						class="oldpwd form-control" 
    						type="password"
    						name="oldpwd" 
    						autocomplete="new-password"
    						placeholder="Taper votre Ancien Mot de passe" 
    						required> 
    					<i class="show-oldpwd fa fa-eye fa-2x"></i>
    				</div>
    
    
    			<!-- ***************** end old pwd field ***************** -->
    
    
    
    			<!--  ***************** start new pwd field  ***************** -->
    
    
    				<div class="input-container">
    					<input 	
    						minlength=4
    						class=" newpwd form-control" 
    						type="password"
    						name="newpwd" 
    						autocomplete="new-password"
    						placeholder="Taper votre Nouveau Mot de passe" 
    						required> 
    					<i class="show-newpwd fa fa-eye fa-2x"></i>
    				</div>
    
    
    			<!--  *****************  end new pwd field  ***************** -->
    
    			<!--  ***************** start submit field  ***************** -->
    
    					<input 
    						type="submit" 
    						value="Enregistrer"
    						class="btn btn-primary btn-block" />
    
    			<!--   ***************** end submit field  ***************** -->
    
    		</form>
    	</div>
    
    </body>
</html>



