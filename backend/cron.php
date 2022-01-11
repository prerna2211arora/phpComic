<?php
include_once "conn.php";
include_once "comics.php";
$comic = getComic();

  $user = sprintf("SELECT `userEmail` FROM `mail_data` WHERE `userStatus`= 1 AND `userVerified`= 1");

  $result = $conn->query($user);

  if ($result->num_rows > 0) 
  {

  while($row = $result->fetch_assoc()) {

   $email=$row['userEmail'];

   $curl = curl_init();
   
   curl_setopt_array($curl, [
     CURLOPT_URL => "https://easymail.p.rapidapi.com/send",
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_SSL_VERIFYPEER => false,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "POST",
     CURLOPT_POSTFIELDS => "{\r\n    \"from\": {\r\n        \"name\": \"XKCD Comic\"\r\n    },\r\n    \"to\": {\r\n  
            \"address\": \"$email\"\r\n    },\r\n  
              \"subject\": \" Random XKCD Comic \",\r\n   
               \"message\": \" $comic<br>To unsubscribe from XKCD Comic click here -> <a href='http://localhost/RtCamp/backend/unsubscribe.php?user=$email'>Unsubscribe</a>\"\r\n}",
     CURLOPT_HTTPHEADER => [
       "content-type: application/json",
       "x-rapidapi-host: easymail.p.rapidapi.com",
       "x-rapidapi-key: 0ea0320398mshac5b4c5bd268665p17bb40jsn0e9fb8e2708c"
     ],
   ]);
   
   $response = curl_exec($curl);
   $err = curl_error($curl);
   curl_close($curl);
    }
}
?>