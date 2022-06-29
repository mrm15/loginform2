<?php
require 'injection.php';
require 'masege.php';
require 'register.php';
require 'confing.php';

foreach ($_REQUEST as $key => $value) {
    if ($key=="login") {
    
        $registerdata=$value;
        $registerdata=json_decode($registerdata,TRUE);
   
    foreach ($registerdata as $k) 
    {
       
        if ($k['name'] == "email")
        
        {
            $email=$k['value'];
            $email=mysqli_real_escape_string($link,$email);
        }
    
        
        
        if ($k['name'] == "pasword")
        {
            $password=$k['value'];
            $pass=password_hash("$password", PASSWORD_DEFAULT);
    
        }
      
        
    }
    checklogin($link,$email,$pass); 
    }
}


?>