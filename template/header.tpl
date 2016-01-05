<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Shadock's  blog</title>
    <meta name="description" content="Ga-Bu-Zo-Meuh">
    <meta name="author" content="Herens Berenger">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>

  <body>
      
      {if isset($msg_ok)}
         <div class="alert alert-success" id="notif"> {$msg_ok} </div> 
      {elseif isset($msg_error)}
         <div class="alert alert-error" id="notif"> {$msg_error} </div> 
      {/if}
      
      
      
      
      
        <div class="container">

      <div class="content">
      
        <div class="page-header well">
          <h1>Mon Blog : <small>Ga-Bu-Zo-Meuh (Bérenger Hérens)</small></h1>
        </div>
        
        <div class="row">
        
          <div class="span8">