 <form method="post" action="inscription.php">
        <label for="user">Nom: </label>
        <input type="text" id="nom" name="nom" required="required"/>
        
         <label for="user">Prenom: </label>
        <input type="text" id="prenom" name="prenom" required="required"/>
        
        <label for="user">Email: </label>
        <input type="email" id="email" name="email" required="required"/>

        <label for="password">Mot de passe: </label>
        <input type="password" id="password" name="mdp" required="required"/>

        <br />
        <input type="submit" id="submit" value="Inscription"/>

</form>