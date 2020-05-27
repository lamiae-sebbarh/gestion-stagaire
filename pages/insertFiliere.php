<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$nom=$_POST['NOM_FILIERE'];
	$niveau=$_POST['NIVEAU'];	
	
	$requete="insert into FILIERE(NOM_FILIERE,NIVEAU) values(?,?)";	
			
	$param=array($nom,$niveau);	
	
	$resultat = $con->prepare($requete);
	
	$resultat->execute($param);	
		
	header("location:filieres.php");
	
?>