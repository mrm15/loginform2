<?php
require 'masege.php';
// function validation($lname,$fname,$tel,$password,$email){
   
//    empty1($lname,$fname,$tel,$password,$email);

// }

function empty1($empty,$errors){
  
    // $empty=[];
    // $errors=[]; 
    if (is_null($empty) || $empty=="") {
       
      $message = $errors.' نمی‌تواند خالی بماند';
      message($message);
    }

 } 
 function checkname($name,$errors){
    $name=str_replace(" ","",$name);
    if($pattern = preg_match('/^[-A-Za-z\p{L} ]+$/u', $name) && mb_strlen($name)>2){
        // $name=mysqli_real_escape_string($link,$name);
    }
    else {
        $message = $errors.'حتما باید حروف باشدوبیشتردوحروف باشد';
        message($message);
       
    }
 }
 function checktel($tel,$errors){
    if (is_numeric($tel)) {
                 
        if (strlen($tel)!= 11|| $tel[0]!= 0 || $tel[1]!= 9 ) {
              $message ='شماره تلفن اشتباه هست';  
              message($message);
              
          }
      
    } 
      else {
          $message = 'شماره تلفن اشتباه هست';
          message($message);
          
        }
}
function checkmail($email,$errors){
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'فیلد ایمیل نامعتبرهست';
        message($message);
    }
  
}
function passcheck($password,$errors){
    $pattern = '/^(?=.*[!@#$%^&*()\-_=+`~\[\]{}?])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,30}$/';
    if(!preg_match($pattern,$password)){
        $message = 'رمزعبور باید شامل هشت کارکتر یک حروف بزرگ  وکوچک وعدد وکارکترهای@#باشد';
        message($message);
    }
 
}


?>
