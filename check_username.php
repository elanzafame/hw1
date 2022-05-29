<?php
    require_once 'configuration.php';
    $conn= mysqli_connect($configuration['host'],$configuration['user'],$configuration['password'],$configuration['name']);
    $username=mysqli_real_escape_string($conn, $_GET["q"]);
    $query="SELECT username FROM users where username= '$username'";
    $res= mysqli_query($conn, $query) or die(mysqli_error($conn));
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
    mysqli_close($conn);
?>