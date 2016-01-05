<h2>Article</h2>
<div>
    <img src="img/{$article['id']}.jpg" alt="mon image" width="200px"/>   
        <h2>{$article['titre']}</h2>

        <p>{$article['date_fr']}</p> 

        <p>{$article['texte']}</p>
              
</div>

<h2>Commentaires</h2>
{if isset($commentaires)}
	{foreach from=$commentaires item=item}
	  
	    <h2>{$item['titre']}</h2>
	    <p>{$item['date_fr']}</p>
	    <p>Par : {$item['user']}</p>
	    <p>{$item['message']}</p>
	    
	   
	{/foreach}
	
{else}
<p>Il n'y a pas de commentaires pour cet article.</p>
{/if}