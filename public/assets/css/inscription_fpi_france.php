<?php
$_POST['username'] = htmlspecialchars($_POST['username']); // On rend inoffensives les balises HTML que du visiteur.
$_POST['one_password'] = htmlspecialchars($_POST['one_password']); // On rend inoffensives les balises HTML que du visiteur.
$_POST['two_password'] = htmlspecialchars($_POST['two_password']); // On rend inoffensives les balises HTML que du visiteur.

if (isset($_POST["username"]) && isset($_POST["one_password"]) && isset($_POST["two_password"]))
{
    if (($_POST["one_password"]) == ($_POST["two_password"]))
      {
							if (preg_match("#^0[1-8]([-. ]?[0-9]{2}){4}$#", $_POST['username']))
							{
								$pass_hache = password_hash($_POST['one_password'], PASSWORD_DEFAULT);
								$dbpdo = new PDO('mysql:host=185.98.131.91;dbname=fpifr1095223', 'fpifr1095223', 'es69twdchw');
								$db=$dbpdo-> prepare('INSERT INTO inscription(id, username, password, date_crea)VALUES(NULL, :username, :password, now())'); 
								$db->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
								$db->bindValue(':password', $pass_hache, PDO::PARAM_STR);
								$insertisok= $db->execute();
								//echo 'voilà votre id-';
								$lastId= $dbpdo->lastInsertId();
								$num = "FPIFR-$lastId";	
								//echo $num;						
											
			if ($insertisok){
			$message="Félicitation, vous etes maintenant inscrit au FPI. vous recevrez un message  par sms vous attribuant votre numero d\'inscription au FPI. ce numero est le, $num";
			$message_inscription=" Felicitation, vous etes inscrit au FPI sous le numero $num Vous appartenez donc a l\'une des plus grande famille politique Africaine";
			$message_n_tel = $_POST['username'];										
			echo $message_inscription;
			echo $message_n_tel;
													
		// CapitoleMobile POST URL
		$postUrl = "https://sms.capitolemobile.com/api/sendsms/xml";
		//Structure de Données XML
		$xmlString = '<SMS>
							<authentification>
									<username>Traore Daouda</username>
									<password>Erick2691</password>
							</authentification>
								<message>
										<text> '.$message_inscription.' </text>
										<sender>FPI FRANCE</sender>
								</message>
							<recipients>
									<gsm>'.$message_n_tel.'</gsm>
							</recipients>
					  </SMS>';
		// insertion du nom de la variable POST "XML" avant les données au format XML
		$fields = "XML=" . urlencode(utf8_encode($xmlString));
		// dans cet exemple, la requête POST est realisée grâce à la librairie Curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $postUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		// Réponse de la requête POST
		$response = curl_exec($ch);
		curl_close($ch);
		// Ecriture de la réponse
		echo $response;
																																																																																																																																															
													
													}
													else{
													$message='le contact na pas été ajouté dans la bdd';
													}
													echo $message;
							 }
							 else
								{
								 echo 'Le ' . $_POST['username'] . ' n\'est pas valide, recommencez !';
								}
		}
								
						
		
 else{
	  echo 'mot de pass faux';
	 }
	}
?>	
<!DOCTYPE html>
<html lang="fr">
    
    <head>
    
        <meta charset="utf-8">
        <title>Inscription_FPI_France</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Connexion à mon application">
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
        <!-- ci-dessous notre fichier CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/tuto.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/app.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:400,700,300" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
	<?php
	 if (isset($_POST['submit'])){
 
                $erreurs['username'] = '';
                $erreurs['one_password'] = '';
                $erreurs['two_password'] = '';
               
 
     if(empty($_POST['username']))
	 			{
				$erreurs['username'] = 'entrez votre identifiant: obligatoire';
				}
				 
	 elseif(empty($_POST['one_password']))
	 			{
				$erreurs['one_password'] = 'entrez votre mot de passe: obligatoire';
				}
	elseif(empty($_POST['two_password'])){
				$erreurs['two_password'] = 'répéter votre mot de passe: obligatoire';
				}
	else {
			echo'vos données sont justes.';
		 }
        
        }
	?>
	
	
	
    <<div class="container">
        <div class="row">
        <div class="col-xs-12">
            
            <div class="main">
                    
                <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-1">
                            
                    <h1>Inscription au Front Populaire Ivoirien (FPI). </h1>
                    <h3>Après inscription vous recevrez un <strong>sms</strong> de confirmation, </h3>
                    <p>vous attribuant définitivement votre n° unique d'inscription au FPI. </p>
                    <form action="" name="login" role="form" class="form-horizontal" method="post" accept-charset="utf-8">
                        <div class="form-group">
                          <div class="col-md-8">
                            <input name="username" placeholder="entrez votre tel(10 chiffres)" class="form-control" type="text" id="UserUsername"/>
							<p class='rougetext'> <?php echo $erreurs['username']; ?></p>
                          </div>
                        </div> 
                        
                        <div class="form-group">
                        <div class="col-md-8"><input name="one_password" placeholder="entrez votre code alphabet ou chiffre.(entre 4 et 8)" value="echo $_POST['username']"class="form-control" type="password" id="UserPassword"/></div>
						<p> <?php echo $erreurs['one_password']; ?></p>
                        </div> 

                        <div class="form-group">
                            <div class="col-md-8"><input name="two_password" placeholder="repetez votre code" class="form-control" type="password" id="UserPassword"/></div>
							<p> <?php echo $erreurs['two_password']; ?>
                      </div> 
                        
                        <div class="form-group">
                          <div class="col-md-offset-0 col-md-8">
                            <input name="submit" type="submit"  class="btn btn-success btn btn-success" value="Connexion"/>
                          </div>
                        </div>
                    
                    </form>
                    <p class="credits">Développé par <a href="http://www.monsite.com" target="_blank">les sections FPI de Lyon </a>.</p>
                </div>
                </div>
                
            </div>
        </div>
        </div>
        </div>
    </body>
</html>