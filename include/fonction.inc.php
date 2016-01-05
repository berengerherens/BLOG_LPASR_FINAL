<?php

//fonction de pagination afin de compter le nombre de pages nécessaires
function Pagination($articles_par_pages, $mot)
{
    $nb_entrees = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS entrees FROM articles WHERE publie = 1 AND (titre LIKE '%$mot%' OR texte LIKE '%$mot%')" ));
    return $nb_entrees['entrees']/$articles_par_pages; 
}
?>
