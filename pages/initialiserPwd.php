<?php
    require_once ('connexion.php');
    
    $erreur="";
    
    $msg="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['email']))
        
        $email = $_POST['email'];
    
    else
        
        $email = "";

    $requete1 = "select * from utilisateur where EMAIL='$email'";
    
    $resultat1 = $con->query($requete1);

    if ($user = $resultat1->fetch()) {
        $id = $user['ID'];
        $pwd = "0000";
        $requete = "update utilisateur set pwd=MD5(?) where id=?";
        $param = array($pwd,$id);
        $resultat = $con->prepare($requete);
        $resultat->execute($param);

        $to = $user['EMAIL'];
        
        $subject = "INITIALISATION DE MOT DE PASSE (Poste HP)";
        
        $txt = "Votre nouveau mot de passe de gesStag est :$pwd";
        
        $headers = "From: GesStag" . "\r\n" . "CC: sebbarhlamiae22@gmail.com";
        
        mail($to, $subject, $txt, $headers);

        $erreur = "non";
        
        $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email.";
    
    } else {
        $erreur = "oui";
        
        $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";
        
    }
}
?>



<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Initiliser votre mot de passe</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">

</head>
<body>
	<div class="container col-md-6 col-md-offset-3">
		<br>
		<div class="panel panel-primary ">
			<div class="panel-heading">Initiliser votre mot de passe</div>
			<div class="panel-body">

				<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form">

					<div class="form-group">
						<label for="email" class="control-label">
							Veuillez saisir votre
							Email de récuperation
						</label>
						
						 <input 
						 	type="email" 
						 	name="email"
							id="email" 
							class="form-control" />

					</div>

					<button 
						type="submit" 
						class="btn btn-success">
							Initialiser le mot de passe
					</button>

				</form>

				
			</div>
			
		</div>
		
		<div class="the-errors text-center">
			 
        			<?php

                        if ($erreur == "oui") {
            
                            echo '<div class="msg error">' . $msg . '</div>';
            
                            header("refresh:3;url=initialiserPwd.php");
            
                            exit();
                        } 
                        else if($erreur == "non")  {
            
                            echo '<div class="msg succes">' . $msg . '</div>';
            
                            header("refresh:3;url=login.php");
            
                            exit();
                        }
    
                    ?>
				
				</div>
	</div>

</body>
</html>



