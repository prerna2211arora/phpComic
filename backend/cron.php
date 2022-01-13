<?php
include_once "conn.php";
include_once "comics.php";
require("sendgrid/sendgrid-php.php");  
   $comic = getComic();

  $user = sprintf("SELECT `userEmail` FROM `mail_data` WHERE `userStatus`= 1 AND `userVerified`= 1");

  $result = $conn->query($user);

  if ($result->num_rows > 0) 
  {

  while($row = $result->fetch_assoc()) 
  {

   $user=$row['userEmail'];
   echo "Sending Comic to -> $user";

   $email = new \SendGrid\Mail\Mail(); 
$email->setFrom("cu.19bcs4086@gmail.com", "RTCAMP");
$email->setSubject("Random XKCD comic");
$email->addTo($user, "XKCD Comic Lover");
$email->addContent("text/plain", "Your XKCD comic is here");
$email->addContent(
    "text/html", "$comic<br>To unsubscribe from XKCD Comic click here -> <a href='https://xkcdphpcomic.000webhostapp.com/backend/unsubscribe.php?user=$user'>Unsubscribe</a>"
);
$sendgrid = new \SendGrid(getenv("SENDGRID_KEY"));
echo "sending";
    $response = $sendgrid->send($email);
    echo "$response";

    }

  }


?>