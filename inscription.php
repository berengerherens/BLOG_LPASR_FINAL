
<?php
session_start();

require_once 'config/bdd.inc.php'; // == include mais prdouit une erreur fatale stop le script a l'inverse d'include
include_once 'include/header.inc.php'; // == include mais empeche plusieurs include
include_once 'include/fonction.inc.php';

if(!$type_connecte) //si pas connecté
{
    
    if (isset($_POST['email'])) //si l'email est renseigne ( teste si form rempli)
    {
        //affectatio ndes variables recu            
        $nom = addcslashes($_POST['nom'], "'%_");
        $prenom = addcslashes($_POST['prenom'], "'%_");
        $email = addcslashes($_POST['email'], "'%_");
        $mdp = $_POST['mdp'];
        
        //on test si l'email n'existe pas deja
        $request = mysql_query("SELECT email FROM utilisateurs"); 
        while ($result_request = mysql_fetch_array($request))
        {
          if($result_request['email'] == $email) 
          {  
              $_SESSION['msg_error'] = "L'adresse mail existe deja.";
              //si l'email existe, on redirige avec msg d'erreur
              header("location: index.php"); 
              return 0;
          }  
        }
        
        //insertion dans la table du nouvel user     
        mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
        $requete = "INSERT INTO utilisateurs (nom, prenom, email, niveau, mdp) VALUES ('$nom', '$prenom', '$email', '1', '$mdp')";
        mysql_query($requete);
        $_SESSION['msg_ok'] = "Votre compte à été créé !";
        header("location: index.php"); 
            
    }
    
    $smarty->display('inscription.tpl'); //affichage d'inscription sinon

  include_once 'include/menu.inc.php';
  include_once 'include/footer.inc.php';
     
}
else //impossible de créer un compte car deja connecté
{
    header("location: index.php");    
    $_SESSION['msg_error'] = "Déconnectez-vous pour créer un compte.";
}
?>





