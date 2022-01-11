<?php
include_once "conn.php";
#UPDATE `mail_data` SET `userVerified`= 1 WHERE `userEmail`='edumail.ansh@gmail.com'
if(isset($_GET['user']))
{
    $email = $_GET['user'];
}
else{
    header("location: /error.php?error=User not Specified");
}
  $user = sprintf("SELECT `userStatus` FROM `mail_data` WHERE `userEmail`='$email'");
  $result = $conn->query($user);
  if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
        if($row["userStatus"]== 0)
        {
            echo "User already Unsubscribed";
        }
        else
        {
            $data = sprintf("UPDATE `mail_data` SET `userStatus`= 0 WHERE `userEmail`='$email'");

      if ($conn->query($data) === FALSE) {
       header("location: /error.php?error=Database Error");
      }
      else
      {
          echo " Email $email successfully unsubscribed";
      }
        }
    }
} else 
{
  echo "Email $email doesn't exist";
}  
?>