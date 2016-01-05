<?php

$smarty->assign('type_connecte',$type_connecte); //assignement de la variable  "$type_connecte" (admin ou user) à smarty

//$smarty->debugging = true;
$smarty->display('menu.tpl');

?>
