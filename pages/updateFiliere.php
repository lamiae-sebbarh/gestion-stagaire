<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_POST['ID'];
	$nom=$_POST['NOM_FILIERE'];
	$niveau=$_POST['NIVEAU'];
	
	$requete="UPDATE FILIERE SET NOM_FILIERE=?,NIVEAU=? where id=?";
	$param=array($nom,$niveau,$id);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:filieres.php");

?>