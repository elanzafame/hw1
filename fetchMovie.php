<?php
    require_once 'auth.php';
      if (!$userid = checkAuth()) {
          header("Location: login.php");
          exit;
      }
    $conn = mysqli_connect($configuration['host'], $configuration['user'], $configuration['password'], $configuration['name']);
    $query = "SELECT * FROM movie where user_id=$userid";
    $res= mysqli_query($conn, $query);
    $array =array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($array, $row);
    }
    echo json_encode($array);
?>