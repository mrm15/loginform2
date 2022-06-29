<?php
// require 'confing.php';
// function checkregister($link,$email,$tel){
    

//  $sql = "SELECT `email`,`phone_number` FROM kvc where `email`='$email'or`phone_number`='$tel'";
// $result = mysqli_query($link, $sql);

// if (mysqli_num_rows($result) > 0) {
//   $message="شماقبلا ثبت نام شده اید";
//   message($message);
// } else {
//   echo "0 results";
// }

// mysqli_close($link);
// }
// function Record($link,$name,$family,$tel,$email,$pass){
//     $stmt =  "INSERT INTO kvc (`name`,`family`,`phone_number`,`email`,`pasword`) VALUES
//             ('$name','$family','$tel','$email','$pass')"; 
//             $result1=mysqli_query($link, $stmt);
//             if ($link->query($stmt) === TRUE) {
         
//                 $message="باموفقیت ثبت شد";
//                 message($message);
             
//               }
// }

require 'confing.php';
$b=0;
function checkregister($link,$email,$tel){
    

  $sql = "SELECT `email`,`phone_number` FROM kvc where `email`='$email'or`phone_number`='$tel'";
  $result = mysqli_query($link, $sql);

  if (mysqli_num_rows($result) > 0) {
    $message="شماقبلا ثبت نام شده اید";
    $b=1;
    // message($message);
    $a=[];
    $a["status"]=false;
    $a["data"]=$message;
    echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    exit;
  return;
  }
}
if ($b==0) {
 
  function Record($link,$name,$family,$tel,$email,$pass){
      $stmt =  "INSERT INTO kvc (`name`,`family`,`phone_number`,`email`,`pasword`) VALUES
              ('$name','$family','$tel','$email','$pass')"; 
              $result1=mysqli_query($link, $stmt);
              if (mysqli_query($link, $stmt)){
          
                  $message="باموفقیت ثبت شد";
                  $a=[];
                  $a["status"]=false;
                  $a["data"]=$message;
                  echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                  // message($message);
              
                }
                return;    
                // exit;        
  }
}
 function checklogin($link,$email,$pass){

  $sql = "SELECT `email`,`pasword` FROM kvc where `email`='$email'or`password`='$pass'";
  $result = mysqli_query($link, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    $message="ورودباموفقیت";
    $a=[];
    $a["status"]=false;
    $a["data"]=$message;
    echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    exit;
  return;
  }
  else {
    
      $message='نام کاربری یارمزعبور اشتباه هست';
  
       $a=[];
       $a["status"]=false;
       $a["data"]=$message;

       echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
   
  }

 }



?>