<form action="commentaires.php?id={$article['id']}" method="post" id="form_article" name="form_article">

        <div class="clearfix">
            <label for="titre">Titre: </label>
            <div class="input">
                <input type="text" name="titre" id="titre" value="" required="required"/>
            </div>
        </div>
        <div class="clearfix">
            <label for="texte">Texte: </label>
            <div class="textaea">
                <textarea name="texte" id="texte" required="required"></textarea>
            </div>
        </div>
        
        
        <div class="form-actions">
            <input type="submit" name="envoyer" value="envoyer" class="btn btn-large btn-primary"/>
        </div>
 </form>