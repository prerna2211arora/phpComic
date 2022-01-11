<?php
function getComic()
{
    $id =rand(1,2566);
    
    $url = "https://xkcd.com/$id/info.0.json";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$xyz = json_decode($resp);
$image = $xyz->img;
$title = $xyz->title;
return "<h1> $title </h1><br><img src='$image' alt='$title'>";
}
?>