<?php
session_start();

require_once 'config/bdd.inc.php'; // == include mais prdouit une erreur fatale stop le script a l'inverse d'include
include_once 'include/fonction.inc.php';

$articles_par_pages = 5; //nb d'articles par pages

$mot = ""; //varialbe pour la recherche

$affichage = (isset ($_GET['page'])) ? $_GET['page']*$articles_par_pages : 0 ; 
//si un get existe pour recuperer le numero de la page on affecte sinon on va a la page 0origine

if(isset ($_GET['mot'])) // si on realise une recherche
{
    $mot = $_GET['mot']; //affectation du get de recherche
    $select_all_post = "SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') 
    as date_fr FROM articles WHERE publie = 1 AND (titre LIKE '%$mot%' OR texte LIKE '%$mot%') ORDER BY id DESC LIMIT $affichage,$articles_par_pages";     
    //requete pour la recherche
}
else
{
$select_all_post = "SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr FROM articles WHERE publie = 1 ORDER BY id DESC LIMIT $affichage,$articles_par_pages";
// affiche toute la table article avec condition sur publie == 1
}

$requesta = mysql_query($select_all_post);
// on place dans une variable l'executionde la req

$nb_pages = Pagination($articles_par_pages, $mot);


if(isset ($_GET['mot']))
{
        //nombre d'articles correspondant a la recherche
		if (!empty($mot)) $_SESSION['msg_ok'] = $articles_par_pages*$nb_pages . " Articles Correspondent à votre recherche.";
}

include_once 'include/header.inc.php'; // == include mais empeche plusieurs include


$smarty->assign('nb_pages',$nb_pages);


//recuperatio ndes artoicles
if (!mysql_num_rows($requesta) == 0)
{
	
    for ($i = 0 ; $result_request = mysql_fetch_array($requesta) ; $i++ ) 
    {
        $elem[$i] = $result_request; 
    }


    $smarty->assign('elements',$elem);
    $smarty->assign('type_connecte',$type_connecte);
    $smarty->assign('mot',$mot);
    $smarty->display('index.tpl');
	
	
}
else //pas d'articles trouvé avec la recherhce
{
    $_SESSION['msg_error'] = "Aucun article ne correspond à votre recherche. Vous avez été redirigé sur la page d'accueil.";
    header("location: index.php");
}

//avec concaténation


// dans le for on utilise une variable i qui va générer le menu permettand d'acceder au pages
// par soucis de logique avec le reste du code et l'informatique, la premiere page correspond au GET page=0.
// En revanche on affiche "page 1" à l'utilisateur par soucis de logique pour l'user.

 
    

include_once 'include/menu.inc.php';
include_once 'include/footer.inc.php';
?>   