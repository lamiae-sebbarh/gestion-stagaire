<?php
	require_once('session.php');
?>
<?php
	require_once('connexion.php');
	
	if(isset($_GET['ID']))
		$id=$_GET['ID'];
	else
		$id=0;
	
	if(isset($_GET['ETAT']))
		$etat=$_GET['ETAT'];
	else
		$etat=1;
	
	$etat=$etat==1?0:1;

	$requete="update utilisateur set etat=$etat	where id=$id";	
	//$param=array($etat,$id);
	//$resultat = $con->prepare($requete);		
	//$resultat->execute($param);	
	//echo $requete;
	$resultat = $con->query($requete);
	header("location:utilisateurs.php");
	
?>