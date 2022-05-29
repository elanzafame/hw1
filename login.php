<?php 
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    
    if (!empty($_POST["username"]) && !empty($_POST["password"])){
        $conn= mysqli_connect($configuration['host'], $configuration ['user'], $configuration['password'], $configuration['name']) or die(mysqli_error($conn));
        $username= mysqli_real_escape_string($conn, $_POST['username']);
        $password= mysqli_real_escape_string($conn, $_POST['password']);
        $query = "SELECT id, username, password FROM users WHERE username ='$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res)>0){
            $entry = mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'], $entry['password'])){
                $_SESSION['session_username']= $entry['username'];
                $_SESSION['session_id']=$entry['id'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error= "Username e/o password errati";

    }   
?>

<html>
    <head>
        <link rel='stylesheet' href='recording.css'>
        <title>Accedi</title>
    </head>
    <body>
        <main>
            <section>
                <?php
                    if (isset($error)) {
                        echo "<span class='error'>$error</span>";
                    }
                ?>
                <form name='login' method='post'>
                    <div class="username">
                        <div><label for='username'>Nome utente</label></div>
                        <div><input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                    </div>
                    <div class= 'password'>
                        <div><label for='password'> Password </label></div>
                        <div><input type ='password' name= 'password'<?php if (isset($_POST["password"])){echo "value=".$_POST["password"];}?>></div>
                        
                    </div>
                    <div>
                        <input type='submit' value='Accedi'>
                    </div>
                </form>
                <div class=signup> Non hai un account? <a href='recording.php'> Iscriviti</a>
            </section>
        </main>
    </body>
</html>