<?php
  
 echo "envoi du formulaire";
if (isset($_POST["username"]) && isset($_POST["one_password"]) && isset($_POST["two_password"]))
{
   
   echo $_POST["one_password"];
   echo $_POST["two_password"];
   echo $_POST["username"];
      echo "Le formulaire est validé";

      $dbpdo = new PDO('mysql:host=185.98.131.91;dbname=fpifr1095223', 'fpifr1095223', 'es69twdchw');

      $db=$dbpdo-> prepare('INSERT INTO inscription VALUES(NULL, :username, :password, NOW())') ; 
      $db->bindValue(':username', $_POST["username"], PDO::PARAM_STR);
      $db->bindValue(':password', $_POST["one-password"], PDO::PARAM_STR);

     $insertisok = $db->execute();

      if ($insertisok){
          $message='le contacte a été ajouté dans la bdd';
         }
      else{
          $message='le contact na pas été ajouté dans la bdd';}
 }


else {
    echo "Le formulaire n'est pas validé";
   
	}
echo "Code commun aux deux situations"
// ...


?>