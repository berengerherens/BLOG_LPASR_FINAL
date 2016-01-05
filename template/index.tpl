{foreach from=$elements item=item}

    <img src="img/{$item['id']}.jpg" alt="mon image" width="200px"/>   
    <h2>{$item['titre']}</h2>
    <p>{$item['texte']}</p>
    <p>{$item['date_fr']}</p>
    <p>
        <a href='commentaires.php?id={$item['id']}'>Commentaires</a>
           
        {if $type_connecte == 2}
            <a href='article.php?suppresion=0&id={$item['id']}'> Editer</a>
            <a href='article.php?suppresion=1&id={$item['id']}'> SUPPRIMER</a>
        {/if}         
                      
    </p>
   
{/foreach}


<div class="pagination">
    <ul>
        {for $i=0 to $nb_pages-1}
        <li>
            <a href="index.php?page={$i}&mot={$mot}">{$i+1}</a>
        </li>
        {/for}
    </ul>
</div>