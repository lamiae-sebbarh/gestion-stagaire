<?php
	//require_once('session.php');
?>

<?php
	session_start();
	require_once('connexion.php');
	
	if(isset($_POST['LOGIN']))
		$login=$_POST['LOGIN'];
	else
		$login="";
	
	if(isset($_POST['PWD1']))
		$pwd1=$_POST['PWD1'];
	else
		$pwd1="";
			
	if(isset($_POST['PWD2']))
		$pwd2=$_POST['PWD2'];
	else
		$pwd2="";
	
	if(isset($_POST['EMAIL']))
		$email=$_POST['EMAIL'];
	else
		$email="";

	$role='VISITEUR';
	
	$etat=0;
	
	$requete="select * from utilisateur where EMAIL=?";		
	$param=array($email);	
	$resultat = $con->prepare($requete);		
	$resultat->execute($param);	
	
	if($user=$resultat->fetch()){
		$_SESSION['erreurEmailExiste']="<strong>Erreur!</strong> Cette adresse Email existe deja!!!";
         header("Location:nouvelUtilisateur.php");
	}else{
		$requete="insert into UTILISATEUR(LOGIN,ROLE,PWD,EMAIL,ETAT) values(?,?,MD5(?),?,?)"; 	
		$resultat = $con->prepare($requete);			
		$param=array($login,$role,$pwd1,$email,$etat);
		$resultat->execute($param);
		
		$to = "sebbarhlamiae22@gmail.com";
		$subject = "Activation d'un compte";
		$txt = "Merci d'activer mon compte :$login";
		$headers = "From: GesStag" . "\r\n" .	"CC: sebbarhlamiae22@gmail.com";

		mail($to,$subject,$txt,$headers);

		session_destroy();
		header("location:confirmationCompte.php?login=$login&email=$email");
	}
?>