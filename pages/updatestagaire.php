<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_POST['ID'];
	$nom=$_POST['NOM'];
	$prenom=$_POST['PRENOM'];
	$id_filiere=$_POST['ID_FILIERE'];	
	$civilite=$_POST['civilite'];

		//Récuperer le Nom de la photo envoyée
	$nomPhoto= $_FILES['PHOTO']['name'];	
	
		//Récuperer le Nom du fichier image temporaire sur le serveur
	$imageTmp=$_FILES['PHOTO']['tmp_name'];
	
		//Déplacer le fichier temporaire vers le dossier images de mon application
	move_uploaded_file($imageTmp,'../images/'.$nomPhoto);
			
	if(!empty($nomPhoto)){ // empty($nomPhoto):$nomPhoto est vide (Photo non envoyée)
						  // !empty($nomPhoto):$nomPhoto non vide (Photo envoyée)
		
		$requete="UPDATE STAGIAIRE SET NOM=?,PRENOM=?,ID_FILIERE=?,PHOTO=?,CIVILITE=? where id=?";
		
		$param=array($nom,$prenom,$id_filiere,$nomPhoto,$civilite,$id);		
	}
	else{ // Photo non envoyée
		$requete="UPDATE STAGIAIRE SET NOM=?,PRENOM=?,ID_FILIERE=?,CIVILITE=? where id=?";
				
		$param=array($nom,$prenom,$id_filiere,$civilite,$id);
	}
			
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:stagiaires.php");

?>