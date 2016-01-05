<?php
session_start(); //debut de session pour les var $_SESSION

require_once 'config/bdd.inc.php'; //connexion à la bdd

if (isset($_POST['envoyer'])) // si on a traité un formulaire
{

    // stockage des element du formulaire dans des variables + securisé
    $titre = addcslashes($_POST['titre'], "'%_");
    $texte = addcslashes($_POST['texte'], "'%_");
    print_r($_POST);
    $publie = (!empty($_POST['publie']) ? $_POST['publie'] : 0);
    $date = date("Y-m-d");
    
    
    
    // requete d'insertion
    if ( isset($_GET['update_id'])) //si on veut modifier un article
    {
         $req_insertion = "UPDATE articles SET titre='$titre', texte='$texte', publie=$publie WHERE id =" . $_GET['update_id'];
        //requete de modification
    }
    else //sinon in insére un nouvel article
    {
        $req_insertion = "INSERT INTO articles (titre, texte, date, publie) VALUES ('$titre', '$texte', '$date', $publie)";
        //requete d'insertion du nouvel article
    }
    // test sur l'image
    $image_erreur = $_FILES['image']['error'];   
    if($image_erreur && !isset($_GET['update_id']) ) //error
    {
         $_SESSION['msg_error'] = "erreur sur l'image" . $image_erreur; //message d'erreur en top
         header("location: article.php"); //retour a article.php
         return 0;
         
    }
    else
    { 
        // all is good : deplacement de l'image et ecriture dans la bd
        mysql_query($req_insertion);
        if (isset($_GET['update_id'])) //si modification d'article
        {
            $id_article = $_GET['update_id'];  
            $_SESSION['msg_ok'] = "L'article à été modifié!";
        }
        else //sinon ajout d'article
        {
            $id_article = mysql_insert_id();  
            $_SESSION['msg_ok'] = "L'article à été ajouté!";
        }
        
        //deplacement de l'image
        if (!$image_erreur) move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$id_article.jpg");
        
         header("location: index.php");    
    }
    
   
    
    
} 
else //si on ne traite pas un formulaire
{
         
    include_once "include/header.inc.php";
    if ($type_connecte == 2) //si on est un administrateur
    {
        //déclaration et mise à 0 des élément
        $titre = '';
        $texte = '';
        $img = '';
        $update_id = '';

        //si on a demandé la suppression d'un article
        if ( isset($_GET['suppresion']) && isset($_GET['id']))
        {
            if ($_GET['suppresion']) //suppression de l'article
            {
                $requete = "DELETE FROM articles WHERE id=" . $_GET['id'];
                mysql_query($requete);       
                $_SESSION['msg_ok'] = "post supprimé ! ";
                header("location: index.php");
                return 0;

            }
            else //sinon si demande d'édition on récupére les data de l'article
            {
              $select_post = "SELECT id, titre, texte FROM articles WHERE id =" . $_GET['id'];
              $request = mysql_query($select_post);
              $req = mysql_fetch_array($request);
              $titre = $req['titre'];
              $texte = $req['texte'];
              $img = "<img src='img/" . $req['id'] .".jpg' alt='mon image' width='200px'/>";
              $update_id = "?update_id=" . $req['id'];
            }
        
        }
     
        $smarty->assign('titre',$titre); //assigne une var
        $smarty->assign('texte',$texte); //assigne une var
        $smarty->assign('img',$img); //assigne une var
        $smarty->assign('update_id',$update_id); //assigne une var
        
        $smarty->display('article.tpl'); //affichage des articles
       
        include_once 'include/menu.inc.php';
        include_once 'include/footer.inc.php';
    }
    else //si user pas admin affichage d'un message et redirection sur la page de connexion
    {
        $_SESSION['msg_error'] = "Vous devez être connecté en tant qu'admin pour accéder à cette page.";
        header("location: connexion.php?connexion=1");
    }
   
}

?>