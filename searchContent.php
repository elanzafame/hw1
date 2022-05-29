<?php
require_once 'auth.php';
if (!checkAuth()) exit;
header('Accept: application/json');

imdb();
function imdb(){
        $apikey = 'k_ontdklta';
    
        $query = $_GET["q"];
        $url = 'https://imdb-api.com/en/API/Search/'.$apikey.'/'.$query;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $json = json_decode($data);
        curl_close($ch);
        echo $data;
}
?>
