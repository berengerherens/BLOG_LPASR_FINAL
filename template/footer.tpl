     
      <footer>
        <p>&copy; ULCO 2015 - 2016</p>

        <p id="bonjour">
            
            {if isset($user)}
                Connecte en tant que {$user}
            {else}
                déconnecté
            {/if}
            
         </p>
      </footer>

      
    </div>

  </body>
  
  <style>
      #bonjour
      {
          position: fixed;
          bottom: 0px;
          background: goldenrod;
          right: 10px;
      }
      
  </style>
</html>
