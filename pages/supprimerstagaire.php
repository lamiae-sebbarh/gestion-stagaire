<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['ID'];

	$requete="DELETE FROM STAGIAIRE where ID=?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:stagiaires.php");
	
?>