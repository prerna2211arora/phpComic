<?php
require("sendgrid/sendgrid-php.php");  
 if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location: /error.php?error=Method Not Allowed");
  }
  include_once "conn.php";
 $user = $_POST['email_id'];
 if ($user== '') {
    header("location: /error.php?error=Emai Id Not Specified");
  }
 $code = random_int(100000, 999999);
 $data = sprintf("INSERT INTO `mail_data`(`userEmail`, `verification_code`) VALUES ('%s',%u)",$user,$code);

 if ($conn->query($data) === FALSE) {
  header("location: /error.php?error=User With Email <i>$user</i> is Already Registered");
 }
 else
 {
  
  $ciphering = "AES-128-CTR";
  
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;
  
  $encryption_iv = '1234567891011121';
  
  $encryption_key = "RtCampPHPAssingment";
  
  $encryption = openssl_encrypt($code, $ciphering, $encryption_key, $options, $encryption_iv);

  $verify = "https://xkcdphpcomic.000webhostapp.com/backend/verify.php?user=$user&code=$encryption" ; 
    try {
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("19BCS4067@cuchd.in", "Example User");
$email->setSubject("Email Verification For Random XKCD comic");
$email->addTo($user, "New User");
$email->addContent("text/plain", "Your XKCD comic Email Verification Is Here");
$email->addContent(
    "text/html", "To verify your email click here -> <a href='$verify'>VERIFY</a>"
);


$sendgrid = new \SendGrid(getenv("SENDGRID_KEY"));

   // $response = $sendgrid->send($email);
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}

  }
?>
