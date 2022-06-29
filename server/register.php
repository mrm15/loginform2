<?php
require 'injection.php';
require 'masege.php';
require 'register.php';
require 'confing.php';

foreach ($_REQUEST as $key => $value) {
    if ($key=="register") {
    
        $registerdata=$value;
        $registerdata=json_decode($registerdata,TRUE);
   
    foreach ($registerdata as $k) 
    {
        echo "n";
        if ($k['name'] == "name") {
            $name=$k['value'];
            $errors="نام";
            echo "n";
            empty1($name,$errors);
            checkname($name,$errors);
            
            $name=mysqli_real_escape_string($link,$name);
            
          
         
        }
        if ($k['name'] == "tel") 
        {
            $tel=$k['value'];
             $errors="تلفن";
            empty1($tel,$errors);
            checktel($tel,$errors);
             
             $tel=mysqli_real_escape_string($link,$tel);
                   
         } 
        if ($k['name'] == "email")
        
        {
            $email=$k['value'];
            $errors="ایمیل";

            empty1($email,$errors);
            checkmail($email,$errors);
                
            $email=mysqli_real_escape_string($link,$email);
        }
    
        
        
        if ($k['name'] == "pasword")
        {
            $password=$k['value'];
            $errors="رمزعبور";
        
            empty1($password,$errors);
            passcheck($password,$errors);
            $pass=password_hash("$password", PASSWORD_DEFAULT);
    
        }
        if ($k['name'] == "family")
        {
            $family=$k['value'];
            $errors="نام خانوادگی";
            empty1($family,$errors);
            checkname($family,$errors);
            $family=mysqli_real_escape_string($link,$family);
                    
        }
        
    }
    checkregister($link,$email,$tel);
        registers($link, $name,$family,$tel,$email,$pass); 
    }
}


?>