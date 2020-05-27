<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$nom=$_POST['NOM'];
	$prenom=$_POST['PRENOM'];
	$id_filiere=$_POST['ID_FILIERE'];
	
	$civilite=$_POST['civilite'];
		
	$nomPhoto= $_FILES['PHOTO']['name'];	
	$imageTmp=$_FILES['PHOTO']['tmp_name'];
	move_uploaded_file($imageTmp,'../images/'.$nomPhoto);
	
	$requete="insert into STAGIAIRE(NOM,PRENOM,ID_FILIERE,PHOTO,CIVILITE) values(?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($nom,$prenom,$id_filiere,$nomPhoto,$civilite);			
	$resultat->execute($param);	
		
	header("location:stagiaires.php");
	
?>