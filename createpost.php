<?php
      require_once 'auth.php';
      if (!$userid = checkAuth()) {
          header("Location: login.php");
          exit;
      }
?>
    <html>
        <?php
            $conn = mysqli_connect($configuration['host'], $configuration['user'], $configuration['password'], $configuration['name']);
            $userid = mysqli_real_escape_string($conn, $userid);
            $query = "SELECT username FROM users WHERE id =$userid";
            $res= mysqli_query($conn, $query);
            $info=mysqli_fetch_assoc($res);
        ?>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel='stylesheet' href='hw1.css'>
            <script src="createpost.js" defer="true"></script>
            <link href="https://fonts.googleapis.com/css2?family=Rouge+Script&display=swap" rel="stylesheet">
        </head>
         <body>
            <header>
                <nav>
                    <div id="links">
                    <a href ='./'>Home</a>    
                    <a href='create'>Cerca</a> 
                    <a><?php echo $info['username']?> </a>
                    <a href ='login.php'>Logout</a> 
                    </div>
                </nav>
                <div id='overlay'></div>
                    <h1>
		                <section id='newpost'>
                            <form>
                                <label>Cerca Film </label>
                                <input type="text" name="search" id="searchbox">
                                <input type ='submit' value='Cerca'>
                            </form>
                        </section>
                    </h1>
                </header>
            
                
                <div id="results">
                   
                </div>
                 
            
            <article id="modale" class="hidden">    
                <form>
                    <input type='submit' value='Aggiungi'>
                </form>
            </article>
    </body>
</html>