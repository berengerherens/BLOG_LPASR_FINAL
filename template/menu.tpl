</div>
          
          <nav class="span4">
              
            <form action="index.php" method="get">
                <p>
                    <label for="mot">Recherche : </label>
                    <input type="text" name="mot" id="mot"/>
                    <input type="submit"/>
                <p>
            </form>
            <h3>Menu</h3>
            
            
            <ul>
                <li><a href="index.php">Accueil</a></li>
                
                {if !$type_connecte}
                    <li><a href="connexion.php?connexion=1">Connexion</a></li>
                    <li><a href="inscription.php">Créer un compte</a></li>
                {else if $type_connecte}
                    {if $type_connecte == 2}
                    <li><a href="article.php">Rédiger un article</a></li>
                    {/if}
            
                    <li><a href="connexion.php?connexion=0">Déconnexion</a></li>
                {/if}
                
                    
                
             </ul>
       
          </nav>
        </div>
        
</div>