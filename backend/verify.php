<?php
include_once "conn.php";
#UPDATE `mail_data` SET `userVerified`= 1 WHERE `userEmail`='edumail.ansh@gmail.com'
if(isset($_GET['user']) && isset($_GET['code']))
{
    $encryption = $_GET['code'];
    $email = $_GET['user'];
}
else{
    header("location: /error.php?error=User or Code not Specified");
}
$decryption_iv = '1234567891011121';
$ciphering = "AES-128-CTR";
  
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;
  
  $decryption_key = "RtCampPHPAssingment";
  
  $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
  $user = sprintf("SELECT `verification_code`, `userVerified` FROM `mail_data` WHERE `userEmail`='$email'");
  $result = $conn->query($user);
  if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if($row["verification_code"]==$decryption)
    {
        if($row["userVerified"])
        {
            echo "User already Verified";
        }
        else
        {
            $data = sprintf("UPDATE `mail_data` SET `userVerified`= 1 WHERE `userEmail`='$email'");
      
      if ($conn->query($data) === FALSE) {
       header("location: /error.php?error=Database Error");
      }
      else
      {
          echo " Email $email with code $decryption Verified";
      }
        }
    }
    else
    {
        echo "Wrong Verification Code";
    }
  }
} else {
  echo "Email $email doesn't exist";
}  
?>