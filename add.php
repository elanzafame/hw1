<?php
    require_once 'auth.php';
      if (!$userid = checkAuth()) {
          header("Location: login.php");
          exit;
      }
    $conn = mysqli_connect($configuration['host'], $configuration['user'], $configuration['password'], $configuration['name']);
    
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image =mysqli_real_escape_string($conn, $_POST['image']);
    $query = "INSERT INTO movie(user_id, movie_id,image,title) VALUES ($userid,'$id','$image','$title')";
    $res= mysqli_query($conn,$query);
    if($res) {
      $response = array('result' => true);
    } else {
      $response = array('result' => false);
    }
  
    echo json_encode($response);
    
    mysqli_close($conn);

?>