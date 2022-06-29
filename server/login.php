<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Content-Type:application/json");
$x=1;
$errors=[0];
// include ("error.php");
$link= mysqli_connect('localhost','root','');
if (! $link) {
echo 'could not connect :' . mysqli_connect_error();
exit;
}
echo 'connect sucsessfuly';
mysqli_select_db($link,'login1');
foreach ($_REQUEST as $key => $value) 
{
    if ($key=="register") 
    {
        $registerdata=$value;
        $registerdata=json_decode($registerdata,TRUE);
        foreach ($registerdata as $k) 
        {
           
          
            if ($k['name'] == "email") 
            {
                $_email=$k['value'];
                $email=mysqli_real_escape_string($link,$_email);
                if(is_null($email) || $email =="") {
                    $errors =$errors. 'فیلد ایمیل نمی‌تواند خالی بماند';
                }
                elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors =$errors. 'فیلد ایمیل نامعتبرهست';
                }
            }
           
            if ($k['name'] == "pasword") 
            {
                $password=$k['value'];
                if(is_null($password) || $password =="") {
                    $errors = $errors.'فیلد پسورد نمی‌تواند خالی بماند';
                }
                // $pass=password_hash("$password", PASSWORD_DEFAULT);
                // echo $pass;
 
            }
            
        }
    }
}
// if($_SERVER['REQUEST_METHOD'] == 'POST') 
// {
//        $email = json_decode($_POST["email"], false);
//         if(is_null($email)) 
//         {
//             $errors['email'] = 'فیلد ایمیل نمی‌تواند خالی بماند';
//         }
//         $pasword = json_decode($_POST["pasworrd"], false);
//         if(is_null($email)) 
//         {
//             $errors['pasword'] = 'فیلد پسورد نمی‌تواند خالی بماند';
//         }
//         $pass=password_hash("$password", PASSWORD_DEFAULT);
       
        $sql = "SELECT `pasword`,`email` FROM kvc"; // SQL with parameters
        $result=mysqli_query($link, $sql);
        $deta=mysqli_fetch_all($result, MYSQLI_ASSOC);
      
        foreach ($deta as $d) 
        {
           $z=$d['email']; 
           $z1=$d['pasword'];
           
        
        if ( $z==$email&& $z1 == password_verify( $password,$d['pasword']))
        {
            $x=0;
            $x="ورود باموفقیت";
            $a["status"]=true;
            $a["data"]=$x;

            echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        //  header("LOCATION:http://localhost/php-sandbox/sabt/sabt3.php");
        break;
        }
       
    }
    if($x==1) {
       $errors=$errors.'نام کاربری یارمزعبور اشتباه هست';
    }
    if ($errors!=[0])
    {
        $a=[];
        $a["status"]=false;
        $a["data"]=$errors;

        echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

    }
   
      // $stmt = $link->prepare($sql); 
        // // $stmt->bind_param("i", $id);
        // $stmt->execute();
        // $result = $stmt->get_result(); // get the mysqli result
        // $user = $result->fetch_assoc(); // fetch data
?>