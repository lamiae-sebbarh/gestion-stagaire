<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['id'];

	$requete="DELETE FROM utilisateur where id=?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:utilisateurs.php");
	
?>