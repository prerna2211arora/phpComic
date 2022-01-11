<?php
 if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location: /error.php?error=Method Not Allowed");
  }
  include_once "conn.php";
 $email = $_POST['email_id'];
 $code = random_int(100000, 999999);
 $data = sprintf("INSERT INTO `mail_data`(`userEmail`, `verification_code`) VALUES ('%s',%u)",$email,$code);

 if ($conn->query($data) === FALSE) {
  header("location: /error.php?error=User With Email <i>$email</i> is Already Registered");
 }
 else
 {
  
  $ciphering = "AES-128-CTR";
  
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;
  
  $encryption_iv = '1234567891011121';
  
  $encryption_key = "RtCampPHPAssingment";
  
  $encryption = openssl_encrypt($code, $ciphering, $encryption_key, $options, $encryption_iv);

        $verify = "http://localhost/RtCamp/backend/verify.php?user=$email&code=$encryption" ; 

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
              \"subject\": \" Verification email for XKCD Comic\",\r\n   
               \"message\": \" To verify your email click here -> <a href='$verify'>VERIFY</a>\"\r\n}",
     CURLOPT_HTTPHEADER => [
       "content-type: application/json",
       "x-rapidapi-host: easymail.p.rapidapi.com",
       "x-rapidapi-key: 0ea0320398mshac5b4c5bd268665p17bb40jsn0e9fb8e2708c"
     ],
   ]);
   
   $response = curl_exec($curl);
   $err = curl_error($curl);
   
   curl_close($curl);
   
   if ($err) {
    header("location: /error.php?error=Email API Error");
   } 
 }
?>
