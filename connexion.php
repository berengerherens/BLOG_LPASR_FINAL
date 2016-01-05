
<?php
session_start();

require_once 'config/bdd.inc.php'; // == include mais prdouit une erreur fatale stop le script a l'inverse d'include
include_once 'include/header.inc.php'; // == include mais empeche plusieurs include
include_once 'include/fonction.inc.php';

if($_GET['connexion'] == 1 && !$type_connecte) //si l'user chercher a se connecter et qu'il ne l'est pas
{
    if (isset($_POST['user'])) //si le formulaire user existe
    {
        //on cherche l'user et si son mdp est correct
        $select_utilisateur = "SELECT mdp, email, id FROM utilisateurs WHERE email = '" . $_POST['user'] . "'AND mdp ='" . $_POST['password'] . "'";
        $request = mysql_query($select_utilisateur);

        $connect = mysql_fetch_array($request);

        //si un user est trouvé
        if($connect)
        {   
             //creation du cookie et enregistrement dans la table
           $valeur_cookie =  md5($_POST['user'] . time());
             setcookie('connecte', $valeur_cookie,  time() + 3600); 
             $requete_cookie = "UPDATE utilisateurs SET sid = '" .  $valeur_cookie ."' WHERE email ='" . $_POST['user']. "'";
   
             mysql_query($requete_cookie);

             $_SESSION['msg_ok'] = "Vous etes connecte ! ";
             header("location: index.php");
        }
        else //il y a une erreur dans la ocnnexion
        {
            $_SESSION['msg_error'] = "erreur dans le mot de passe ou le nom. " . $image_erreur;
            header("location: connexion.php?connexion=1");
        }

        //Si valide, creation du cookie
    }
    
    $smarty->display('connexion.tpl'); 
}
else if($_GET['connexion'] == 0 && $type_connecte) //on deconnecte l'user en detruisant le cookie
{       
     setcookie('connecte', NULL, -1);
     $_SESSION['msg_ok'] = "Vous etes désormais déconnecte ! ";
     header("location: index.php");
          
}
else //sinon l'user est deja connecté donc redirection 
{
     header("location: index.php");    
     $_SESSION['msg_ok'] = "Vous étes deja connecte";
}

include_once 'include/menu.inc.php';
include_once 'include/footer.inc.php';
?>