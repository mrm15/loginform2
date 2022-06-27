<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Content-Type:application/json");
// include ("error.php");
// $username = stripslashes($_POST['username']);

//     $username = mysqli_real_escape_string($con,$username); 
//     $email = stripslashes($_POST['email']);
//     $email = mysqli_real_escape_string($con,$email);
$errors=[0];
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
            if ($k['name'] == "name") 
            {
                $name=$k['value'];
                if(is_null($name) || $name =="" ) {
                    $errors = $errors.'فیلد نام نمی‌تواند خالی بماند';
   
                   }
                // }
                $name=str_replace(" ","",$name);
                if($pattern = preg_match('/^[-A-Za-z\p{L} ]+$/u', $name) && mb_strlen($name)>2){
                    $name=mysqli_real_escape_string($link,$name);
                }
                else {
                    $errors = $errors.'فیلدنام حتما باید حروف باشدوبیشتردوحروف باشد';
   
                }
                
               
                
            }
            if ($k['name'] == "tel") 
            {
                        $tel=$k['value'];
                        if (is_numeric($tel)) {
                    
                        $tel=mysqli_real_escape_string($link,$tel);
                        // echo $tel;
                    if(is_null($tel) || $tel =="") {
                            $errors =$errors. 'فیلد تلفن نمی‌تواند خالی بماند';
                        }
                        elseif (strlen($tel)!= 11|| $tel[0]!= 0 || $tel[1]!= 9 ) {
                            $errors = $errors.'شماره تلفن اشتباه هست';  
                        }
                    
                    } 
                    else {
                        $errors = $errors.'شماره تلفن اشتباه هست';
                    } 
             } 
                if ($k['name'] == "email")
                
                {
                      $email=$k['value'];
                  
                    if(is_null($email) || $email =="") {
                        $errors =$errors. 'فیلد ایمیل نمی‌تواند خالی بماند';
                    }
                    // $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors =$errors. 'فیلد ایمیل نامعتبرهست';
                    }
                    
                   
                    $email=mysqli_real_escape_string($link,$email);
                }
            
            
            
                if ($k['name'] == "pasword")
                {
                    $password=$k['value'];
                    if(is_null($password) || $password =="") {
                        $errors = $errors.'فیلدرمزعبور نمی‌تواند خالی بماند';
                    }
                    $pattern = '/^(?=.*[!@#$%^&*()\-_=+`~\[\]{}?])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,30}$/';
                    if(preg_match($pattern,$password)){
                        $pass=password_hash("$password", PASSWORD_DEFAULT);
                    }
                    else {
                        $errors = $errors.'رمزعبور باید شامل حروف بزرگ  وکوچک وعدد وکارکترهای@#باشد';
                    }
                    
    
                }
                if ($k['name'] == "family")
                {
                            $family=$k['value'];
                            if(is_null($family) || $family =="") {
                                $errors = $errors.'فیلد نام خانوادگی نمی‌تواند خالی بماند';
                            }
                        $family=str_replace(" ","",$family);
                        if($pattern = preg_match('/^[-A-Za-z\p{L} ]+$/u', $family) && mb_strlen($family)>2){
                            $family=mysqli_real_escape_string($link,$family);
                        }
                        else {
                            $errors = $errors.'فیلدنام خانوادگی حتما باید حروف باشدوبیشتر ازدو حروف باشد';
        
                        }
                  

                                    
               }
                
            }
     }  
 } 
//                 $link= mysqli_connect('localhost','root','');
//                 if (! $link) {
//                 echo 'could not connect :' . mysqli_connect_error();
//                 exit;
//                 }
               
//                 mysqli_select_db($link,'login1');
                $sql = "SELECT `email`,`phone_number` FROM kvc"; // SQL with parameters
                $result=mysqli_query($link, $sql);
                $deta=mysqli_fetch_all($result, MYSQLI_ASSOC);
                // echo 'yes';
                
                // $stmt = $link->prepare($sql); 
                // // $stmt->bind_param("i", $id);
                // $stmt->execute();
                // $result = $stmt->get_result(); // get the mysqli result
                // $user = $result->fetch_all(); // fetch data
                
                foreach ($deta as $d) {
                    $z=$d['email'];
                    $z1=$d['phone_number'];
                    // echo $z."".$z1;
                    if ($z== $email || $z1==$tel)
                    {
                        // echo 'yes';
                        $errors = $errors.'فیلدقیلاثبت شده هست';
                        break;
                    //  header("LOCATION:http://localhost/php-sandbox/sabt/sabt3.php")
                    }
                   
                   
                  
                }
           
        if ($errors==[0])
        {
            $stmt =  "INSERT INTO kvc (`name`,`family`,`phone_number`,`email`,`pasword`) VALUES
            ('$name','$family','$tel','$email','$pass')"; /* Query 1 */
            // mysqli_stmt_bind_param($stmt, "si", $string, $integer);
            // mysqli_stmt_execute($stmt);
            // mysqli_stmt_close($stmt); // CLOSE $stmt
            $result1=mysqli_query($link, $stmt);
            if ($link->query($stmt) === TRUE) {
                // echo "New record created successfully";
                $x="باموفقیت ثبت شد";
                $a["status"]=true;
                $a["data"]=$x;
    
                echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
               
                // header("LOCATION: http://localhost/php-sandbox/test1/form1.php");
              }
         }   
              else {
                // echo "Error: " . $sql . "<br>" . $conn->error;
                $a=[];
                $a["status"]=false;
                $a["data"]=$errors;
    
                echo json_encode($a ,JSON_PRESERVE_ZERO_FRACTION| JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

            
              }
  
     

?>


// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // $post[]=$_POST['rejester'];
//     $a=$_POST['name'];
// $name = json_decode($a, true);
// if(is_null($name)) {
//     $errors['name'] = 'فیلد نام نمی‌تواند خالی بماند';
// }
// $b=$_POST['family'];
// $family = json_decode($b, true);
// if(is_null($family)) {
//     $errors['family'] = 'فیلد فامیلی نمی‌تواند خالی بماند';
// }
// $c=$_POST['tel'];
// $tel = json_decode($c, true);
// if(is_null($tel)) {
//     $errors['tel'] = 'فیلد تلفن نمی‌تواند خالی بماند';
// }
// elseif (strlen($tel==11) && $tel[0]==0 && $tel[1]==9 ) {
    
// }
// else {
//     $errors['tel'] = 'شماره تلفن اشتباه هست';
// }
// $e=$_POST['email'];
// $email = json_decode($e, true);
// if(is_null($email)) {
//     $errors['email'] = 'فیلد ایمیل نمی‌تواند خالی بماند';
// }
// $f=$_POST['pasword'];
// $pasword = json_decode($f, true);
// if(is_null($email)) {
//     $errors['pasword'] = 'فیلد پسورد نمی‌تواند خالی بماند';
// }
// $pass=password_hash('$pasword', PASSWORD_DEFAULT);
// $url =  "******";
            // $context  = stream_context_create( $options );
            // $result = file_get_contents( $url, false, $context );
            // $response = json_decode( $result );
        //  $statuse = json_decode($errors, true);
        // $statuse = json_decode($statuse, flags: JSON_BIGINT_AS_STRING | JSON_OBJECT_AS_ARRAY);
        // echo(json_encode($statuse));