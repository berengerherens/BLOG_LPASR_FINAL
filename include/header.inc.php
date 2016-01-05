<?php

require_once('libs/Smarty.class.php'); //recuperation de la lib
$smarty = new Smarty();
$smarty->setTemplateDir('template/');


//gestion et affichage des message ok et d'erruer puis destruction de la session pour éviter les doublons de messages sur toutes les pages
if (isset($_SESSION["msg_ok"])) 
{   
    $smarty->assign('msg_ok',$_SESSION["msg_ok"]);
    unset ($_SESSION['msg_ok']);
}
if (isset($_SESSION["msg_error"]))
{  
    $smarty->assign('msg_error', $_SESSION["msg_error"]);
    unset ($_SESSION['msg_error']);  
}

                                                                        
$type_connecte = 0; //niveau de la connexion rien ou user=1 ou admin=2
            
if (isset($_COOKIE['connecte'])) //si on a un cookie de connexion
{   
    // on verifie ensuite la validité du cookie, on recupérer le prenom et le niveau de l'user
    $request = mysql_query("SELECT sid, prenom,niveau FROM utilisateurs");  
    while ($result_request = mysql_fetch_array($request))
    {
        if($result_request['sid'] == $_COOKIE['connecte']) //si cookie valide
        { 

            $type_connecte = $result_request['niveau'];  //affectaction du niveau                  
            $user =  $result_request['prenom']; //affectaction du nom d'user
        }  

    }
}
            
           
$smarty->display('header.tpl'); //affichage du header
?>

