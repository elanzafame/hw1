<?php
    require_once 'auth.php';
    if(checkAuth()){
        header("Location: home.php");
        exit;
    }
        if(!empty($_POST["name"]) && !empty($_POST["surname"]) &&!empty($_POST["email"]) &&
           !empty($_POST["username"]) &&!empty($_POST["password"])&&!empty($_POST["confirm_password"]))
        {
            $error = array();        
            $conn = mysqli_connect($configuration['host'],$configuration['user'],$configuration ['password'],$configuration ['name']) or die(mysqli_error($conn));
             if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username']))
                {
                    $errore[]= "username non valido";
                }
            else{
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $query = "SELECT username FROM users WHERE username='$username'";
                    $res = mysqli_query($conn, $query);
                    if(mysqli_num_rows($res)>0){
                        $error []= "Username già esistente";
                    }
                }
        
            if(!preg_match('/^[a-zA-Z0-9_]{8,50}$/', $_POST['password'])) {
                $error[]= 'Password non valida'; 
            }
        
            if(strcmp($_POST['password'], $_POST['confirm_password']) !=0){
            $error[]= 'Le password non coincidono';
            }
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error[]= 'email non valida';
            }
        
            if(count($error)==0){
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $surname = mysqli_real_escape_string($conn, $_POST['surname']);
                $email= mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $password = password_hash($password, PASSWORD_BCRYPT);
                $query= "INSERT INTO users(name, surname, email, username, password) VALUES ('$name', '$surname', '$email', '$username', '$password')";
                if(mysqli_query($conn,$query)){
                    $_SESSION["session_username"]= $_POST ["username"];
                    $_SESSION["session_id"]=mysqli_insert_id($conn);
                    mysqli_close($conn);
                    header("Location: home.php");
                    exit;
                }else{
                    $error[]="Errore connessione database";
                }
            
            }
             mysqli_close($conn);
        }

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='recording.css'>
        <script src="recording.js" defer="true"></script>
        <link href="https://fonts.googleapis.com/css2?family=Rouge+Script&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
        <section>
            <form name = 'recording' method='post'>
                <div class= 'name'>
                    <div><label for='name'> Nome </label> </div>
                    <div><input type ='text' name= 'name'<?php if (isset($_POST["name"])){echo "value=".$_POST["name"];}?>></div>
                    <span>Formato nome non valido</span>
                    </div>
                </div>
                <div class= 'surname'>
                    <div><label for='surname'> Cognome </label></div>
                    <div><input type ='text' name= 'surname' <?php if (isset($_POST["surname"])){echo "value=".$_POST["surname"];}?>></div>
                    <span>Formato cognome non valido</span>
                </div>
                <div class= 'email'>
                    <div><label for='email'> E-mail </label></div>
                    <div><input type ='text' name= 'email'<?php if (isset($_POST["email"])){echo "value=".$_POST["email"];}?>></div>
                    <span>e-mail non valida</span>
                </div>
                 <div class="username">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                    <span>Nome utente non disponibile</span>
                </div>
                <div class= 'password'>
                    <div><label for='password'> Password </label></div>
                    <div><input type ='password' name= 'password'<?php if (isset($_POST["password"])){echo "value=".$_POST["password"];}?>></div>
                    <span>"Errore: la password deve contenere almeno 8 caratteri"</span>
                    </div>
                </div>
                <div class= 'confirm_password'>
                    <div><label for='confirm_password'> Conferma Password </label></div>
                    <div><input type ='password' name= 'confirm_password'<?php if (isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];}?>></div>
                    <span>Le password non coincidono</span>
                    </div>
                </div>
                <div class = 'submit'>
                    <input type='submit' value='Registrati' id='submit'>    
                </div>
            </form>
            <div class=' recording'> Possiedi già un account? <a href='login.php'> Accedi </a>
        </section>
    </main>
    </body>
</html>