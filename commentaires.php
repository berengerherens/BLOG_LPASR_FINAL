<?php
session_start();
require_once('libs/Smarty.class.php'); //recuperation de la lib
require_once 'config/bdd.inc.php';
$smarty = new Smarty();
$smarty->setTemplateDir('template/');
include_once 'include/header.inc.php';


//si un id est bien renseigné pour trouver les coms associdés a l'article
if (isset($_GET['id']))
{
        $id = $_GET['id']; //stockage du get dans uen variable

        //requete de recuperation de l'article correspondant (pour afficher l'article = simplifier les coms)
        $select_post = "SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr FROM articles WHERE id='$id'";
        $request_post = mysql_query($select_post);
        $post = mysql_fetch_array($request_post);

        //si il y a un article correspondant
        if($post)
        {
            //assignement a smarty du tableau contenant l'article
            $smarty->assign('article',$post);

            //jointure pour récupérer les comms et l'user ( enregistré en table ) associé a chacun
            $select_commentaires = "SELECT c.titre, c.message, c.id_article, u.prenom as user, DATE_FORMAT(date, '%d/%m/%Y') as date_fr FROM commentaires c LEFT JOIN utilisateurs u ON c.id_user=u.id WHERE id_article= '$id' ORDER BY c.id DESC" ;
            $request_commentaires = mysql_query($select_commentaires);
         
            //enregistrement de tous les comms dans un tableau puis passage a smarty
            for ($i = 0 ; $result_request = mysql_fetch_array($request_commentaires) ; $i++ ) $commentaires[$i] =  $result_request; 
            if(isset($commentaires)) $smarty->assign('commentaires',$commentaires);
            $smarty->display('commentaires.tpl');            
        }
        else // sinon erreur donc redirection a la Linux barre.
        {
            header("location: index.php");
        }

        if(isset($_COOKIE['connecte'])) //si l'user est bien connecte
        {
            //on le cherche
            $sid = $_COOKIE['connecte'];
            $req_user = mysql_query("SELECT id FROM utilisateurs WHERE sid='$sid'");
            $resu_req_user = mysql_fetch_array($req_user);
            
            //s'il est correct
            if($resu_req_user)
            {
                // on realise les étapes d'insertion dans la bdd du commentaire
                $id_user = $resu_req_user['id'];

                if(isset($_POST['titre']))
                {           
                    $date = date("Y-m-d");
                    $titre = addcslashes($_POST['titre'], "'%_");
                    $texte = addcslashes($_POST['texte'], "'%_");
                    $id = $_GET['id'];

                    $req_insertion = "INSERT INTO commentaires(titre, message, date, id_article, id_user) VALUES ('$titre', '$texte', '$date', '$id', '$id_user')";
                    mysql_query($req_insertion);

                    $_SESSION['msg_ok'] = "Votre commentaire à été ajouté.";
                    header("location: commentaires.php?id=$id");
                }

                $smarty->display('commenter.tpl');
            }

            
        }
       
        include_once 'include/menu.inc.php';
        include_once 'include/footer.inc.php';
}
   

else
{
    header("location: index.php");
}




    
    
    

 
?>